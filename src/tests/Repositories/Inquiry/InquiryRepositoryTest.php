<?php
declare(strict_types=1);

namespace Tests\Repositories\Inquiry;

use App\Entities\Inquiry\Inquiry;
use Tests\TestCase;
use Tests\StrGenerator;
use App\ValueObjects\Inquiry\Body;
use App\ValueObjects\Inquiry\Name;
use App\ValueObjects\Inquiry\Email;
use App\Repositories\Inquiry\InquiryRepository;
use App\Interfaces\Repositories\Inquiry\InquiryRepositoryInterface;

class InquiryRepositoryTest extends TestCase
{
    /**
     * @return InquiryRepositoryInterface
     */
    public function test__construct(): InquiryRepositoryInterface
    {
        $inquiryRepository = $this->app->make(InquiryRepositoryInterface::class);
        $this->assertInstanceOf(InquiryRepository::class, $inquiryRepository);
        return $inquiryRepository;
    }

    /**
     * @depends test__construct
     * @param InquiryRepositoryInterface $inquiryRepository
     * @return void
     */
    public function testRegisterInquiry(InquiryRepositoryInterface $inquiryRepository): void
    {
        $name = StrGenerator::generateRandomString(Name::MAX_LENGTH);
        $email = 'test@example.local';
        $body = StrGenerator::generateRandomString(Body::MAX_LENGTH);
        $inquiry = new Inquiry(
            new Name($name),
            new Email($email),
            new Body($body)
        );
        $inquiryRepository->registerInquiry($inquiry);
        $createdInquiry = (new \App\Models\Inquiry())->newQuery()->first();
        $this->assertSame($name, (string)$createdInquiry->getAttribute('name'));
        $this->assertSame($email, (string)$createdInquiry->getAttribute('email'));
        $this->assertSame($body, (string)$createdInquiry->getAttribute('body'));
    }
}
