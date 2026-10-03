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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('profile_image')->nullable();

            $table->string('license_number')->nullable();
            $table->string('qualification')->nullable();
            $table->string('specialization')->nullable();
            $table->string('experience_years')->nullable();

            $table->text('bio')->nullable();
            $table->decimal('consultation_fee', 8, 2)->default(0.00);
            $table->enum('status', ['0', '1'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
