<?php

use App\Models\Wallet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id('transaction_id');

            $table->foreignIdFor(Wallet::class);

            $table->string('type'); // deposit, withdraw, payment
            $table->decimal('amount', 10, 2);

            $table->decimal('before_balance', 10, 2);
            $table->decimal('after_balance', 10, 2);

            $table->string('reference_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_transactions');
    }
};
