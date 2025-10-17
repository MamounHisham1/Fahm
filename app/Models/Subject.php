<?php

namespace App\Models;

use App\Traits\HasClient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Subject extends Model
{
    use HasClient, HasFactory, HasSlug;

    protected $fillable = ['name', 'slug', 'client_id'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
