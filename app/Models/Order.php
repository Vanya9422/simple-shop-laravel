<?php

namespace App\Models;

use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed product
 * @property mixed user_id
 * @property mixed customer_id
 * @property mixed is_approved
 * @property mixed customer
 * @property mixed seller
 * @property mixed is_confirmed
 */
class Order extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'region',
        'message',
        'city',
        'address',
        'zip',
        'quantity',
        'is_confirmed',
        'is_approved',
        'arrival_confirmed',
        'customer_id',
        'product_id',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->last_name}";
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(User::class,'customer_id');
    }
}
