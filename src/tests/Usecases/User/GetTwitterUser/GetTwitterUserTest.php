<?php
declare(strict_types=1);

namespace Tests\Usecases\User\GetTwitterUser;

use Tests\TestCase;
use App\ValueObjects\User\AccountId;
use Illuminate\Support\Facades\Auth;
use App\ValueObjects\Shared\UserName;
use App\ValueObjects\User\OauthProviderName;
use App\Usecases\User\GetTwitterUser\GetTwitterUser;
use App\Usecases\User\GetTwitterUser\GetTwitterUserInput;
use App\Interfaces\Repositories\User\UserRepositoryInterface;
use App\Interfaces\Usecases\User\GetTwitterUser\GetTwitterUserInterface;

class GetTwitterUserTest extends TestCase
{
    /**
     * @return GetTwitterUserInterface
     */
    public function test__construct(): GetTwitterUserInterface
    {
        $usecase = $this->app->make(GetTwitterUserInterface::class);
        $this->assertInstanceOf(GetTwitterUser::class, $usecase);
        return $usecase;
    }

    /**
     * @depends test__construct
     * @param GetTwitterUserInterface $usecase
     * @return void
     */
    public function testProcess(GetTwitterUserInterface $usecase): void
    {
        $accountId = 'test_account_id';
        $userRepository = $this->app->make(UserRepositoryInterface::class);
        $user = $userRepository->findByAccountIdAndProvider(
            new AccountId($accountId),
            OauthProviderName::TWITTER
        );
        Auth::login($user);
        $userName = 'test_user_name';
        $input = new GetTwitterUserInput(new UserName($userName));
        $twitterUser = $usecase->process($input);
        $this->assertSame($userName, $twitterUser['username']);
    }
}
