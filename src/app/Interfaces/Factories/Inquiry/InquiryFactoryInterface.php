<?php
declare(strict_types=1);

namespace App\Interfaces\Factories\Inquiry;

use App\Entities\Inquiry\Inquiry;
use App\ValueObjects\Inquiry\Body;
use App\ValueObjects\Inquiry\Email;
use App\ValueObjects\Inquiry\Name;

interface InquiryFactoryInterface
{
    /**
     * @param Name $name
     * @param Email $email
     * @param Body $body
     * @return Inquiry
     */
    public function createInquiry(
        Name $name,
        Email $email,
        Body $body
    ): Inquiry;
}
