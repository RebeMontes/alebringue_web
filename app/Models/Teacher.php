<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'email',
    ];

    public function classrooms()
    {
        return $this->hasMany(Classroom::class, 'teacher_id');
    }
}