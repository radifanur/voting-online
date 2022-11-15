<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Pemilihan;

class DashboardController extends Controller
{
    public function index()
    {
        $kandidat = Kandidat::all();
        $totalPanitia = User::where('roles_id', 2)->count();
        $totalPemilih = User::where('roles_id', 3)->count();
        $totalBelumMemilih = User::where('status', 0)
                            ->where('roles_id', 3)
                            ->count();
        $totalSudah = User::where('status', 1)
                            ->where('roles_id', 3)
                            ->count();
        $pemilihan = Vote::get();
        $jumlahSuara = Vote::get()->sum('jml_pemilih');

        return view('dashboardAdmin', [
            'totalPanitia' => $totalPanitia,
            'totalPemilih' => $totalPemilih,
            'totalBelum' => $totalBelumMemilih,
            'totalSudah' => $totalSudah,
            'kandidat' => $kandidat,
            'vote' => $pemilihan,
            'jumlahSuara' => $jumlahSuara
        ]);
    }
}
