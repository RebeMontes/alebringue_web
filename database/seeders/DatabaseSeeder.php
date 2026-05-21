<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario ADMIN
        $admin = User::firstOrCreate(
            ['email' => 'admin@alebringue.com'],
            [
                'name'      => 'Admin Alebringüe',
                'password'  => Hash::make('password'),
                'user_type' => 'admin',
            ]
        );

        // Usuario 
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name'      => 'Test User',
                'password'  => Hash::make('password'),
                'user_type' => 'user',
            ]
        );

        // Profesores de prueba
        $teacher1 = Teacher::firstOrCreate(
            ['email' => 'sarah@alebringue.com'],
            ['name'  => 'Prof. Sarah Mitchell']
        );
        $teacher2 = Teacher::firstOrCreate(
            ['email' => 'carlos@alebringue.com'],
            ['name'  => 'Prof. Carlos Estrada']
        );
        $teacher3 = Teacher::firstOrCreate(
            ['email' => 'ana@alebringue.com'],
            ['name'  => 'Prof. Ana Torres']
        );

        // Salones de prueba
        $c1 = Classroom::firstOrCreate(
            ['name' => 'Business English for Professionals'],
            [
                'code'       => Classroom::generateCode(),
                'schedule'   => 'Lun, Mié, Vie · 7:00 PM',
                'teacher_id' => $teacher1->id,
                'level_id'   => null,
                'is_active'  => true,
            ]
        );

        $c2 = Classroom::firstOrCreate(
            ['name' => 'Everyday Conversation & Listening'],
            [
                'code'       => Classroom::generateCode(),
                'schedule'   => 'Mar, Jue · 6:00 PM',
                'teacher_id' => $teacher2->id,
                'level_id'   => null,
                'is_active'  => true,
            ]
        );

        $c3 = Classroom::firstOrCreate(
            ['name' => 'Grammar Bootcamp: Tenses & Structure'],
            [
                'code'       => Classroom::generateCode(),
                'schedule'   => 'Sáb · 10:00 AM',
                'teacher_id' => $teacher3->id,
                'level_id'   => null,
                'is_active'  => true,
            ]
        );

        // Inscribir al usuario en los salones (syncWithoutDetaching evita duplicados)
        $user->classrooms()->syncWithoutDetaching([$c1->id, $c2->id, $c3->id]);
    }
}