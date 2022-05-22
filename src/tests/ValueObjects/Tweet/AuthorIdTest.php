<?php
declare(strict_types=1);

namespace Tests\ValueObjects\Tweet;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Foundation\StringValueObject;

class AuthorIdTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = 'test_author_id';
        $authorId = new AuthorId($expected);
        $this->assertInstanceOf(StringValueObject::class, $authorId);
        $this->assertSame($expected, (string)$authorId);
    }

    /**
     * @return void
     */
    public function testAllowEmpty(): void
    {
        $expected = '';
        $authorId = new AuthorId($expected);
        $this->assertSame($expected, (string)$authorId);
    }

    /**
     * @return void
     */
    public function testInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new AuthorId('あああ');
    }
}
