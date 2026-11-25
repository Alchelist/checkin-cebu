<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends Model
{
    protected $fillable = [
        'event_id',
        'checked_in_by',
        'full_name',
        'email',
        'mobile',
        'ticket_code',
        'qr_token',
        'status',
        'waitlist_position',
        'registered_at',
        'checked_in_at',
        'cancelled_at',
    ];

    protected function casts(): array
    {
        return [
            'registered_at' => 'datetime',
            'checked_in_at' => 'datetime',
            'cancelled_at' => 'datetime',
            'waitlist_position' => 'integer',
        ];
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function checkedInBy(): BelongsTo
    {
        return $this->belongsTo(StaffUser::class, 'checked_in_by');
    }
}
