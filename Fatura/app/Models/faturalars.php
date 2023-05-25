<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class faturalars extends Model
{
        use SoftDeletes;

    protected $fillable = [

        'fatura_numarasi',
        'fatura_Tarihi',
        'Due_date',
        'urun',
        'bolum_id',
        'Tahsilat_tutari',
        'Komisyon_tutari',
        'indirim',
        'KDV_tutari',
        'KDV_orani',
        'Toplam',
        'durum',
        'Value_durum',
        'note',
        'odeme_tarihi',
    ];
     protected $dates = ['deleted_at'];

    public function bolumler()

        {
            return $this->belongsTo(bolumler::class, 'bolum_id');
        }}
