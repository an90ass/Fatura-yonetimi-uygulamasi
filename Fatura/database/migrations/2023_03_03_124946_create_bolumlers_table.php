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
        Schema::create('bolumlers', function (Blueprint $table) {
            $table->id();
            $table->string('bolum_ismi',999);
            $table->text('tanim')->nullable();
            $table->string('Tarafindan_yaratildi',999);//Created_by
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bolumlers');
    }
};
