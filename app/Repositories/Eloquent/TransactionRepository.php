<?php

namespace App\Repositories\Eloquent;

use App\Models\Account;
use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    protected $model = Transaction::class;

    public function addCredit(int $accountId, float $amount): void
    {
        $account = Account::find($accountId);
        $account->balance += $amount;

        $updated = $account->update($account->toArray());
        if ($updated) {
            Transaction::create([
                'amount' => $amount,
                'type' => Transaction::CREDIT,
                'account_id' => $account->id
            ]);
        }
    }

    public function addDebit(int $accountId, float $amount): void
    {
        $account = Account::find($accountId);
        $account->balance -= $amount;
        $updated = $account->update($account->toArray());

        if ($updated) {
            Transaction::create([
                'amount' => $amount,
                'type' => Transaction::DEBIT,
                'account_id' => $account->id
            ]);
        }
    }
}

