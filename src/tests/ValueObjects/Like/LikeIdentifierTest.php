<?php
declare(strict_types=1);

namespace Tests\ValueObjects\Like;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use App\ValueObjects\Like\LikeIdentifier;
use App\ValueObjects\Foundation\IntegerValueObject;

class LikeIdentifierTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = 1;
        $identifier = new LikeIdentifier($expected);
        $this->assertInstanceOf(IntegerValueObject::class, $identifier);
        $this->assertSame($expected, $identifier->toInt());
    }

    /**
     * @return void
     */
    public function testInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new LikeIdentifier(0);
    }
}
