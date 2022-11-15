<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Models\Periode;
use App\Models\User;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use LDAP\Result;
use Pemilihan;

class VoteController extends Controller
{
    public function index()
    {
        $periode = Periode::first();
        $mulai = Carbon::parse($periode->mulai);
        $akhir = Carbon::parse($periode->akhir);
        $jam = Carbon::parse($periode->akhir);
        $kandidat = Kandidat::get();
        $now = Carbon::now();

        if ($now < $mulai) {
            $current = $now->diffForHumans($mulai);

            $data = explode(" ", $current);
            $data = $data[0] . " " . $data[1];
            $data = ucwords($data);

            return redirect('/')
            ->with('info', "Pemilu diadakan $data Lagi");
        }
        elseif ($now > $mulai && $akhir > $now) {
            $countKandidat = $kandidat->count();

            if ($countKandidat >= 2) {
                return view('vote.index', [
                    'kandidat' => $kandidat,
                ]);
            } else {
                return redirect('/')
                ->with('info', "Pemilu belum berjalan!");
            }
            
        }
        elseif ($now > $akhir) {
            $current = $now->diffForHumans($akhir);

            $data = explode(" ", $current);
            $data = $data[0] . " " . $data[1];
            $data = ucwords($data);
            return redirect('/')
            ->with('info', "Pemilu Berakhir $data Lalu");
        }

        
    }

    public function vote($id)
    {
        Vote::where('kandidat_id', $id)->increment('jml_pemilih');

        $user = Auth::user()->id;
        $update = User::find($user);
        $update->status = 'sudah';
        $update->save();

        return redirect('/')
        ->with('success', 'User Berhasil Memilih');
    }

    public function suara()
    {
        $data = Vote::orderBy('jml_pemilih', 'desc')->get();
        $jumlahSuara = Vote::get()->sum('jml_pemilih');
        if($jumlahSuara != 0 ){
            return view('vote.suara', [
                'data' => $data,
                'jumlah' => $jumlahSuara
             ]);
        } else {
            return redirect('/')
            ->with('info', "Perolehan Suara Belum Tersedia");   
        }
        
    }
}
