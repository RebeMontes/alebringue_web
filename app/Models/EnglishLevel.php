<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lesson;
use App\Models\Word;

class EnglishLevel extends Model
{
     protected $table = 'english_levels';

    protected $fillable = [
        'code',
        'name',
        'description'
    ];

    // Relación: un nivel tiene muchas lecciones
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'level_id');
    }

    public function words()
{
    return $this->hasMany(Word::class, 'level_id');
}
}