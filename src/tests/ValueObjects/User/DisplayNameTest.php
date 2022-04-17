<?php
declare(strict_types=1);

namespace Tests\ValueObjects\User;

use Tests\TestCase;
use InvalidArgumentException;
use App\ValueObjects\User\DisplayName;
use App\ValueObjects\Foundation\StringValueObject;

class DisplayNameTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = 'test_display_name';
        $displayName = new DisplayName($expected);
        $this->assertInstanceOf(StringValueObject::class, $displayName);
        $this->assertSame($expected, (string)$displayName);
    }

    public function testRequired(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new DisplayName('');
    }
}
