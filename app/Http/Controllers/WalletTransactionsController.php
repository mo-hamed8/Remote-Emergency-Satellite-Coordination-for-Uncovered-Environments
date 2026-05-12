<?php

namespace App\Http\Controllers;

use App\Models\WalletTransaction;
use Illuminate\Http\Request;

class WalletTransactionsController extends Controller
{
    //
    public function walletTransaction($id)
    {
        $transactions = WalletTransaction::where('wallet_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'wallet_id' => $id,
            'transactions' => $transactions
        ]);
    }
}
