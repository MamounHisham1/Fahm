<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Lesson;
use App\Models\Profile;
use App\Models\Subject;
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
        Admin::factory(['name' => 'Admin', 'email' => 'admin@admin.com', 'password' => Hash::make('password')])->create();
        Client::factory(10)->create();
        Profile::factory(5000)->create();
        Subject::factory(100)->create();
        Lesson::factory(1000)->create();
    }
}
