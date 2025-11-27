<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BorrowItem extends Model
{
    /** @use HasFactory<\Database\Factories\BorrowItemFactory> */
    use HasFactory;
    
    protected $fillable = [
        'borrow_id', 'item_id', 'quantity', 'is_returned'
    ];

    public function borrow() :BelongsTo
    {
        return $this->belongsTo(Borrow::class);
    }

    public function item() :BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
