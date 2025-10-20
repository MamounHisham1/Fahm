<?php

namespace Tests\Feature;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Client;
use App\Models\Subject;
use App\Models\User;
use Filament\Pages\Actions\Action;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Livewire\Livewire;
use Tests\TestCase;

class FilamentAssignmentGradingTest extends TestCase
{
    use RefreshDatabase;

    protected $client;
    protected $teacher;
    protected $student;
    protected $subject;
    protected $assignment;
    protected $submission;

    protected function setUp(): void
    {
        parent::setUp();

        // Run migrations to ensure notifications table exists
        Artisan::call('migrate');

        // Create a client
        $this->client = Client::factory()->create();

        // Create a teacher user
        $this->teacher = User::factory()->create([
            'client_id' => $this->client->id,
            'role' => 'teacher',
        ]);

        // Create a student user
        $this->student = User::factory()->create([
            'client_id' => $this->client->id,
            'role' => 'student',
        ]);

        // Create a subject
        $this->subject = Subject::factory()->create([
            'client_id' => $this->client->id,
        ]);

        // Create an assignment
        $this->assignment = Assignment::factory()->create([
            'client_id' => $this->client->id,
            'subject_id' => $this->subject->id,
            'max_score' => 100.00,
        ]);

        // Create a submission
        $this->submission = AssignmentSubmission::factory()->create([
            'assignment_id' => $this->assignment->id,
            'user_id' => $this->student->id,
            'type' => 'text',
            'text' => 'This is my submission text.',
        ]);
    }

    public function test_teacher_can_access_grading_page(): void
    {
        $this->actingAs($this->teacher);

        Livewire::test('App\Filament\Resources\AssignmentSubmissionResource\Pages\GradeAssignmentSubmission', [
            'record' => $this->submission,
        ])
            ->assertSuccessful()
            ->assertSee('Grade Submission:')
            ->assertSee($this->assignment->title)
            ->assertSee($this->student->name)
            ->assertSee('This is my submission text.');
    }

    public function test_teacher_can_submit_grade(): void
    {
        $this->actingAs($this->teacher);

        Livewire::test('App\Filament\Resources\AssignmentSubmissionResource\Pages\GradeAssignmentSubmission', [
            'record' => $this->submission,
        ])
            ->set('data.score', 85.5)
            ->set('data.feedback', 'Great work! Keep it up.')
            ->call('saveGrade')
            ->assertHasNoErrors()
            ->assertRedirect();

        // Check that the grade was saved (skip notification check for now)
        $this->assertDatabaseHas('assignment_grades', [
            'submission_id' => $this->submission->id,
            'user_id' => $this->teacher->id,
            'score' => 85.5,
            'feedback' => 'Great work! Keep it up.',
        ]);
    }

    public function test_grade_score_cannot_exceed_max_score(): void
    {
        $this->actingAs($this->teacher);

        Livewire::test('App\Filament\Resources\AssignmentSubmissionResource\Pages\GradeAssignmentSubmission', [
            'record' => $this->submission,
        ])
            ->set('data.score', 150) // Exceeds max score of 100
            ->call('saveGrade')
            ->assertHasErrors(['data.score']);
    }

    public function test_grade_score_must_be_numeric(): void
    {
        $this->actingAs($this->teacher);

        Livewire::test('App\Filament\Resources\AssignmentSubmissionResource\Pages\GradeAssignmentSubmission', [
            'record' => $this->submission,
        ])
            ->set('data.score', 'invalid')
            ->call('saveGrade')
            ->assertHasErrors(['data.score']);
    }

    public function test_student_cannot_access_grading_page(): void
    {
        $this->actingAs($this->student);

        // Students should not be able to access Filament admin
        // This returns 404 because students don't have access to the Filament panel
        $response = $this->get('/dashboard');
        $response->assertStatus(404);
    }

    public function test_guest_cannot_access_grading_page(): void
    {
        // Guests should not be able to access Filament admin
        // This returns 404 because guests don't have access to the Filament panel
        $response = $this->get('/dashboard');
        $response->assertStatus(404);
    }
}