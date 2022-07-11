<?php
declare(strict_types=1);

namespace App\Usecases\Tweet\GetTweet;

use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Shared\UserName;
use App\Interfaces\Usecases\Tweet\GetTweet\GetTweetInputPort;
use App\ValueObjects\User\AccessToken;

class GetTweetInput implements GetTweetInputPort
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
     * @var AccessToken
     */
    private AccessToken $accessToken;

    /**
     * @param TweetId $tweetId
     * @param AuthorId $authorId
     * @param UserName $authorName
     * @param AccessToken $accessToken
     */
    public function __construct(
        TweetId $tweetId,
        AuthorId $authorId,
        UserName $authorName,
        AccessToken $accessToken
    )
    {
        $this->tweetId = $tweetId;
        $this->authorId = $authorId;
        $this->authorName = $authorName;
        $this->accessToken = $accessToken;
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
     * @return AccessToken
     */
    public function accessToken(): AccessToken
    {
        return $this->accessToken;
    }
}
