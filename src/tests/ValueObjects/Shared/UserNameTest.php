<?php
declare(strict_types=1);

namespace Tests\ValueObjects\Shared;

use Tests\TestCase;
use InvalidArgumentException;
use App\ValueObjects\Shared\UserName;
use App\ValueObjects\Foundation\StringValueObject;

class UserNameTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = 'test_id.';
        $userName = new UserName($expected);
        $this->assertInstanceOf(StringValueObject::class, $userName);
        $this->assertSame($expected, (string)$userName);
    }

    /**
     * @return void
     */
    public function testRequired(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new UserName('');
    }

    /**
     * @return void
     */
    public function testInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new UserName('あああ');
    }
}
