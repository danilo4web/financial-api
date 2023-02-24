<?php

namespace Tests\App\Http\Controllers\API;

use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Customer;
use Tests\TestCase;

class AccountControllerTest extends TestCase
{
    use RefreshDatabase;

    protected Customer $customer;

    public function setUp(): void
    {
        parent::setUp();

        $this->customer = Customer::factory()->create();
    }

    public function testShouldCreateANewAccount()
    {
        $payload = [
            'customer_id' => $this->customer->id,
            'balance' => '10'
        ];

        $this->postJson("/api/v1/accounts", $payload)
            ->assertStatus(201);
    }

    public function testShouldGetBalance()
    {
        $account = Account::factory()->create();

        $this->getJson("/api/v1/accounts/balance/" . $account->account_number)
            ->assertJson([
                'accountId' => $account->id,
                'balance' => $account->balance
            ])
        ->assertStatus(200);
    }
}
