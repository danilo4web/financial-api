<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'balance',
        'customer_id',
        'account_number'
    ];

    public function balance(Account $account)
    {
        return $account->balance;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
