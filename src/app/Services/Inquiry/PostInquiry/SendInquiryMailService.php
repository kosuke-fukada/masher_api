<?php
declare(strict_types=1);

namespace App\Services\Inquiry\PostInquiry;

use App\Mail\InquiryMail;
use App\Entities\Inquiry\Inquiry;
use Illuminate\Support\Facades\Mail;
use App\Interfaces\Services\Inquiry\PostInquiry\SendInquiryMailServiceInterface;

class SendInquiryMailService implements SendInquiryMailServiceInterface
{
    /**
     * @param Inquiry $inquiry
     * @return void
     */
    public function sendMail(Inquiry $inquiry): void
    {
        $mail = Mail::to((string)$inquiry->email())
            ->bcc(config('mail.address'));
        $mail->send(new InquiryMail($inquiry));
    }
}
