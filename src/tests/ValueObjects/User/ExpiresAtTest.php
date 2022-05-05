<?php
declare(strict_types=1);

namespace Tests\ValueObjects\User;

use App\ValueObjects\User\ExpiresAt;
use Carbon\Carbon;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ExpiresAtTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $expected = date('Y-m-d H:i:s');
        $expiresAt = new ExpiresAt(new Carbon($expected));
        $this->assertInstanceOf(Carbon::class, $expiresAt->toCarbon());
        $this->assertSame($expected, $expiresAt->toDate());
        $this->assertSame(strtotime($expected), $expiresAt->toTimestamp());
    }

    /**
     * @return void
     */
    public function testInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new ExpiresAt(new Carbon('あああ'));
    }

    /**
     * @return void
     */
    public function testIsExpiredIn30Minutes(): void
    {
        $expected = date('Y-m-d H:i:s', time() + 3600);
        $expiresAt = new ExpiresAt(new Carbon($expected));
        $this->assertFalse($expiresAt->isExpiredIn30Minutes());

        $expected = date('Y-m-d H:i:s', time() + 600);
        $expiresAt = new ExpiresAt(new Carbon($expected));
        $this->assertTrue($expiresAt->isExpiredIn30Minutes());
    }
}
