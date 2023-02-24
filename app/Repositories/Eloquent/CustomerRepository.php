<?php

namespace App\Repositories\Eloquent;

use App\Models\Account;
use App\Models\Customer;
use App\Repositories\Contracts\CustomerRepositoryInterface;

class CustomerRepository implements CustomerRepositoryInterface
{
    protected $model = Customer::class;

    public function find(int $customerId)
    {
        return Account::find($customerId);
    }
}
