<?php
declare(strict_types=1);

namespace App\Interfaces\Repositories\Inquiry;

use App\Entities\Inquiry\Inquiry;

interface InquiryRepositoryInterface
{
    /**
     * @param Inquiry $inquiry
     * @return void
     */
    public function registerInquiry(Inquiry $inquiry): void;
}
