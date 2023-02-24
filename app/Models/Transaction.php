<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    public const DEBIT = 'debit';
    public const CREDIT = 'credit';

    protected $fillable = [
        'amount',
        'type',
        'account_id'
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
