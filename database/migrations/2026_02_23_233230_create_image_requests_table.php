<?php

use App\Models\ApiServiceProvider;
use App\Models\SearchCase;
use App\Models\User;
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
        Schema::create('image_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SearchCase::class);
            $table->foreignIdFor(User::class,"requested_by");
            $table->foreignIdFor(ApiServiceProvider::class);
            $table->enum('status', ['pending', 'processing', 'completed', 'failed', 'canceled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_requests');
    }
};
