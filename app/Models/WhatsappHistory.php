<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WhatsappHistory extends Model
{
    /** @use HasFactory<\Database\Factories\WhatsappHistoryFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'message',
        'sent_at',
        'status'
    ];

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
