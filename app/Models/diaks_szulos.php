<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diaks_szulos extends Model
{
    use HasFactory;
    public function diak()
    {
        return $this->hasOne(Diak::class);
    }
    public function szulo()
    {
        return $this->hasOne(Szulo::class);
    }
}
