<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
   public function lessons()
{
    return $this->belongsToMany(Lesson::class, 'lessons_words');
}
}
