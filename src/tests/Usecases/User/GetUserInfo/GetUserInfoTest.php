<?php
declare(strict_types=1);

namespace Tests\Usecases\User\GetUserInfo;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Usecases\User\GetUserInfo\GetUserInfo;
use App\Interfaces\Usecases\User\GetUserInfo\GetUserInfoInterface;

class GetUserInfoTest extends TestCase
{
    /**
     * @return GetUserInfoInterface
     */
    public function test__construct(): GetUserInfoInterface
    {
        $usecase = $this->app->make(GetUserInfoInterface::class);
        $this->assertInstanceOf(GetUserInfo::class, $usecase);
        return $usecase;
    }

    /**
     * @depends test__construct
     * @param GetUserInfoInterface $usecase
     * @return void
     */
    public function testProcess(GetUserInfoInterface $usecase): void
    {
        $result = $usecase->process();
        $this->assertNull($result);

        $user = (new User())->newQuery()->find(1);
        Auth::login($user);
        $result = $usecase->process();
        $this->assertSame($user->getAttribute('account_id'), (string)$result->accountId());
        $this->assertSame($user->getAttribute('user_name'), (string)$result->userName());
        $this->assertSame($user->getAttribute('display_name'), (string)$result->displayName());
        $this->assertSame($user->getAttribute('access_token'), (string)$result->accessToken());
        $this->assertSame($user->getAttribute('refresh_token'), (string)$result->refreshToken());
        $this->assertSame($user->getAttribute('provider'), $result->provider()->value);
    }
}
