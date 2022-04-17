<?php
declare(strict_types=1);

namespace Tests\ValueObjects\User;

use App\ValueObjects\User\Avatar;
use InvalidArgumentException;
use Tests\TestCase;

class AvatarTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = 'https://example.com/test_image.png';
        $avatar = new Avatar($expected);
        $this->assertSame($expected, (string)$avatar);
    }

    /**
     * @return void
     */
    public function textRequired(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Avatar('');
    }

    /**
     * @return void
     */
    public function testIsNotUrl(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Avatar('not_url.jpg');
    }

    /**
     * @return void
     */
    public function testIsNotImage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Avatar('https://example.com/');
    }
}
