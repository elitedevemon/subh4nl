<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class MyTestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $sst = \App\Models\setting::find(1);
        return $this->from($address = 'info@restaurantrajmahal.fr', $name = $this->details['sender'])
                    ->attach($this->details['attc'])
                    // ->attach('storage/upload/logo/' . $sst->logo)
                    ->subject($this->details['title'])
                    ->view('myTestMail');
    }
}