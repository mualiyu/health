<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'key',
        'value',
    ];

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class, 'Device_id');
    }
}
