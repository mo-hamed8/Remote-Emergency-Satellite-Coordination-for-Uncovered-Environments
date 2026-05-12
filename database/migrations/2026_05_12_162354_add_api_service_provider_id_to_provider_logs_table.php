<?php

use App\Models\ApiServiceProvider;
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
        Schema::table('provider_logs', function (Blueprint $table) {
            //
            $table->foreignIdFor(ApiServiceProvider::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('provider_logs', function (Blueprint $table) {
            //
        });
    }
};
