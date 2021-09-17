<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uczestnik extends Model
{
    use HasFactory;

    protected $table = 'uczestnicy';

    protected $fillable = [
        'rozmowa_id',
        'user_id'
    ];

    public function rozmowa()
    {
        return $this->belongsTo(Rozmowa::class, 'rozmowa_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
