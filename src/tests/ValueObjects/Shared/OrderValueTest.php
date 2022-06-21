<?php
declare(strict_types=1);

namespace Tests\ValueObjects\Shared;

use ValueError;
use Tests\StrGenerator;
use PHPUnit\Framework\TestCase;
use App\ValueObjects\Shared\OrderValue;

class OrderValueTest extends TestCase
{
    /**
     * @return void
     */
    public function testValidValue(): void
    {
        $expected = 'asc';
        $orderKey = OrderValue::from($expected);
        $this->assertSame($expected, $orderKey->value);

        $expected = 'desc';
        $orderKey = OrderValue::from($expected);
        $this->assertSame($expected, $orderKey->value);
    }

    /**
     * @return void
     */
    public function testInvalidValue(): void
    {
        $this->expectException(ValueError::class);
        OrderValue::from(StrGenerator::generateRandomString());
    }
}
