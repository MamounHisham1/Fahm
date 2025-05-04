<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClientProfile extends Pivot
{
    protected $table = 'client_profile';
    protected $fillable = ['client_id', 'profile_id', 'role'];
    public $timestamps = false;
    protected $primaryKey = ['client_id', 'profile_id'];
}
