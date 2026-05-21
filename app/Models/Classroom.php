<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'code',
        'schedule',
        'teacher_id',
        'level_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function generateCode(): string
    {
        do {
            $code = 'ALE-' . strtoupper(substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 6));
        } while (self::where('code', $code)->exists());

        return $code;
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function level()
    {
        return $this->belongsTo(EnglishLevel::class, 'level_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'classroom_user', 'classroom_id', 'user_id')->withTimestamps();
    }
}