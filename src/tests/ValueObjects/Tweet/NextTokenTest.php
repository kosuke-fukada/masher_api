<?php
declare(strict_types=1);

namespace Tests\ValueObjects\Tweet;

use App\ValueObjects\Foundation\StringValueObject;
use App\ValueObjects\Tweet\NextToken;
use PHPUnit\Framework\TestCase;

class NextTokenTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = 'test_next_token';
        $nextToken = new NextToken($expected);
        $this->assertInstanceOf(StringValueObject::class, $nextToken);
        $this->assertSame($expected, (string)$nextToken);
    }

    /**
     * @return void
     */
    public function testExistNext(): void
    {
        $expected = '';
        $nextToken = new NextToken($expected);
        $this->assertFalse($nextToken->existNext());

        $expected = 'test_next_token';
        $nextToken = new NextToken($expected);
        $this->assertTrue($nextToken->existNext());
    }
}
