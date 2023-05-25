<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class faturalar_details extends Model
{
    protected $fillable = [
        'id_fatura',
        'fatura_numarasi',
        'urun',
        'bolum',
        'durum',
        'Value_durumu',
        'note',
        'kullanci',
        'odeme_tarihi',
    ];}
