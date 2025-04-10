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
        'description',
        'performed_by',
        'cost',
        'next_follow_up',
        'notes',
        'attachments',
    ];

    protected $casts = [
        'record_date' => 'date',
        'next_follow_up' => 'date',
        'cost' => 'decimal:2',
    ];

    /**
     * Get the livestock that owns the health record.
     */
    public function livestock()
    {
        return $this->belongsTo(Livestock::class);
    }
}
