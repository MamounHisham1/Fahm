<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(User::class)->where('role', UserRole::Student);
    }

    public function teachers(): HasMany
    {
        return $this->hasMany(User::class)->where('role', UserRole::Teacher);
    }

    public function admin(): HasOne
    {
        return $this->hasOne(User::class)->where('role', UserRole::Admin);
    }
}
