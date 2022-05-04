<?php
declare(strict_types=1);

namespace Tests\Usecases\GetTwitterLikeList;

use App\Interfaces\Repositories\User\UserRepositoryInterface;
use App\Interfaces\Usecases\GetTwitterLikeList\GetTwitterLikeListInterface;
use App\Usecases\GetTwitterLikeList\GetTwitterLikeList;
use App\ValueObjects\User\AccountId;
use App\ValueObjects\User\OauthProviderName;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class GetTwitterLikeListTest extends TestCase
{
    /**
     * @return GetTwitterLikeListInterface
     */
    public function test__construct(): GetTwitterLikeListInterface
    {
        $usecase = $this->app->make(GetTwitterLikeListInterface::class);
        $this->assertInstanceOf(GetTwitterLikeList::class, $usecase);
        return $usecase;
    }

    /**
     * @depends test__construct
     * @param GetTwitterLikeListInterface $usecase
     * @return void
     */
    public function testProcess(GetTwitterLikeListInterface $usecase): void
    {
        $accountId = 'test_account_id';
        $userRepository = $this->app->make(UserRepositoryInterface::class);
        $user = $userRepository->findByAccountIdAndProvider(
            new AccountId($accountId),
            OauthProviderName::TWITTER
        );
        Auth::login($user);
        $result = $usecase->process();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('id', $result['data'][0]);
        $this->assertArrayHasKey('text', $result['data'][0]);
    }
}
