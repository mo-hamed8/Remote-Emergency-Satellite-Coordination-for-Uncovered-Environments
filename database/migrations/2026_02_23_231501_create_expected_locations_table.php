<?php

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
        Schema::create('expected_locations', function (Blueprint $table) {
            $table->id();
            $table->json('coordinates');
            $table->text("note")->nullable();
            $table->foreignIdFor(User::class,"added_by");
            $table->foreignIdFor(SearchCase::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expected_locations');
    }
};
