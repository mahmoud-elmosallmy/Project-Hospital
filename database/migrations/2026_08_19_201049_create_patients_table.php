<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->date('date_of_birth');
            $table->enum("gender", ["male", "female"])->default("male");
            $table->string('blood_type');
            $table->text('address')->nullable();
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
