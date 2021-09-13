<?php

namespace App\Models;

use App\Models\DetectSimilarity;
use Illuminate\Database\Eloquent\Model;

class Detect extends Model
{
    protected $fillable = [
    	'category_id', 'created_by', 'title'
    ];

    /**
     * Create One to Many Relationship
     *
     * @return void
     */
    public function detectSimilarities()
    {
        return $this->hasMany(DetectSimilarity::class);
    }
}
