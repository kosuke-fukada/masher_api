<?php
declare(strict_types=1);

namespace Tests\Usecases\Inquiry\PostInquiry;

use App\Interfaces\Usecases\Inquiry\PostInquiry\PostInquiryInputPort;
use App\Usecases\Inquiry\PostInquiry\PostInquiryInput;
use App\ValueObjects\Inquiry\Body;
use App\ValueObjects\Inquiry\Email;
use App\ValueObjects\Inquiry\Name;
use PHPUnit\Framework\TestCase;
use Tests\StrGenerator;

class PostInquiryInputTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $name = StrGenerator::generateRandomString(Name::MAX_LENGTH);
        $email = 'test@example.local';
        $body = StrGenerator::generateRandomString(Body::MAX_LENGTH);
        $input = new PostInquiryInput(
            new Name($name),
            new Email($email),
            new Body($body)
        );
        $this->assertInstanceOf(PostInquiryInputPort::class, $input);
        $this->assertSame($name, (string)$input->name());
        $this->assertSame($email, (string)$input->email());
        $this->assertSame($body, (string)$input->body());
    }
}
