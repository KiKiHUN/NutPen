<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FelhTipus extends Model
{
    use HasFactory;
    public function diakok()
    {
        return $this->hasMany(Diak::class);
    }
    public function szulok()
    {
        return $this->hasMany(Szulo::class);
    }
    public function tanarok()
    {
        return $this->hasMany(Tanar::class);
    }
}
