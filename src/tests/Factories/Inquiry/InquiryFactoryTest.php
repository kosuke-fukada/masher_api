<?php
declare(strict_types=1);

namespace Tests\Factories\Inquiry;

use App\Entities\Inquiry\Inquiry;
use App\Factories\Inquiry\InquiryFactory;
use App\Interfaces\Factories\Inquiry\InquiryFactoryInterface;
use App\ValueObjects\Inquiry\Body;
use App\ValueObjects\Inquiry\Email;
use App\ValueObjects\Inquiry\Name;
use Tests\StrGenerator;
use Tests\TestCase;

class InquiryFactoryTest extends TestCase
{
    /**
     * @return InquiryFactoryInterface
     */
    public function test__construct(): InquiryFactoryInterface
    {
        $factory = $this->app->make(InquiryFactoryInterface::class);
        $this->assertInstanceOf(InquiryFactory::class, $factory);
        return $factory;
    }

    /**
     * @depends test__construct
     * @param InquiryFactoryInterface $factory
     * @return void
     */
    public function testCreateInquiry(InquiryFactoryInterface $factory): void
    {
        $name = StrGenerator::generateRandomString(Name::MAX_LENGTH);
        $email = 'test@example.local';
        $body = StrGenerator::generateRandomString(Body::MAX_LENGTH);
        $inquiry = $factory->createInquiry(
            new Name($name),
            new Email($email),
            new Body($body)
        );
        $this->assertInstanceOf(Inquiry::class, $inquiry);
        $this->assertSame($name, (string)$inquiry->name());
        $this->assertSame($email, (string)$inquiry->email());
        $this->assertSame($body, (string)$inquiry->body());
    }
}
