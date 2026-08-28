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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string("hospital_name");
            $table->string("logo")->nullable();
            $table->string("phone");
            $table->string("email");
            $table->string("address");
            $table->text("description")->nullable();
            $table->string("facebook")->nullable();
            $table->string("instagram")->nullable();
            $table->enum('status',["0","1"])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
