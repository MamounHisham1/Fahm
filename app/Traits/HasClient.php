<?php

namespace App\Traits;

use App\Models\Client;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Context;

trait HasClient
{
    protected static function bootHasClient()
    {
        static::addGlobalScope('client', function ($builder) {
            if (Context::getHidden('client')) {
                $builder->where('client_id', Context::getHidden('client')->id);
            }
        });
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
