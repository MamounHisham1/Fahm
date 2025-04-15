<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Lesson;
use App\Models\Profile;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1000)->create();
        Client::factory(10)->create();
        Profile::factory(300)->create();
        Teacher::factory(50)->create();
        Student::factory(500)->create();
        Subject::factory(100)->create();
        Lesson::factory(1000)->create();
    }
}
