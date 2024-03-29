<?php
declare(strict_types=1);

namespace Tests\Usecases\Tweet\GetTwitterLikeList;

use Tests\TestCase;
use App\ValueObjects\User\AccountId;
use Illuminate\Support\Facades\Auth;
use App\ValueObjects\Tweet\NextToken;
use App\ValueObjects\User\OauthProviderName;
use App\Interfaces\Repositories\User\UserRepositoryInterface;
use App\Usecases\Tweet\GetTwitterLikeList\GetTwitterLikeList;
use App\Usecases\Tweet\GetTwitterLikeList\GetTwitterLikeListInput;
use App\Interfaces\Usecases\Tweet\GetTwitterLikeList\GetTwitterLikeListInterface;

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
        $nextToken = 'test_next_token';
        $input = new GetTwitterLikeListInput(
            new NextToken($nextToken)
        );
        $result = $usecase->process($input);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('tweetList', $result);
        $this->assertArrayHasKey('tweet_id', $result['tweetList'][0]);
        $this->assertArrayHasKey('author_id', $result['tweetList'][0]);
        $this->assertArrayHasKey('author_name', $result['tweetList'][0]);
        $this->assertArrayHasKey('nextToken', $result);
    }
}
