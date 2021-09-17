<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rozmowa extends Model
{
    use HasFactory;

    protected $table = 'rozmowy';

    public function wiadomosci()
    {
        return $this->hasMany(Wiadomosc::class, 'rozmowa_id');
    }

    public function uczestnicy()
    {
        return $this->hasMany(Uczestnik::class, 'rozmowa_id');
    }
}
