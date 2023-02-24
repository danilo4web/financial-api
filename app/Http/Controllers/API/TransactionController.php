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

    public function transfer(Request $request)
    {
        $data = $request->all();

        $accountFrom = $this->getAccount($data['from_account']);
        $accountTo = $this->getAccount($data['to_account']);

        $this->transactionRepository->addDebit($accountFrom->id, $data['amount']);
        $this->transactionRepository->addCredit($accountTo->id, $data['amount']);

        return response()->json([], Response::HTTP_OK);
    }

    private function getAccount(int $accountNumber)
    {
        return $this->accountRepository->findAccountByNumber($accountNumber);
    }

    public function show(int $transactionId): JsonResponse
    {
        $transaction = $this->transactionRepository->find($transactionId);

        return response()->json(new TransactionResource($transaction), Response::HTTP_OK);
    }
}
