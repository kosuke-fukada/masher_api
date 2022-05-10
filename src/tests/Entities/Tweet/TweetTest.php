<?php
declare(strict_types=1);

namespace Tests\Entities\Tweet;

use Tests\TestCase;
use App\Entities\Tweet\Tweet;
use App\ValueObjects\Shared\AccountId;
use App\ValueObjects\Shared\UserName;
use App\ValueObjects\Tweet\TweetId;

class TweetTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $tweetId = '1';
        $accountId = 'test_account_id';
        $userName = 'test_user_name';
        $tweet = new Tweet(
            new TweetId($tweetId),
            new AccountId($accountId),
            new UserName($userName)
        );
        $this->assertSame($tweetId, (string)$tweet->tweetId());
        $this->assertSame($accountId, (string)$tweet->accountId());
        $this->assertSame($userName, (string)$tweet->userName());
        $this->assertSame('https://twitter.com/test_user_name/status/1', $tweet->tweetUrl());
        $this->assertSame($tweetId, $tweet->toArray()['tweet_id']);
        $this->assertSame($accountId, $tweet->toArray()['account_id']);
        $this->assertSame($userName, $tweet->toArray()['user_name']);
    }
}
