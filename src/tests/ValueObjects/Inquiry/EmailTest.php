<?php
declare(strict_types=1);

namespace Tests\ValueObjects\Inquiry;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use App\ValueObjects\Inquiry\Email;
use App\ValueObjects\Foundation\StringValueObject;

class EmailTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = 'test@example.local';
        $email = new Email($expected);
        $this->assertInstanceOf(StringValueObject::class, $email);
        $this->assertSame($expected, (string)$email);
    }

    /**
     * @return void
     */
    public function testRequired(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Email('');
    }

    /**
     * @return void
     */
    public function testEmailFormat(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Email('test_invalid_format');
    }
}
