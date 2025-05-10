<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory, HasSlug;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public static function booted(): void
    {
        if (Auth::check() && (Auth::user()->role === UserRole::Admin || Auth::user()->role === UserRole::Teacher)) {
            static::creating(function (Profile $profile) {
                $profile->client_id = Auth::user()->client_id;
            });
        }
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('user.name')
            ->saveSlugsTo('slug');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function client(): HasOne
    {
        return $this->hasOne(Client::class)->ofMany();
    }
}