<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Periode;
use App\Models\Voters;
use Illuminate\Http\Request;

class VotersController extends Controller
{
    public function index()
    {
        $pemilih = Voters::paginate(7);
        $kelas = Kelas::all();
        $periode = Periode::all();
        return view('pemilih.index',[
            'pemilih' => $pemilih,
            'kelas' => $kelas,
            'periode' => $periode
        ]);
    }

    public function pemilihStore(Request $request)
    {
        // dd($request->all());
        $jumlah = $request->jumlah;
        for ($i=0; $i < $jumlah ; $i++) { 
            $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $string = '';

            for ($x=0; $x < 6 ; $x++) { 
                $k = rand(0, strlen($karakter)-1);
                $string .= $karakter[$k];
            }
            $token = strtoupper($string);

            $cek = Voters::find($token);
            
            if (empty($cek)){
                Voters::create([
                    'token' => $token,
                    'periode_id' => $request->periode,
                    'kelas_id' => $request->kelas
                ]);
            }
        }

        return redirect()->route('pemilih.index')
        ->with('success', 'Pemilih Berhasil Ditambahkan');
        
    }
}
