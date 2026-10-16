<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait HasCustomUuid
{
    /**
     * Boot the trait to automatically assign a UUID.
     */
    protected static function bootHasCustomUuid(): void
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * Get route key name for model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
