<?php
declare(strict_types=1);

namespace Tests\Usecases\User\SigninWithRememberToken;

use App\Entities\User\UserInfo;
use Tests\TestCase;
use App\Usecases\User\SigninWithRememberToken\SigninWithRememberToken;
use App\Interfaces\Usecases\User\SigninWithRememberToken\SigninWithRememberTokenInterface;
use App\Usecases\User\SigninWithRememberToken\SigninWithRememberTokenInput;
use App\ValueObjects\User\RememberToken;
use Tests\StrGenerator;

class SigninWithRememberTokenTest extends TestCase
{
    /**
     * @return SigninWithRememberTokenInterface
     */
    public function test__construct(): SigninWithRememberTokenInterface
    {
        $usecase = $this->app->make(SigninWithRememberTokenInterface::class);
        $this->assertInstanceOf(SigninWithRememberToken::class, $usecase);
        return $usecase;
    }

    /**
     * @depends test__construct
     * @param SigninWithRememberTokenInterface $usecase
     * @return void
     */
    public function testProcess(SigninWithRememberTokenInterface $usecase): void
    {
        $rememberToken = StrGenerator::generateRandomString(RememberToken::MAX_LENGTH);
        $input = new SigninWithRememberTokenInput(new RememberToken($rememberToken));
        $authUser = $usecase->process($input);
        $this->assertNull($authUser);

        $rememberToken = 'test_remember_token';
        $input = new SigninWithRememberTokenInput(new RememberToken($rememberToken));
        $authUser = $usecase->process($input);
        $this->assertInstanceOf(UserInfo::class, $authUser);
    }
}
