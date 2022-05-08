<?php
declare(strict_types=1);

namespace Tests\ValueObjects\Tweet;

use App\ValueObjects\Foundation\StringValueObject;
use App\ValueObjects\Tweet\TweetId;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class TweetIdTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = '1';
        $tweetId = new TweetId($expected);
        $this->assertInstanceOf(StringValueObject::class, $tweetId);
        $this->assertSame($expected, (string)$tweetId);
    }

    /**
     * @return void
     */
    public function testRequired(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new TweetId('');
    }

    /**
     * @return void
     */
    public function testInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new TweetId('あああ');
    }
}
