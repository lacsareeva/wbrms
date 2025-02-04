<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $status;
    public $reason;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $status
     * @param $reason
     */
    public function __construct($user, $status, $reason = null)
    {
        $this->user = $user;
        $this->status = $status;
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->status === 'rejected') {
            return $this->subject('Rejection Email')
                ->view('emails.reject-email')
                ->with([
                    'user' => $this->user,
                    'reason' => $this->reason,
                ]);
        }

        return $this->subject('Verification Email')
            ->view('emails.verify-email')
            ->with(['user' => $this->user]);
    }
}