<?php

namespace App\Repositories\Contracts;

interface AccountRepositoryInterface
{
    public function getBalance(int $accountId);

    public function addAccount(array $data);

    public function updateBalance(int $accountId, float $amount);

    public function findAccountByNumber(int $accountNumber);
}
