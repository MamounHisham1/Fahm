<?php

namespace Database\Seeders;

use App\Enums\LessonType;
use App\Models\Client;
use App\Models\Lesson;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client = Client::where('domain', 'school')->first();
        $teacher = User::where('email', 'teacher@school.com')->first();
        $computerScience = Subject::where('slug', 'computer-science')->first();

        if (!$client || !$teacher || !$computerScience) {
            $this->command->error('Required models not found. Please run DatabaseSeeder first.');
            return;
        }

        $techCourses = [
            [
                'title' => 'Laravel From Scratch 2024 | 4+ Hour Course',
                'description' => 'Complete Laravel course covering fundamentals, Eloquent, authentication, and building a real project',
                'url' => 'MYyJ4PuL4pY',
                'type' => LessonType::Youtube->value,
            ],
            [
                'title' => 'Livewire 3 Crash Course - Build a Real-Time App',
                'description' => 'Learn Livewire 3 by building a real-time application with modern Laravel practices',
                'url' => '1pkOYRr9Q_Q',
                'type' => LessonType::Youtube->value,
            ],
            [
                'title' => 'PHP For Beginners | 3+ Hour Course',
                'description' => 'Complete PHP fundamentals course for absolute beginners with hands-on projects',
                'url' => 'OK_JCtrrv-c',
                'type' => LessonType::Youtube->value,
            ],
            [
                'title' => 'JavaScript Full Course for Beginners | 8 Hours',
                'description' => 'Comprehensive JavaScript course covering ES6+, DOM manipulation, and modern JS features',
                'url' => 'EerdGm-ehJQ',
                'type' => LessonType::Youtube->value,
            ],
            [
                'title' => 'React JS Full Course 2024 | Build an App and Master React',
                'description' => 'Complete React course with hooks, context API, and building a full-stack application',
                'url' => 'CgkZ7MvWUAA',
                'type' => LessonType::Youtube->value,
            ],
            [
                'title' => 'Vue.js Course for Beginners [2024 Tutorial]',
                'description' => 'Learn Vue.js 3 with composition API, routing, state management and build real projects',
                'url' => 'FXpIoQ_rT_c',
                'type' => LessonType::Youtube->value,
            ],
            [
                'title' => 'Tailwind CSS Full Course for Beginners | Complete All-in-One Tutorial',
                'description' => 'Master Tailwind CSS with practical examples and build responsive layouts efficiently',
                'url' => 'ft30zcMlFao',
                'type' => LessonType::Youtube->value,
            ],
            [
                'title' => 'MySQL Tutorial for Beginners [Full Course]',
                'description' => 'Complete MySQL database course covering queries, joins, optimization and administration',
                'url' => '7S_tz1z_5bA',
                'type' => LessonType::Youtube->value,
            ],
            [
                'title' => 'Git & GitHub Crash Course For Beginners',
                'description' => 'Learn Git version control and GitHub collaboration in this comprehensive beginner course',
                'url' => 'SWYqp7iY_Tc',
                'type' => LessonType::Youtube->value,
            ],
            [
                'title' => 'Docker Tutorial for Beginners [FULL COURSE in 3 Hours]',
                'description' => 'Complete Docker course covering containers, images, docker-compose and deployment',
                'url' => '3c-iBn73dDE',
                'type' => LessonType::Youtube->value,
            ],
        ];

        foreach ($techCourses as $course) {
            Lesson::create([
                'user_id' => $teacher->id,
                'client_id' => $client->id,
                'subject_id' => $computerScience->id,
                'title' => $course['title'],
                'slug' => Str::slug($course['title']),
                'description' => $course['description'],
                'url' => $course['url'],
                'type' => $course['type'],
            ]);
        }

        $this->command->info('Tech courses seeded successfully!');
    }
}
