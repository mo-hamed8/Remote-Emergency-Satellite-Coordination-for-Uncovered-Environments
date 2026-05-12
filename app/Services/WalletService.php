<?php

namespace App\Services;

use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;

class WalletService
{
    public function withdraw($walletId, $amount, $referenceId = null)
    {
        return DB::transaction(function () use ($walletId, $amount, $referenceId) {

            $wallet = Wallet::where('id', $walletId)
                ->lockForUpdate()
                ->first();

            if ($wallet->balance < $amount) {
                throw new \Exception("Insufficient balance");
            }

            $before = $wallet->balance;
            $after = $before - $amount;

            $wallet->update([
                'balance' => $after
            ]);

            return WalletTransaction::create([
                'wallet_id' => $wallet->id,
                'type' => 'withdraw',
                'amount' => $amount,
                'before_balance' => $before,
                'after_balance' => $after,
                'reference_id' => $referenceId,
            ]);
        });
    }

public function deposit($walletId, $amount, $referenceId = null)
    {
        return DB::transaction(function () use ($walletId, $amount, $referenceId) {

            $wallet = Wallet::where('id', $walletId)
                ->lockForUpdate()
                ->first();

            $before = $wallet->balance;
            $after = $before + $amount;

            $wallet->update([
                'balance' => $after
            ]);

            return WalletTransaction::create([
                'wallet_id' => $wallet->id,
                'type' => 'deposit',
                'amount' => $amount,
                'before_balance' => $before,
                'after_balance' => $after,
                'reference_id' => $referenceId,
            ]);
        });
    }
}

?>
