<?php

namespace App\Models;

use Facade\Ignition\Tabs\Tab;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pemilihan;

class Kandidat extends Model
{
    use HasFactory;

    protected $table = 'kandidat';
    protected $fillable = [
        'ketua',
        'wakil',
        'deskripsi',
        'image',
        'periode_id',
    ];

    public function pemilihan(){
        return $this->belongsTo(Vote::class);
    }

    public function periode(){
        return $this->belongsTo(Periode::class);
    }

    public function vote(){
        return $this->belongsTo(Vote::class);
    }
}
