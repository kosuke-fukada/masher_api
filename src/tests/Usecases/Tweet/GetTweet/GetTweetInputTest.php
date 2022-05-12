<?php
declare(strict_types=1);

namespace Tests\Usecases\Tweet\GetTweet;

use PHPUnit\Framework\TestCase;
use App\ValueObjects\Tweet\TweetId;
use App\Usecases\Tweet\GetTweet\GetTweetInput;
use App\Interfaces\Usecases\Tweet\GetTweet\GetTweetInputPort;
use App\ValueObjects\Shared\AccountId;
use App\ValueObjects\Shared\UserName;

class GetTweetInputTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $tweetId = '1';
        $accountId = 'test_account_id';
        $userName = 'test_user_name';
        $input = new GetTweetInput(
            new TweetId($tweetId),
            new AccountId($accountId),
            new UserName($userName)
        );
        $this->assertInstanceOf(GetTweetInputPort::class, $input);
        $this->assertSame($tweetId, (string)$input->tweetId());
        $this->assertSame($accountId, (string)$input->accountId());
        $this->assertSame($userName, (string)$input->userName());
    }
}
