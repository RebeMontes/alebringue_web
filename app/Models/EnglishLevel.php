<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lesson;

class EnglishLevel extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    // Relación: un nivel tiene muchas lecciones
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'level_id');
    }
}