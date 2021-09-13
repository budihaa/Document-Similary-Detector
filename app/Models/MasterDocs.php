<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterDocs extends Model
{
    protected $fillable = [
        'category_id', 'created_by', 'title', 'text'
    ];
}
