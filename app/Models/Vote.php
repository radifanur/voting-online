<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'pemilihan';

    protected $fillable = [
        'kandidat_id', 'periode_id', 'jml_pemilih'
    ];

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
    public function kandidat()
    {
        return $this->belongsTo(Kandidat::class);
    }


    use HasFactory;
}
