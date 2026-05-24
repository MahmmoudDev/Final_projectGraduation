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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('service_provider_id');
            $table->enum(
                'service_type',
                [
                    'doctor',
                    'lawyer'
                ]
            );
            $table->string(
                'title'
            )->nullable();
            $table->text(
                'question'
            );
            $table->text(
                'answer'
            )->nullable();
            $table->enum(
                'status',
                [
                    'pending',
                    'answered',
                    'closed'
                ]
            )->default(
                'pending'
            );
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
