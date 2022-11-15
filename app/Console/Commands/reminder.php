<?php

namespace App\Console\Commands;

use App\Mail\MailReminder;
use Illuminate\Console\Command;
use App\Models\Periode;
use App\Models\User;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderMail;

class reminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:pemilu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminder Pemilu';

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
        $periode = Periode::first();
        $now = Carbon::now()->format('Y-m-d');
        $akhir = Carbon::parse($periode->akhir)->format('Y-m-d');
        $jumlah = Vote::get()->sum('jml_pemilih');
        $users = User::where('roles_id', 3)
                       ->whereNotNull('email')
                       ->where('status', 'belum')
                       ->get();
        $data = [
            'akhir' => Carbon::parse($periode->akhir)->format('d-M-Y H:i'),
            'tahun' => $periode->tahun
        ];

        if ($now == $akhir){
            foreach ($users as $user){
                Mail::to($user->email)->send(new MailReminder($data));
            }
        }
    }
}
