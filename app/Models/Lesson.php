<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\EnglishLevel;
use App\Models\Word;

class Lesson extends Model
{
        protected $fillable = [
        'title',
        'description',
        'level_id'
    ];

    public function level()
    {
        return $this->belongsTo(EnglishLevel::class, 'level_id');
    }

    public function words()
    {
        return $this->belongsToMany(Word::class, 'lessons_words');
    }
}
