<?php

namespace App\Filament\Resources\AssignmentSubmissionResource\Pages;

use App\Filament\Resources\AssignmentSubmissionResource;
use App\Models\AssignmentGrade;
use App\Models\AssignmentSubmission;
use App\Notifications\AssignmentGraded;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class GradeAssignmentSubmission extends Page
{
    protected static string $resource = AssignmentSubmissionResource::class;

    protected static string $view = 'filament.resources.assignment-submission-resource.pages.grade-assignment-submission';

    public AssignmentSubmission $record;

    public ?array $data = [];

    public function mount(AssignmentSubmission $record): void
    {
        $this->record = $record;

        // Load existing grade if it exists
        $existingGrade = $record->grades->first();

        $this->form->fill([
            'score' => $existingGrade?->score ?? '',
            'feedback' => $existingGrade?->feedback ?? '',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Assignment Information')
                    ->schema([
                        Forms\Components\TextInput::make('assignment_title')
                            ->label('Assignment')
                            ->disabled()
                            ->default($this->record->assignment->title),
                        Forms\Components\TextInput::make('student_name')
                            ->label('Student')
                            ->disabled()
                            ->default($this->record->user->name),
                        Forms\Components\TextInput::make('max_score')
                            ->label('Maximum Score')
                            ->disabled()
                            ->default($this->record->assignment->max_score),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Submission Details')
                    ->schema([
                        Forms\Components\View::make('submission-preview')
                            ->view('filament.resources.assignment-submission-resource.components.submission-preview')
                            ->viewData([
                                'submission' => $this->record,
                            ]),
                    ]),

                Forms\Components\Section::make('Grading')
                    ->schema([
                        Forms\Components\TextInput::make('score')
                            ->label('Score')
                            ->numeric()
                            ->required()
                            ->minValue(0)
                            ->maxValue(fn () => $this->record->assignment->max_score)
                            ->step(0.1)
                            ->suffix("/ {$this->record->assignment->max_score}"),
                        Forms\Components\Textarea::make('feedback')
                            ->label('Feedback')
                            ->rows(4)
                            ->placeholder('Provide constructive feedback for the student...'),
                    ]),
            ])
            ->statePath('data');
    }

    public function getTitle(): string|Htmlable
    {
        return "Grade Submission: {$this->record->assignment->title}";
    }

    public function getSubheading(): string|Htmlable|null
    {
        return "Student: {$this->record->user->name}";
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label('Back to Submissions')
                ->url(AssignmentSubmissionResource::getUrl('index'))
                ->color('gray'),
        ];
    }

    public function saveGrade(): void
    {
        $this->form->validate();

        $data = $this->form->getState();

        // Create or update the grade
        $grade = AssignmentGrade::updateOrCreate(
            [
                'submission_id' => $this->record->id,
                'user_id' => auth()->id(), // The teacher grading the assignment
            ],
            [
                'score' => $data['score'],
                'feedback' => $data['feedback'],
            ]
        );

        // Notify the student about the grade
        // Temporarily disabled for testing
        // $this->record->user->notify(new AssignmentGraded($grade));

        Notification::make()
            ->title('Grade Saved Successfully')
            ->success()
            ->send();

        $this->redirect(AssignmentSubmissionResource::getUrl('index'));
    }
}
