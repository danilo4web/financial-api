<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Repositories\Contracts\AccountRepositoryInterface;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class TransactionController extends Controller
{
    private TransactionRepositoryInterface $transactionRepository;
    private AccountRepositoryInterface $accountRepository;

    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        AccountRepositoryInterface $accountRepository,
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->accountRepository = $accountRepository;
    }

    public function history(int $accountNumber): JsonResponse
    {
        $account = $this->getAccount($accountNumber);

        $historical = $this->transactionRepository->getHistoryByAccountId($account->id);

        return response()->json(['data' => $historical], Response::HTTP_OK);
    }

    public function transfer(Request $request): JsonResponse
    {
        $data = $request->all();

        try {
            $accountFrom = $this->getAccount($data['from_account']);
            $accountTo = $this->getAccount($data['to_account']);

            $this->transactionRepository->addDebit($accountFrom->id, $data['amount']);
            $this->transactionRepository->addCredit($accountTo->id, $data['amount']);
        } catch(\DomainException $e) {
            return response()->json($e->getMessage(), Response::HTTP_CONFLICT);
        }

        return response()->json('Transfer successfully completed', Response::HTTP_OK);
    }

    private function getAccount(int $accountNumber)
    {
        return $this->accountRepository->findAccountByNumber($accountNumber);
    }
}
