<?php

namespace App\Http\Controllers;

use DataTables;
use App\Http\Requests\UploadDetect;
use App\Models\Category;
use App\Models\Detect;
use App\Models\DetectSimilarity;
use App\Models\MasterDocs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TextAnalysis\Comparisons\CosineSimilarityComparison;
use function Opis\Closure\unserialize;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\Tokenization\WhitespaceTokenizer;

class DetectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.detect.index');
    }

    public function datatbleJson()
    {
        $Detect = Detect::leftjoin('categories', 'detects.category_id', '=', 'categories.id')
            ->select(['detects.*', 'categories.category_name']);

        return Datatables::of($Detect)
            ->addColumn('action', function ($doc) {
                return
                    '<a href="' . route('detect.result', $doc->id) . '" title="Lihat Detail" class="btn btn-sm btn-info">
                    <i class="fas fa-lg fa-eye"></i>
                </a>';
            })
            ->editColumn('created_at', function ($doc) {
                if ($doc->created_at !== null) {
                    return date('d-m-Y / H:i', strtotime($doc->created_at));
                }

                return '-';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $detect = new Detect();
        $categories = Category::all('id', 'category_name');
        $documents = MasterDocs::all('id', 'title', 'created_by');

        return view('pages.detect.form', compact('categories', 'documents', 'detect'));
    }

    public function getMasterDocs(Request $request)
    {
        $masterDocs = MasterDocs::select('id', 'title', 'created_by')->where('category_id', $request->category_id)->get();

        return $masterDocs->toJson();
    }

    public function store(UploadDetect $request)
    {
        // ===== I. Tahap 1: Text-Processing dokumen yang di upload =====
        // 1. Validating File
        $request->validated();

        // 2. Uploading File
        $uploadedFile = $request->file('file');

        // 3. Parse PDF to text
        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile($uploadedFile);
        $text = $pdf->getText();

        // 4. Remove all extra white spaces (kalo masih ada spasi yang lebih dari 1 proses filtering & stemming bakal ga tepat)
        $text = trim(preg_replace('/\s+/', ' ', $text));

        // 5. Case Folding
        $text = strtolower($text);

        // 6. Filtering (Remove Stopwords)
        $factory = new \Sastrawi\StopWordRemover\StopWordRemoverFactory();
        $remover = $factory->createStopWordRemover();
        $text = $remover->remove($text);

        // 7. Stemming (with Nazieb Andriani Algorithm)
        $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
        $stemmer = $stemmerFactory->createStemmer();

        // 8. Tokenizing (Convert text to array)
        $output = $stemmer->stem($text);
        $tok = strtok($output, " \n\t");
        $docQuery = [];
        while ($tok !== false) {
            $docQuery[] = $tok;
            $tok = strtok(" \n\t");
        }

        // 9. Sorting Alphabet
        sort($docQuery, SORT_STRING);

        // 10. Change to common text
        // $docQuery = implode(' ', $docQuery);

        // ====== II. Tahap 2: Ambil teks dokumen pembanding =====
        $masterDocs = MasterDocs::findOrFail($request->master_doc_id);

        $masterArrWords = [];
        $samples = [];
        foreach ($masterDocs as $master) {
            $string = '';
            $arrWords = [];
            foreach (unserialize($master->text) as $arr) {
                $string .= $arr . ' ';
                $arrWords[] = $arr;
            }
            $samples[] = $string;
            $masterArrWords[] = $arrWords;
        }

        // Token Count Vectorizer
        $vectorizer = new TokenCountVectorizer(new WhitespaceTokenizer());
        $vectorizer->fit($samples);
        $vectorizer->transform($samples);

        // Each words
        $words = $vectorizer->getVocabulary();

        $transformer = new TfIdfTransformer($samples);
        $transformer->transform($samples);

        $results = [];
        $compare = new CosineSimilarityComparison();
        foreach ($masterArrWords as $key => $value) {
            $results[] = $compare->similarity($docQuery, $value);
        }

        // dd($samples);

        return view('welcome', compact('words', 'samples', 'masterDocs', 'results'));
        die;

        // ====== III. Tahap 3: Insert record deteksi ======
        $detect = new Detect();
        $detect->category_id = $request->category_id;
        $detect->created_by = $request->created_by;
        $detect->title = $request->title;
        $detect->text = serialize($docQuery);
        $detect->save();

        $insertBatch = [];
        foreach ($masterDocs as $key => $master) {
            $insertBatch[] = [
                'detect_id' => $detect->id,
                'master_doc_id' => $master->id,
                'result' => $results[$key],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        DetectSimilarity::insert($insertBatch);

        return redirect()->route('detect.result', ['id' => $detect->id]);
    }

    public function result($id)
    {
        $detect = Detect::findOrFail($id);
        $results = DB::table('detect_similarities')
            ->leftJoin('master_docs', 'master_docs.id', '=', 'detect_similarities.master_doc_id')
            ->select('detect_similarities.result', 'master_docs.title', 'master_docs.text', 'master_docs.created_by')
            ->where('detect_id', $id)
            ->get();
        $garisBatas = 85;

        $acuanTR[] = unserialize($detect->text);
        foreach ($results as $res) {
            $acuanTR[] = unserialize($res->text);
        }
        $maxTR = count(max($acuanTR));

        return view('pages.detect.result', compact('detect', 'results', 'garisBatas', 'maxTR'));
    }
}
