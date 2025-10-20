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

        $existingGrade = $record->grades->first();

        $this->form->fill([
            'assignment' => $this->record->assignment->title ?? '',
            'student' => $this->record->user->name ?? '',
            'max_score' => $this->record->assignment->max_score ?? '',
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
                        Forms\Components\TextInput::make('assignment')
                            ->label('Assignment')
                            ->readOnly(),
                        Forms\Components\TextInput::make('student')
                            ->label('Student')
                            ->readOnly(),
                        Forms\Components\TextInput::make('max_score')
                            ->label('Maximum Score')
                            ->readOnly(),
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
        return "Submission: {$this->record->assignment->title}";
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

        $grade = AssignmentGrade::updateOrCreate(
            [
                'submission_id' => $this->record->id,
                'user_id' => $this->record->user->id,
            ],
            [
                'score' => $data['score'],
                'feedback' => $data['feedback'],
            ]
        );

        $this->record->user->notify(new AssignmentGraded($grade));

        Notification::make()
            ->title('Grade Saved Successfully')
            ->success()
            ->send();

        $this->redirect(AssignmentSubmissionResource::getUrl('index'));
    }
}
