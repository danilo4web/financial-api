<?php

namespace Tests\App\Http\Controllers\API;

use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Customer;
use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    use RefreshDatabase;

    protected Customer $customer;

    public function setUp(): void
    {
        parent::setUp();

        $this->customer = Customer::factory()->create();
    }

    public function testShouldTransferMoneyFromAccountToAnother()
    {
        $accountFrom = Account::factory()->create();
        $accountTo = Account::factory()->create();

        $payload = [
            'amount' => 10,
            'from_account' => $accountFrom->account_number,
            'to_account' => $accountTo->account_number
        ];

        $this->postJson("/api/v1/transfer", $payload)
            ->assertStatus(200);
    }

    public function testShouldNotTransferIfNoCreditEnough()
    {
        $accountFrom = Account::factory()->create();
        $accountTo = Account::factory()->create();

        $payload = [
            'amount' => $accountFrom->balance + 1,
            'from_account' => $accountFrom->account_number,
            'to_account' => $accountTo->account_number
        ];

        $this->postJson("/api/v1/transfer", $payload)
            ->assertStatus(409);
    }

    public function testShouldListTransactionsByAccount()
    {
        $accountFrom = Account::factory()->create();
        $accountTo = Account::factory()->create();

        $payload = [
            'amount' => 1,
            'from_account' => $accountFrom->account_number,
            'to_account' => $accountTo->account_number
        ];

        $this->postJson("/api/v1/transfer", $payload);
        $this->postJson("/api/v1/transfer", $payload);
        $this->postJson("/api/v1/transfer", $payload);

        $this->getJson('/api/v1/transactions/' . $accountFrom->account_number)
            ->assertJsonCount(3, 'data');
    }
}
