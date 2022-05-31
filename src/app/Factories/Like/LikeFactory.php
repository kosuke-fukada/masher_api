<?php
declare(strict_types=1);

namespace App\Factories\Like;

use App\Entities\Like\Like;
use App\ValueObjects\User\UserId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Like\LikeCount;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Like\LikeIdentifier;
use App\Interfaces\Factories\Like\LikeFactoryInterface;

class LikeFactory implements LikeFactoryInterface
{
    /**
     * @var \App\Models\Like
     */
    private \App\Models\Like $like;

    /**
     * @param \App\Models\Like $like
     */
    public function __construct(\App\Models\Like $like)
    {
        $this->like = $like;
    }

    /**
     * @param UserId $userId
     * @param TweetId $tweetId
     * @param AuthorId $authorId
     * @param LikeCount $likeCount
     * @return Like
     */
    public function createLike(
        UserId $userId,
        TweetId $tweetId,
        AuthorId $authorId,
        LikeCount $likeCount
    ): Like
    {
        $likeModelObject = $this->like->newQuery()
            ->firstOrNew([
                'user_id' => $userId->toInt(),
                'tweet_id' => (string)$tweetId,
                'author_id' => (string)$authorId
            ]);
        $likeModelObject->save();
        return new Like(
            new LikeIdentifier((int)$likeModelObject->getAttribute('id')),
            $userId,
            $tweetId,
            $authorId,
            $likeCount
        );
    }
}
