<?php
declare(strict_types=1);

namespace Tests\Usecases\Inquiry\PostInquiry;

use App\Interfaces\Usecases\Inquiry\PostInquiry\PostInquiryInterface;
use App\Models\Inquiry;
use App\Usecases\Inquiry\PostInquiry\PostInquiry;
use App\Usecases\Inquiry\PostInquiry\PostInquiryInput;
use App\ValueObjects\Inquiry\Body;
use App\ValueObjects\Inquiry\Email;
use App\ValueObjects\Inquiry\Name;
use Tests\StrGenerator;
use Tests\TestCase;

class PostInquiryTest extends TestCase
{
    /**
     * @return PostInquiryInterface
     */
    public function test__construct(): PostInquiryInterface
    {
        $postInquiry = $this->app->make(PostInquiryInterface::class);
        $this->assertInstanceOf(PostInquiry::class, $postInquiry);
        return $postInquiry;
    }

    /**
     * @depends test__construct
     * @param PostInquiryInterface $postInquiry
     * @return void
     */
    public function testProcess(PostInquiryInterface $postInquiry): void
    {
        $name = StrGenerator::generateRandomString(Name::MAX_LENGTH);
        $email = 'test@example.local';
        $body = StrGenerator::generateRandomString(Body::MAX_LENGTH);
        $input = new PostInquiryInput(
            new Name($name),
            new Email($email),
            new Body($body)
        );
        $postInquiry->process($input);
        $postedInquiry = (new Inquiry())->newQuery()->latest('created_at')->first();
        $this->assertSame($name, (string)$postedInquiry->getAttribute('name'));
        $this->assertSame($email, (string)$postedInquiry->getAttribute('email'));
        $this->assertSame($body, (string)$postedInquiry->getAttribute('body'));
    }
}
