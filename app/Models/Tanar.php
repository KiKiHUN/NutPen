<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanar extends Model
{
    use HasFactory;
    protected $fillable = [
        'azonosito',
        'jelszo',
        'vnev',
        'knev' ,
        'felh_tipus_ID',
      ];
      protected $primaryKey = 'azonosito';
      public $incrementing = false;
      protected $keyType="string";
}

