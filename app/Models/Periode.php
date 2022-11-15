<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pemilihan;

class Periode extends Model
{
    protected $table = 'periode';
    protected $fillable = [
        'tahun', 'mulai', 'akhir'
    ];

    public function voters(){
        return $this->hasMany(User::class);
    }

    public function kandidat(){
        return $this->hasMany(Kandidat::class);
    }

    public function pemilihan(){
        return $this->hasMany(Vote::class);
    }
}
