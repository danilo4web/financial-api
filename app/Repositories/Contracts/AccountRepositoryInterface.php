<?php

namespace App\Repositories\Contracts;

interface AccountRepositoryInterface
{
    public function getBalance(int $accountId): float;

    public function addAccount(array $data);

    public function findAccountByNumber(int $accountNumber);
}
