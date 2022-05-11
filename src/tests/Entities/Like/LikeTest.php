<?php
declare(strict_types=1);

namespace Tests\Entities\Like;

use App\Entities\Like\Like;
use App\ValueObjects\Like\LikeCount;
use App\ValueObjects\Like\LikeIdentifier;
use App\ValueObjects\Shared\AccountId;
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
        $userId = 1;
        $tweetId = '1';
        $accountId = '1';
        $likeCount = 0;
        $like = new Like(
            new UserId($userId),
            new TweetId($tweetId),
            new AccountId($accountId),
            new LikeCount($likeCount)
        );
        $this->assertNull($like->likeIdentifier());
        $this->assertSame($userId, $like->userId()->toInt());
        $this->assertSame($tweetId, (string)$like->tweetId());
        $this->assertSame($accountId, (string)$like->accountId());
        $this->assertSame($likeCount, $like->likeCount()->toInt());

        $updatedLikeIdentifier = 100;
        $like->setLikeIdentifier(new LikeIdentifier($updatedLikeIdentifier));
        $this->assertSame($updatedLikeIdentifier, $like->likeIdentifier()->toInt());

        $updatedLikeCount = 10000;
        $like->updateLikeCount(new LikeCount($updatedLikeCount));
        $this->assertSame($updatedLikeCount, $like->likeCount()->toInt());

        $likeArray = $like->toArray();
        $this->assertSame($updatedLikeIdentifier, $likeArray['id']);
        $this->assertSame($userId, $likeArray['user_id']);
        $this->assertSame($tweetId, $likeArray['tweet_id']);
        $this->assertSame($accountId, $likeArray['author_id']);
        $this->assertSame($updatedLikeCount, $likeArray['like_count']);
    }
}
