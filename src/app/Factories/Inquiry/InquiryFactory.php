<?php
declare(strict_types=1);

namespace App\Factories\Inquiry;

use App\Entities\Inquiry\Inquiry;
use App\Interfaces\Factories\Inquiry\InquiryFactoryInterface;
use App\ValueObjects\Inquiry\Name;
use App\ValueObjects\Inquiry\Email;
use App\ValueObjects\Inquiry\Body;

class InquiryFactory implements InquiryFactoryInterface
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
    ): Inquiry
    {
        return new Inquiry(
            $name,
            $email,
            $body
        );
    }
}
