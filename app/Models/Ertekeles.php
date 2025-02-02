<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ertekeles extends Model
{
    use HasFactory;
    public function diak()
    {
        return $this->hasOne(Diak::class);
    }
    public function tantargy()
    {
        return $this->hasOne(Tantargy::class);
    }
    public function tanar()
    {
        return $this->hasOne(Tanar::class);
    }
}
