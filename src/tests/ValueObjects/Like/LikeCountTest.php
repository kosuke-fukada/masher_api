<?php
declare(strict_types=1);

namespace Tests\ValueObjects\Like;

use App\ValueObjects\Foundation\IntegerValueObject;
use App\ValueObjects\Like\LikeCount;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class LikeCountTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = 0;
        $likeCount = new LikeCount($expected);
        $this->assertInstanceOf(IntegerValueObject::class, $likeCount);
        $this->assertSame($expected, $likeCount->toInt());
    }

    /**
     * @return void
     */
    public function testInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new LikeCount(-1);
    }
}
