<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bolumler extends Model
{
    //fillale benim hatam
protected $fillable=[
'bolum_ismi',
'tanim',
'Tarafindan_yaratildi',
];

}
