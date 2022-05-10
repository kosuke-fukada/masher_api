<?php
declare(strict_types=1);

namespace Tests\ValueObjects\Tweet;

use Tests\TestCase;
use InvalidArgumentException;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Foundation\StringValueObject;

class AuthorIdTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = 'test_account_id';
        $accountId = new AuthorId($expected);
        $this->assertInstanceOf(StringValueObject::class, $accountId);
        $this->assertSame($expected, (string)$accountId);
    }

    /**
     * @return void
     */
    public function testRequired(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new AuthorId('');
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
