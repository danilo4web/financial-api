<?php

namespace App\Repositories\Contracts;

interface TransactionRepositoryInterface
{
    public function addCredit(int $accountId, float $amount);

    public function addDebit(int $accountId, float $amount);
}
