<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->from('richalive158@gmail.com', 'SwiftFlings')
                ->view('layouts.invoice_mail')
                ->attach('public/download.png')
                ->with([
                        'first_name' => 'Irshad',
                    ]);
    }







}
