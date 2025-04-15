<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory, HasSlug;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->name = $model->addTitle();
        });
    }
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
    
    protected function addTitle()
    {
        if($this->gender == 'male') {
            return 'Mr. ' . $this->name;
        } else {
            return 'Mrs. ' . $this->name;
        }
    }
}