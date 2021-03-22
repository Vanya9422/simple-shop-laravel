<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

/**
 * Trait RemoveImage
 * @package App\Traits
 */
trait RemoveImage
{
    public static function boot() {
        parent::boot();
        static::deleting(function ($model) {
            removeImage(storage_path("app/public/{$model->url}"));
        });
    }
}
