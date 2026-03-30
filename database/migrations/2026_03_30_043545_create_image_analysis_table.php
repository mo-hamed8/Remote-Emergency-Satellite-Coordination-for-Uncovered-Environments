<?php

use App\Models\SateliteImage;
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
        Schema::create('image_analysis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SateliteImage::class, 'image_id');
            $table->foreignIdFor(User::class,"analyzed_by");

            $table->string('point')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_analysis');
    }
};
