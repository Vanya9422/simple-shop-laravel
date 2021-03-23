<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'message',
        'context',
        'level',
        'channel',
        'record_datetime',
        'extra',
        'formatted',
        'remote_addr',
        'user_agent',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'context' => 'array',
        'extra' => 'array'
    ];

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param $value
     * @return string
     */
    protected function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::now('GMT+4')->format(GlobalDateFormat);
    }
}
