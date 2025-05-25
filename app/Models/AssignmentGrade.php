<?php

namespace App\Models;

use App\Traits\HasClient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssignmentGrade extends Model
{
    use HasFactory, HasClient;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'score' => 'decimal:1',
        'max_score' => 'decimal:1',
    ];

    public function submission(): BelongsTo
    {
        return $this->belongsTo(AssignmentSubmission::class, 'submission_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
