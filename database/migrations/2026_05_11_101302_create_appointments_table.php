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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('service_provider_id');
            $table->enum('service_type', [
                'doctor',
                'lawyer'
            ]);
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->enum('status', [
                'pending',
                'approved',
                'completed',
                'cancelled'
            ])->default('pending');
            $table->text('notes')
                ->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
