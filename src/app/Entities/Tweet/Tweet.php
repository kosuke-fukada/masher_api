<?php
declare(strict_types=1);

namespace App\Entities\Tweet;

use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Shared\UserName;

class Tweet
{
    /**
     * @var TweetId
     */
    private TweetId $tweetId;

    /**
     * @var AuthorId
     */
    private AuthorId $authorId;

    /**
     * @var UserName
     */
    private UserName $authorName;

    /**
     * @param TweetId $tweetId
     * @param AuthorId $authorId
     * @param UserName $authorName
     */
    public function __construct(
        TweetId $tweetId,
        AuthorId $authorId,
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
     * @return AuthorId
     */
    public function authorId(): AuthorId
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
