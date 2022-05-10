<?php
declare(strict_types=1);

namespace App\Entities\Tweet;

use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Shared\UserName;
use App\ValueObjects\Shared\AccountId;

class Tweet
{
    /**
     * @var TweetId
     */
    private TweetId $tweetId;

    /**
     * @var AccountId
     */
    private AccountId $accountId;

    /**
     * @var UserName
     */
    private UserName $userName;

    /**
     * @param TweetId $tweetId
     * @param AccountId $accountId
     * @param UserName $userName
     */
    public function __construct(
        TweetId $tweetId,
        AccountId $accountId,
        UserName $userName
    )
    {
        $this->tweetId = $tweetId;
        $this->accountId = $accountId;
        $this->userName = $userName;
    }

    /**
     * @return TweetId
     */
    public function tweetId(): TweetId
    {
        return $this->tweetId;
    }

    /**
     * @return AccountId
     */
    public function accountId(): AccountId
    {
        return $this->accountId;
    }

    /**
     * @return UserName
     */
    public function userName(): UserName
    {
        return $this->userName;
    }

    /**
     * @return string
     */
    public function tweetUrl(): string
    {
        return config('client.twitter.base_url') . $this->userName() . '/status/' . $this->tweetId();
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return [
            'tweet_id' => (string)$this->tweetId(),
            'account_id' => (string)$this->accountId(),
            'user_name' => (string)$this->userName()
        ];
    }
}
