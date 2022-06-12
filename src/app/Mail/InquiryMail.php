<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Entities\Inquiry\Inquiry;
use Illuminate\Queue\SerializesModels;

class InquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Inquiry
     */
    private Inquiry $inquiry;

    /**
     * @param Inquiry $inquiry
     */
    public function __construct(Inquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    /**
     * @return $this
     */
    public function build()
    {
        return $this->subject('【Masher】お問い合わせを受け付けました')
            ->view('email.inquiry')
            ->with([
                'name' => (string)$this->inquiry->name(),
                'email' => (string)$this->inquiry->email(),
                'body' => (string)$this->inquiry->body(),
                'webUrl' => config('app.web_url')
            ]);
    }
}
