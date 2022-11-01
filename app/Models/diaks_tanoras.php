<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diaks_tanoras extends Model
{
    use HasFactory;
    public function diak()
    {
        return $this->hasOne(Diak::class);
    }
    public function tanora()
    {
        return $this->hasOne(Tanora::class);
    }
}
