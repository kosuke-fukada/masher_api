<?php
declare(strict_types=1);

namespace App\Usecases\Tweet\GetTweet;

use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Shared\UserName;
use App\ValueObjects\Shared\AccountId;
use App\Interfaces\Usecases\Tweet\GetTweet\GetTweetInputPort;

class GetTweetInput implements GetTweetInputPort
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
}
