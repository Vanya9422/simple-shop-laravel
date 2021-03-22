<?php

namespace App\Models;

use App\Traits\RemoveImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed product
 * @property mixed imageable
 */
class Image extends Model
{
    use HasFactory, RemoveImage;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['url','is_primary'];

    /**
     * Get the parent commentable model (post or video).
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
