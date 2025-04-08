<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'location',
        'size',
        'description',
        'phone',
        'email',
    ];

    /**
     * Get the user that owns the farm.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the livestock for the farm.
     */
    public function livestock()
    {
        return $this->hasMany(Livestock::class);
    }
}
