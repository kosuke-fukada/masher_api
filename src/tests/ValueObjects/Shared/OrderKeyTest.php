<?php
declare(strict_types=1);

namespace Tests\ValueObjects\Shared;

use App\ValueObjects\Shared\OrderKey;
use Tests\StrGenerator;
use Tests\TestCase;
use ValueError;

class OrderKeyTest extends TestCase
{
    /**
     * @return void
     */
    public function testValidValue(): void
    {
        $expected = 'id';
        $orderKey = OrderKey::from($expected);
        $this->assertSame($expected, $orderKey->value);

        $expected = 'like_count';
        $orderKey = OrderKey::from($expected);
        $this->assertSame($expected, $orderKey->value);

        $expected = 'updated_at';
        $orderKey = OrderKey::from($expected);
        $this->assertSame($expected, $orderKey->value);
    }

    /**
     * @return void
     */
    public function testInvalidValue(): void
    {
        $this->expectException(ValueError::class);
        OrderKey::from(StrGenerator::generateRandomString());
    }
}
