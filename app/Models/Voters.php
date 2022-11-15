<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voters extends Model
{
    use HasFactory;

    protected $table = 'pemilih';
    protected $fillable = ['token','nama','periode_id','kelas_id'];

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
