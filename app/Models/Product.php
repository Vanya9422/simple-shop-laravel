<?php

namespace App\Models;

use App\Traits\Sluggable;
use App\Traits\UploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

/**
 * @property mixed user_id
 * @property mixed approved
 */
class Product extends Model
{
    use HasFactory, Sluggable, UploadFile, CascadesDeletes;

    const FILENAME = 'Product';

    /**
     * @var array
     */
    private $cascadeDeletes = ['images'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
        'status',
        'approved',
        'category_id',
        'user_id',
    ];

    /**
     * Get all of the post's comments.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Get all of the post's comments.
     */
    public function generalImage()
    {
        return $this->morphOne(Image::class, 'imageable')->where('is_primary', true);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('approved', 1)->where('status', 1);
    }

    /**
     * @param $query
     * @param array $columns
     * @return mixed
     */
    public static function scopeActiveCategory($query, array $columns = ['*'])
    {
        return $query->whereHas('category', $category = function ($cat) use ($columns) {
            $cat->select($columns)->where('status', 1);
        })->with(['category' => $category]);
    }
}
