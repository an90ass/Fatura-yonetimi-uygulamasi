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
        Schema::create('faturalars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fatura_numarasi',50);
            $table->date('fatura_Tarihi');
            $table->date('Due_date')->nullable();
            $table->string('urun',50);
            $table->bigInteger( 'bolum_id' )->unsigned();
            $table->foreign('bolum_id')->references('id')->on('bolumlers')->onDelete('cascade');
            $table->decimal('Tahsilat_tutari',8,2)->nullable();;
            $table->decimal('Komisyon_tutari',8,2);
            $table->decimal('indirim',8,2);
            $table->string('KDV_orani', 999);//Rate_VAT
            $table->decimal('KDV_tutari',8,2);
            $table->decimal('Toplam',8,2);
            $table->string('durum', 50);
            $table->integer('Value_durum');
            $table->text('note')->nullable();
            $table->date('odeme_tarihi')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faturalars');
    }
};
