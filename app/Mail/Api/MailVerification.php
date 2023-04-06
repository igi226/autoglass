<?php

namespace App\Mail\Api;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailVerification extends Mailable
{
    use Queueable, SerializesModels;

   private $user_data;
   private $token;
    public function __construct( $user_data, $token)
    {
        $this->user_data = $user_data;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['user_data'] = $this->user_data;
        $data['token'] = $this->token;
        return $this->view('api.mailverification', $data);
    }
}
