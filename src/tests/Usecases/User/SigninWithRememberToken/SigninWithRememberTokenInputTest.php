<?php
declare(strict_types=1);

namespace Tests\Usecases\User\SigninWithRememberToken;

use App\Interfaces\Usecases\User\SigninWithRememberToken\SigninWithRememberTokenInputPort;
use App\Usecases\User\SigninWithRememberToken\SigninWithRememberTokenInput;
use App\ValueObjects\User\RememberToken;
use PHPUnit\Framework\TestCase;
use Tests\StrGenerator;

class SigninWithRememberTokenInputTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $rememberToken = StrGenerator::generateRandomString(RememberToken::MAX_LENGTH);
        $input = new SigninWithRememberTokenInput(new RememberToken($rememberToken));
        $this->assertInstanceOf(SigninWithRememberTokenInputPort::class, $input);
        $this->assertSame($rememberToken, (string)$input->rememberToken());
    }
}
