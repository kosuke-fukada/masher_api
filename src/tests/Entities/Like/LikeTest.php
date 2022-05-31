<?php
declare(strict_types=1);

namespace Tests\Entities\Like;

use App\Entities\Like\Like;
use App\ValueObjects\Like\LikeCount;
use App\ValueObjects\Like\LikeIdentifier;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\User\UserId;
use PHPUnit\Framework\TestCase;

class LikeTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $likeIdentifier = 1;
        $userId = 1;
        $tweetId = '1';
        $authorId = '1';
        $likeCount = 0;
        $like = new Like(
            new LikeIdentifier($likeIdentifier),
            new UserId($userId),
            new TweetId($tweetId),
            new AuthorId($authorId),
            new LikeCount($likeCount)
        );
        $this->assertSame($likeIdentifier, $like->likeIdentifier()->toInt());
        $this->assertSame($userId, $like->userId()->toInt());
        $this->assertSame($tweetId, (string)$like->tweetId());
        $this->assertSame($authorId, (string)$like->authorId());
        $this->assertSame($likeCount, $like->likeCount()->toInt());

        $likeArray = $like->toArray();
        $this->assertSame($likeIdentifier, $likeArray['id']);
        $this->assertSame($userId, $likeArray['user_id']);
        $this->assertSame($tweetId, $likeArray['tweet_id']);
        $this->assertSame($authorId, $likeArray['author_id']);
        $this->assertSame($likeCount, $likeArray['like_count']);

        $updatedLikeCount = 10000;
        $like->updateLikeCount(new LikeCount($updatedLikeCount));
        $this->assertSame($updatedLikeCount, $like->likeCount()->toInt());
    }
}
