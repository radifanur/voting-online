<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Pemberitahuan extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $jumlah;
    public $periode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $jumlah, $periode)
    {
        $this->data = $data;
        $this->jumlah = $jumlah;
        $this->periode = $periode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.pemberitahuan')
        ->subject('Pemberitahuan Pemilu')->from('hmti@gmail.com', 'HMTI')
        ->with('data', $this->data,
               'jumlah', $this->jumlah,
               'periode', $this->periode);
    }
}
