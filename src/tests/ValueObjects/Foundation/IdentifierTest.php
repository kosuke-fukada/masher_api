<?php
declare(strict_types=1);

namespace Tests\ValueObjects\Foundation;

use App\ValueObjects\Foundation\IntegerValueObject;
use App\ValueObjects\Foundation\Identifier;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class IdentifierTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = 1;
        $identifier = new Identifier($expected);
        $this->assertInstanceOf(IntegerValueObject::class, $identifier);
        $this->assertSame($expected, $identifier->toInt());
    }

    /**
     * @return void
     */
    public function testInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Identifier(0);
    }
}
