<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetectSimilarity extends Model
{
    protected $fillable = [
        'detect_id', 'master_doc_id', 'result',
    ];

}
