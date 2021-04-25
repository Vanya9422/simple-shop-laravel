<?php

namespace App\Traits;

trait Sluggable
{
    /**
     * Boot the model.
     */
    protected static function bootSluggable()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = slug_generate();
        });
    }
}
