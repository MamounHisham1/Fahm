<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRole;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Cashier\Billable;

class User extends Authenticatable implements FilamentUser
{
    use Billable, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'client_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        if ($this->email === 'admin@admin.com') {
            return true;
        }

        if ($panel->getId() === 'dashboard') {
            return $this->role === UserRole::Admin || $this->role === UserRole::Teacher;
        }

        return false;
    }

    protected static function booted(): void
    {
        static::creating(function (User $user) {
            if ($user->role === UserRole::Teacher && request()->user()) {
                $user->client_id = request()->user()->client_id;
            }
        });
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function commentsLiked(): BelongsToMany
    {
        return $this->belongsToMany(Comment::class, 'comment_likes');
    }

    public function lessonsViewed(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class, 'lesson_viewed');
    }
}
