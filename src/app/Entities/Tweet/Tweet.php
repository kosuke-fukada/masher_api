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
    private AccountId $authorId;

    /**
     * @var UserName
     */
    private UserName $authorName;

    /**
     * @param TweetId $tweetId
     * @param AccountId $authorId
     * @param UserName $authorName
     */
    public function __construct(
        TweetId $tweetId,
        AccountId $authorId,
        UserName $authorName
    )
    {
        $this->tweetId = $tweetId;
        $this->authorId = $authorId;
        $this->authorName = $authorName;
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
    public function authorId(): AccountId
    {
        return $this->authorId;
    }

    /**
     * @return UserName
     */
    public function authorName(): UserName
    {
        return $this->authorName;
    }

    /**
     * @return string
     */
    public function tweetUrl(): string
    {
        return config('client.twitter.base_url') . $this->authorName() . '/status/' . $this->tweetId();
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return [
            'tweet_id' => (string)$this->tweetId(),
            'author_id' => (string)$this->authorId(),
            'author_name' => (string)$this->authorName()
        ];
    }
}
