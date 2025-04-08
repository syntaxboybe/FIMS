<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivestockCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'species',
        'description',
        'image',
    ];

    /**
     * Get the livestock for the category.
     */
    public function livestock()
    {
        return $this->hasMany(Livestock::class);
    }
}
