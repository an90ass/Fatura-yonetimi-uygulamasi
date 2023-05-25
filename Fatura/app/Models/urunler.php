<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class urunler extends Model
{
    protected $fillable=[
        'urun_ismi',
        'tanim',
        'bolum_id',
        ];
        public function bolumler()

        {
            return $this->belongsTo(bolumler::class, 'bolum_id');
        }
    }
