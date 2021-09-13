<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.category.index');
    }

    /**
     * Parsing JSON data for AJAX Datatable
     *
     * @return JSON
    */
    public function getJSON()
    {
        $categories = Category::all('id', 'category_name', 'created_at');

        return Datatables::of($categories)
            ->addColumn('action', function ($category) {
                return
                '<button data-url="' . route('category.edit', $category->id) . '" class="edit btn btn-sm btn-warning">
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <button data-url="' . route('category.destroy', $category->id) . '" class="delete btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                </button>';
            })
            ->editColumn('created_at', function ($category) {
                if ($category->created_at !== null) {
                    return date('d/m/Y - H:i', strtotime($category->created_at));
                }

                return '-';
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function create()
    {
        $category = new Category();

        return view('pages.category.form', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'category_name' => 'required|string|unique:categories|max:100',
        ];

        $customMessages = [
            'required' => 'Nama kategori tidak boleh kosong.',
            'unique'   => 'Nama kategori telah digunakan.',
            'max'      => 'Nama kategori maksimal 100 karakter.',
            'string'   => 'Nama kategori hanya boleh mengandung karakter atau angka.',
        ];

        $this->validate($request, $rules, $customMessages);

        Category::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        return view('pages.category.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        $rules = [
            'category_name' => 'required|string|unique:categories|max:100',
        ];

        $customMessages = [
            'required' => 'Nama kategori tidak boleh kosong',
            'unique'   => 'Nama kategori telah digunakan',
            'max'      => 'Nama kategori maksimal 100 karakter',
            'string'   => 'Nama kategori hanya boleh mengandung karakter atau angka',
        ];

        $this->validate($request, $rules, $customMessages);

        $category->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        $category->delete();
    }
}
