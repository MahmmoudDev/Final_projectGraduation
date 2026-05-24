<?php

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
        //
        Schema::create('reviews', function (Blueprint $table) {

            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('service_provider_id');
            $table->enum('service_type', ['doctor', 'lawyer']);
            $table->tinyInteger('rating');
            $table->text('review')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
