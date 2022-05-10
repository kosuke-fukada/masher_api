<?php
declare(strict_types=1);

namespace App\Entities\Tweet;

use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Tweet\AuthorName;

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
     * @var AuthorName
     */
    private AuthorName $authorName;

    /**
     * @param TweetId $tweetId
     * @param AuthorId $authorId
     * @param AuthorName $authorName
     */
    public function __construct(
        TweetId $tweetId,
        AuthorId $authorId,
        AuthorName $authorName
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
     * @return AuthorName
     */
    public function authorName(): AuthorName
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
