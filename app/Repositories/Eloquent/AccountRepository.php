<?php

namespace App\Repositories\Eloquent;

use App\Models\Account;
use App\Repositories\Contracts\AccountRepositoryInterface;

class AccountRepository implements AccountRepositoryInterface
{
    protected $model = Account::class;

    public function findAccountByNumber(int $accountNumber)
    {
        return Account::where('account_number', $accountNumber)->first();
    }

    public function getBalance(int $accountId): float
    {
        return Account::find($accountId)->value('balance');
    }

    public function addAccount(array $data)
    {
        $data['account_number'] = $this->generateAccountNumber();
        return Account::create($data);
    }

    private function generateAccountNumber(): int
    {
        return mt_rand(1000000000, 9999999999);
    }
}
