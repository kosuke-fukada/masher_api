<?php
declare(strict_types=1);

namespace Tests\ValueObjects\Foundation;

use App\ValueObjects\Foundation\StatusCode;
use Tests\TestCase;
use ValueError;

class StatusCodeTest extends TestCase
{
    /**
     * @return void
     */
    public function testValidValue(): void
    {
        $expected = 200;
        $status = StatusCode::from($expected);
        $this->assertSame($expected, $status->value);
        $expected = 204;
        $status = StatusCode::from($expected);
        $this->assertSame($expected, $status->value);
        $expected = 400;
        $status = StatusCode::from($expected);
        $this->assertSame($expected, $status->value);
        $expected = 403;
        $status = StatusCode::from($expected);
        $this->assertSame($expected, $status->value);
        $expected = 404;
        $status = StatusCode::from($expected);
        $this->assertSame($expected, $status->value);
        $expected = 500;
        $status = StatusCode::from($expected);
        $this->assertSame($expected, $status->value);
    }

    /**
     * @return void
     */
    public function testInvalidValue(): void
    {
        $this->expectException(ValueError::class);
        StatusCode::from(10000);
    }
}
