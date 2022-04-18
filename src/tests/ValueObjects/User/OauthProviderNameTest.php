<?php

namespace Tests\ValueObjects\User;

use App\ValueObjects\User\OauthProviderName;
use Tests\TestCase;
use ValueError;

class OauthProviderNameTest extends TestCase
{
    /**
     * @return void
     */
    public function testValidValue(): void
    {
        $expected = 'twitter';
        $oauthProviderName = OauthProviderName::from($expected);
        $this->assertSame($expected, $oauthProviderName->value);
    }

    /**
     * @return void
     */
    public function testInvalidValue(): void
    {
        $this->expectException(ValueError::class);
        OauthProviderName::from('facebook');
    }
}
