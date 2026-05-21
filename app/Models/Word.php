<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\EnglishLevel;
use App\Models\Lesson;
use App\Models\Category;

class Word extends Model
{
     protected $fillable = [
        'word',
        'translation',
        'audio_path',
        'category_id',
        'pronunciation'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
