<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
