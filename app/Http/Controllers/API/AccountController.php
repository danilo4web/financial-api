<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccountResource;
use App\Repositories\Contracts\AccountRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountController extends Controller
{
    private AccountRepositoryInterface $accountRepository;

    public function __construct(
        AccountRepositoryInterface $accountRepository,
    ) {
        $this->accountRepository = $accountRepository;
    }

    public function createAccount(Request $request): JsonResponse
    {
        $data = $request->all();

        $response = $this->accountRepository->addAccount($data);

        return response()->json(
            'Created Account Number: ' . $response->account_number,
            Response::HTTP_CREATED
        );
    }

    public function balance(int $accountNumber): JsonResponse
    {
        $account = $this->accountRepository->findAccountByNumber($accountNumber);

        $responseData = [
            'accountId' => $account->id,
            'balance' => $account->balance
        ];

        return response()->json($responseData, Response::HTTP_OK);
    }
}
