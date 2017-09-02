<?php

namespace Meet\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * @property  link
 */
class InviteMember extends Mailable
{
    use Queueable, SerializesModels;

    public $link;

    public function __construct($link)
    {
        $this->link = $link;
    }


    public function build()
    {

        return $this->from('richie@streamupbox.com')

            ->view('emails.invitees.invite')->with([
                'invite_link' => $this->link
            ]);
    }
}
