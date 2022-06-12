<?php
declare(strict_types=1);

namespace Tests\Entities\Inquiry;

use App\Entities\Inquiry\Inquiry;
use App\ValueObjects\Inquiry\Body;
use App\ValueObjects\Inquiry\Email;
use App\ValueObjects\Inquiry\Name;
use PHPUnit\Framework\TestCase;
use Tests\StrGenerator;

class InquiryTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $name = StrGenerator::generateRandomString(Name::MAX_LENGTH);
        $email = 'test@example.local';
        $body = StrGenerator::generateRandomString(Body::MAX_LENGTH);
        $inquiry = new Inquiry(
            new Name($name),
            new Email($email),
            new Body($body)
        );
        $this->assertSame($name, (string)$inquiry->name());
        $this->assertSame($email, (string)$inquiry->email());
        $this->assertSame($body, (string)$inquiry->body());
    }
}
