<?php
declare(strict_types=1);

namespace Tests\ValueObjects\Tweet;

use Tests\TestCase;
use InvalidArgumentException;
use App\ValueObjects\Foundation\StringValueObject;
use App\ValueObjects\Tweet\AuthorName;

class AuthorNameTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = 'test_id.';
        $authorName = new AuthorName($expected);
        $this->assertInstanceOf(StringValueObject::class, $authorName);
        $this->assertSame($expected, (string)$authorName);
    }

    /**
     * @return void
     */
    public function testRequired(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new AuthorName('');
    }

    /**
     * @return void
     */
    public function testInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new AuthorName('あああ');
    }
}
