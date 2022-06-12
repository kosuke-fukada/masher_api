<?php
declare(strict_types=1);

namespace Tests\Services\Inquiry\PostInquiry;

use App\Interfaces\Services\Inquiry\PostInquiry\SendInquiryMailServiceInterface;
use App\Services\Inquiry\PostInquiry\SendInquiryMailMockService;
use Tests\TestCase;

class SendInquiryMailServiceTest extends TestCase
{
    /**
     * @return SendInquiryMailServiceInterface
     */
    public function test__construct(): SendInquiryMailServiceInterface
    {
        $sendInquiryMailService = $this->app->make(SendInquiryMailServiceInterface::class);
        $this->assertInstanceOf(SendInquiryMailMockService::class, $sendInquiryMailService);
        return $sendInquiryMailService;
    }
}
