<?php

namespace App\Console\Commands;

use App\Mail\Email;
use App\Mail\Pemberitahuan;
use App\Models\Periode;
use App\Models\User;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Notif extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notif:periode';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notif Berakhirnya Pemilu';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $data = [
        //     'nama' => 'Radifan Nur Aflah',
        // ];
        $periode = Periode::first();
        $now = Carbon::now()->format('Y-m-d');
        $akhir = Carbon::parse($periode->akhir)->format('Y-m-d');
        $jumlah = Vote::get()->sum('jml_pemilih');
        $users = User::where('roles_id', 3)->whereNotNull('email')->get();
        $data = Vote::orderBy('jml_pemilih', 'desc')->get();

        if ($now == $akhir) {
            foreach ($users as $user){
                Mail::to($user->email)->send(new Pemberitahuan($data, $jumlah, $periode));
            }
            $this->info('Berhasil!');
        } else {
            $this->info('Gagal');
        }

    }
}
