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
        Schema::create('faturalar_details', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('id_fatura');
            $table->string('fatura_numarasi', 50);
            $table->foreign('id_fatura')->references('id')->on('faturalars')->onDelete('cascade');
            $table->string('urun', 50);
            $table->string('bolum', 999);
            $table->string('Durum', 50);
            $table->integer('value_durumu');
            $table->date('odeme_tarihi')->nullable();
            $table->text('note')->nullable();
            $table->string('kullanci',300);
            $table->timestamps();
    });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('faturalar_details');
    }
};
