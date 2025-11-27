<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'total_quantity',
        'available_quantity',
        'image',
    ];

    public function borrowItems(): HasMany
    {
        return $this->hasMany(BorrowItem::class);
    }

    /**
     * Relasi ke Borrow melalui BorrowItem
     * Jadi bisa tahu item ini dipinjam pada siswa mana saja
     */
    public function borrows(): BelongsToMany
    {
        return $this->belongsToMany(Borrow::class, 'borrow_items')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
