<?php

namespace App\Traits;

trait Sluggable
{
    /**
     * Boot the model.
     */
    protected static function bootSluggable()
    {
        static::creating(function ($model) {
            $model->slug = slug_generate();
        });
    }
}
