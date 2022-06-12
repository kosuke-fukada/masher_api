<?php
declare(strict_types=1);

namespace App\Services\Inquiry\PostInquiry;

use App\Entities\Inquiry\Inquiry;
use App\Interfaces\Services\Inquiry\PostInquiry\SendInquiryMailServiceInterface;

class SendInquiryMailMockService implements SendInquiryMailServiceInterface
{
    /**
     * @param Inquiry $inquiry
     * @return void
     */
    public function sendMail(Inquiry $inquiry): void
    {
        //
    }
}
