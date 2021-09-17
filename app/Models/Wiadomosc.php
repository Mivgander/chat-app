<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wiadomosc extends Model
{
    use HasFactory;

    protected $table = 'wiadomosci';

    protected $fillable = [
        'rozmowa_id',
        'nadawca_id',
        'wiadomosc'
    ];

    public function nadawca()
    {
        return $this->belongsTo(User::class, 'nadawca_id', 'id');
    }

    public function rozmowa()
    {
        return $this->belongsTo(Rozmowa::class, 'rozmowa_id', 'id');
    }
}
