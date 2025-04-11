<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'livestock_id',
        'record_date',
        'record_type',
        'diagnosis',
        'treatment',
        'medication',
        'dosage',
        'administered_by',
        'follow_up_date',
        'notes',
        'attachment',
    ];

    protected $casts = [
        'record_date' => 'date',
        'follow_up_date' => 'date',
    ];

    /**
     * Get the livestock that owns the health record.
     */
    public function livestock()
    {
        return $this->belongsTo(Livestock::class);
    }
}
