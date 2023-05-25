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
        Schema::create('urunlers', function (Blueprint $table) {
                $table->id();
                $table->string('urun_ismi',999);
                $table->text('tanim')->nullable();
                $table->unsignedBigInteger('bolum_id');
                $table->foreign('bolum_id')->references('id')->on('bolumlers')->onDelete('cascade');// eger bir bolum sildim bu bolumun tu urunleri sil
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urunlers');
    }
};
