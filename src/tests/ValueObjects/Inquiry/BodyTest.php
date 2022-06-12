<?php
declare(strict_types=1);

namespace Tests\ValueObjects\Inquiry;

use Tests\StrGenerator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use App\ValueObjects\Inquiry\Body;
use App\ValueObjects\Foundation\StringValueObject;

class BodyTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = StrGenerator::generateRandomString(Body::MAX_LENGTH);
        $name = new Body($expected);
        $this->assertInstanceOf(StringValueObject::class, $name);
        $this->assertSame($expected, (string)$name);
    }

    /**
     * @return void
     */
    public function testRequired(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Body('');
    }

    /**
     * @return void
     */
    public function testMaxLength(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Body(StrGenerator::generateRandomString(Body::MAX_LENGTH + 1));
    }
}
