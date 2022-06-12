<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\Inquiry\PostInquiry;

interface PostInquiryInterface
{
    /**
     * @param PostInquiryInputPort $input
     * @return void
     */
    public function process(PostInquiryInputPort $input): void;
}
