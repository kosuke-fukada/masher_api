<?php
declare(strict_types=1);

namespace App\Interfaces\Services\Inquiry\PostInquiry;

use App\Entities\Inquiry\Inquiry;

interface SendInquiryMailServiceInterface
{
    /**
     * @param Inquiry $inquiry
     * @return void
     */
    public function sendMail(Inquiry $inquiry): void;
}
