<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livestock extends Model
{
    use HasFactory;

    protected $table = 'livestocks';

    protected $fillable = [
        'farm_id',
        'livestock_category_id',
        'tag_number',
        'name',
        'gender',
        'birth_date',
        'breed',
        'color',
        'weight',
        'notes',
        'image',
        'status',
        'purchase_date',
        'purchase_price',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'purchase_date' => 'date',
        'weight' => 'decimal:2',
        'purchase_price' => 'decimal:2',
    ];

    /**
     * Get the farm that owns the livestock.
     */
    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    /**
     * Get the category that owns the livestock.
     */
    public function category()
    {
        return $this->belongsTo(LivestockCategory::class, 'livestock_category_id');
    }

    /**
     * Get the health records for the livestock.
     */
    public function healthRecords()
    {
        return $this->hasMany(HealthRecord::class);
    }
}
