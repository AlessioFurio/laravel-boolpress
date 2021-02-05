<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageFromWebsite extends Mailable
{
    use Queueable, SerializesModels;

    public $lead; //creo nuova variabile d istanza

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_lead) // parametro che ricevo da ->send(new MessageFromWebsite($new_lead)) nel home controller $_lead e' un nome che do io
    {
        $this->lead = $_lead; // ora all'interno della view message-request posso utilizzare $lead;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->replyTo($this->lead->email)->view('emails.message-request'); //qui passo la view creata appositamente che conterra' il messaggio della mail
    }
}
