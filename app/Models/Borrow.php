<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Borrow extends Model
{
    /** @use HasFactory<\Database\Factories\BorrowFactory> */
    use HasFactory;

    protected $fillable = [
        'student_id',
        'due_at',
        'notes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items() :BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'borrow_items')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
