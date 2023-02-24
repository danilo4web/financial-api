<?php

namespace App\Repositories\Contracts;

interface CustomerRepositoryInterface
{
    public function find(int $id);
}
