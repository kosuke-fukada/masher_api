<?php
declare(strict_types=1);

namespace App\Entities\Tweet;

use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Tweet\AuthorName;

class Tweet
{
    /**
     * @var TweetId
     */
    private TweetId $tweetId;

    /**
     * @var AuthorName
     */
    private AuthorName $authorName;

    /**
     * @param TweetId $tweetId
     * @param AuthorName $authorName
     */
    public function __construct(
        TweetId $tweetId,
        AuthorName $authorName
    )
    {
        $this->tweetId = $tweetId;
        $this->authorName = $authorName;
    }

    /**
     * Undocumented function
     *
     * @return TweetId
     */
    public function tweetId(): TweetId
    {
        return $this->tweetId;
    }

    /**
     * Undocumented function
     *
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
}
