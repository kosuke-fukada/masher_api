<?php
declare(strict_types=1);

namespace Tests\ValueObjects\Inquiry;

use App\ValueObjects\Foundation\StringValueObject;
use App\ValueObjects\Inquiry\Name;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tests\StrGenerator;

class NameTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = StrGenerator::generateRandomString(Name::MAX_LENGTH);
        $name = new Name($expected);
        $this->assertInstanceOf(StringValueObject::class, $name);
        $this->assertSame($expected, (string)$name);
    }

    /**
     * @return void
     */
    public function testRequired(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Name('');
    }

    /**
     * @return void
     */
    public function testMaxLength(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Name(StrGenerator::generateRandomString(Name::MAX_LENGTH + 1));
    }
}
