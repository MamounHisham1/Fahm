<?php

namespace Database\Seeders;

use App\Enums\AssignmentType;
use App\Enums\UserRole;
use App\Models\Admin;
use App\Models\Assignment;
use App\Models\AssignmentGrade;
use App\Models\AssignmentSubmission;
use App\Models\Classroom;
use App\Models\Client;
use App\Models\Lesson;
use App\Models\Profile;
use App\Models\Subject;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create School Client
        $client = Client::create([
            'name' => 'School',
            'domain' => 'school',
            'description' => 'A comprehensive educational institution providing quality education from elementary to high school levels.',
        ]);

        // Create Student User
        $student = User::create([
            'name' => 'John Smith',
            'email' => 'student@school.com',
            'password' => Hash::make('password'),
            'role' => UserRole::Student,
            'client_id' => $client->id,
        ]);

        // Create Teacher User
        $teacher = User::create([
            'name' => 'Sarah Johnson',
            'email' => 'teacher@school.com',
            'password' => Hash::make('password'),
            'role' => UserRole::Teacher,
            'client_id' => $client->id,
        ]);

        // Create Profiles
        Profile::create([
            'user_id' => $student->id,
            'client_id' => $client->id,
            'slug' => Str::slug($student->name),
            'status' => 'active',
            'gender' => 'male',
            'phone' => '+1-555-0123',
            'address' => '123 Student Street, Education City, EC 12345',
            'bio' => 'Enthusiastic high school student passionate about learning and academic excellence.',
        ]);

        Profile::create([
            'user_id' => $teacher->id,
            'client_id' => $client->id,
            'slug' => Str::slug($teacher->name),
            'status' => 'active',
            'gender' => 'female',
            'phone' => '+1-555-0456',
            'address' => '456 Teacher Avenue, Education City, EC 12346',
            'bio' => 'Experienced educator with 10+ years of teaching experience in mathematics and science.',
        ]);

        // Create Subjects
        $subjects = [
            ['name' => 'Mathematics', 'slug' => 'mathematics'],
            ['name' => 'English Literature', 'slug' => 'english-literature'],
            ['name' => 'Physics', 'slug' => 'physics'],
            ['name' => 'Chemistry', 'slug' => 'chemistry'],
            ['name' => 'Biology', 'slug' => 'biology'],
            ['name' => 'History', 'slug' => 'history'],
            ['name' => 'Geography', 'slug' => 'geography'],
            ['name' => 'Computer Science', 'slug' => 'computer-science'],
        ];

        $createdSubjects = [];
        foreach ($subjects as $subject) {
            $createdSubjects[] = Subject::create([
                'client_id' => $client->id,
                'name' => $subject['name'],
                'slug' => $subject['slug'],
            ]);
        }

        // We'll create grades after assignments are created

        // Create Classrooms
        $classrooms = [
            ['name' => '9th Grade - Section A'],
            ['name' => '9th Grade - Section B'],
            ['name' => '10th Grade - Section A'],
            ['name' => '10th Grade - Section B'],
            ['name' => '11th Grade - Science'],
            ['name' => '11th Grade - Arts'],
            ['name' => '12th Grade - Science'],
            ['name' => '12th Grade - Arts'],
        ];

        $createdClassrooms = [];
        foreach ($classrooms as $classroom) {
            $createdClassrooms[] = Classroom::create([
                'client_id' => $client->id,
                'name' => $classroom['name'],
            ]);
        }

        // Create Assignments
        $assignments = [
            [
                'subject' => $createdSubjects[0], // Mathematics
                'title' => 'Quadratic Equations Practice',
                'description' => 'Solve the given quadratic equations using various methods including factoring, completing the square, and the quadratic formula.',
                'type' => AssignmentType::Text->value,
                'max_score' => 100.00,
                'due_date' => now()->addDays(7),
            ],
            [
                'subject' => $createdSubjects[1], // English Literature
                'title' => 'Shakespeare Essay Analysis',
                'description' => 'Write a 1000-word essay analyzing the themes of love and betrayal in Romeo and Juliet.',
                'type' => AssignmentType::File->value,
                'max_score' => 100.00,
                'due_date' => now()->addDays(14),
            ],
            [
                'subject' => $createdSubjects[2], // Physics
                'title' => 'Newton\'s Laws Lab Report',
                'description' => 'Conduct experiments demonstrating Newton\'s three laws of motion and submit a detailed lab report with observations and conclusions.',
                'type' => AssignmentType::File->value,
                'max_score' => 100.00,
                'due_date' => now()->addDays(10),
            ],
            [
                'subject' => $createdSubjects[3], // Chemistry
                'title' => 'Periodic Table Quiz',
                'description' => 'Complete the online quiz covering periodic table trends, electron configurations, and chemical bonding.',
                'type' => AssignmentType::Text->value,
                'max_score' => 50.00,
                'due_date' => now()->addDays(3),
            ],
            [
                'subject' => $createdSubjects[7], // Computer Science
                'title' => 'Python Programming Project',
                'description' => 'Create a simple calculator application using Python with a graphical user interface.',
                'type' => AssignmentType::File->value,
                'max_score' => 150.00,
                'due_date' => now()->addDays(21),
            ],
        ];

        $createdAssignments = [];
        foreach ($assignments as $assignment) {
            $createdAssignments[] = Assignment::create([
                'client_id' => $client->id,
                'subject_id' => $assignment['subject']->id,
                'title' => $assignment['title'],
                'description' => $assignment['description'],
                'type' => $assignment['type'],
                'max_score' => $assignment['max_score'],
                'due_date' => $assignment['due_date'],
            ]);
        }

        // Create Assignment Submissions and Grades
        foreach ($createdAssignments as $assignment) {
            // Create a submission from the student
            $submission = AssignmentSubmission::create([
                'assignment_id' => $assignment->id,
                'user_id' => $student->id,
                'type' => $assignment->type,
                'text' => $assignment->type === AssignmentType::Text->value ? 'Student submission text content for '.$assignment->title : null,
                'file' => $assignment->type === AssignmentType::File->value ? 'sample_submission.pdf' : null,
                'image' => $assignment->type === AssignmentType::Image->value ? 'sample_image.jpg' : null,
            ]);

            // Create a grade for the submission
            AssignmentGrade::create([
                'submission_id' => $submission->id,
                'user_id' => $teacher->id,
                'score' => fake()->randomFloat(2, 70, $assignment->max_score),
                'feedback' => fake()->sentence(),
            ]);
        }

        // Create Lessons
        $lessons = [
            [
                'subject' => $createdSubjects[0], // Mathematics
                'title' => 'Introduction to Quadratic Functions',
                'description' => 'Understanding the basics of quadratic functions and their graphs',
            ],
            [
                'subject' => $createdSubjects[0], // Mathematics
                'title' => 'Solving Quadratic Equations',
                'description' => 'Methods for solving quadratic equations',
            ],
            [
                'subject' => $createdSubjects[1], // English Literature
                'title' => 'Shakespeare\'s Writing Style',
                'description' => 'Analyzing the literary techniques used by William Shakespeare',
            ],
            [
                'subject' => $createdSubjects[2], // Physics
                'title' => 'Newton\'s First Law of Motion',
                'description' => 'Understanding inertia and the law of motion',
            ],
            [
                'subject' => $createdSubjects[7], // Computer Science
                'title' => 'Python Basics',
                'description' => 'Introduction to Python programming language',
            ],
        ];

        foreach ($lessons as $lesson) {
            Lesson::create([
                'user_id' => $teacher->id,
                'client_id' => $client->id,
                'subject_id' => $lesson['subject']->id,
                'title' => $lesson['title'],
                'slug' => Str::slug($lesson['title']),
                'description' => $lesson['description'],
            ]);
        }

        // Create Admin user
        Admin::create([
            'name' => 'School Administrator',
            'email' => 'admin@school.com',
            'password' => Hash::make('password'),
        ]);

        $this->command->info('School database seeded successfully!');
        $this->command->info('Client: School (domain: school)');
        $this->command->info('Student: student@school.com (password: password)');
        $this->command->info('Teacher: teacher@school.com (password: password)');
        $this->command->info('Admin: admin@school.com (password: password)');
    }
}
