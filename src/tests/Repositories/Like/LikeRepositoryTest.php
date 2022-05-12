<?php
declare(strict_types=1);

namespace Tests\Repositories\Like;

use Tests\TestCase;
use App\Models\Like;
use App\ValueObjects\User\UserId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Like\LikeCount;
use App\ValueObjects\Shared\AccountId;
use App\Repositories\Like\LikeRepository;
use App\Interfaces\Repositories\Like\LikeRepositoryInterface;
use App\ValueObjects\Like\LikeIdentifier;

class LikeRepositoryTest extends TestCase
{
    /**
     * @return LikeRepositoryInterface
     */
    public function test__construct(): LikeRepositoryInterface
    {
        $likeRepository = $this->app->make(LikeRepositoryInterface::class);
        $this->assertInstanceOf(LikeRepository::class, $likeRepository);
        return $likeRepository;
    }

    /**
     * @depends test__construct
     * @param LikeRepositoryInterface $likeRepository
     * @return void
     */
    public function testCreateLike(LikeRepositoryInterface $likeRepository): void
    {
        $userId = 1;
        $tweetId = '1';
        $accountId = '1';
        $likeCount = 1;
        $like = new \App\Entities\Like\Like(
            new UserId($userId),
            new TweetId($tweetId),
            new AccountId($accountId),
            new LikeCount($likeCount)
        );
        $created = $likeRepository->createLike($like);
        $this->assertInstanceOf(Like::class, $created);
        $this->assertSame($userId, (int)$created->getAttribute('user_id'));
        $this->assertSame($tweetId, (string)$created->getAttribute('tweet_id'));
        $this->assertSame($accountId, (string)$created->getAttribute('author_id'));
        $this->assertSame($likeCount, (int)$created->getAttribute('like_count'));
    }

    /**
     * @depends test__construct
     * @param LikeRepositoryInterface $likeRepository
     * @return void
     */
    public function testUpdateLikeCount(LikeRepositoryInterface $likeRepository): void
    {
        $likeIdentifier = 1;
        $userId = 1;
        $tweetId = '1';
        $accountId = '1';
        $likeCount = 100;
        $like = new \App\Entities\Like\Like(
            new UserId($userId),
            new TweetId($tweetId),
            new AccountId($accountId),
            new LikeCount($likeCount)
        );
        $like->setLikeIdentifier(new LikeIdentifier($likeIdentifier));
        $original = $likeRepository->findById($like->likeIdentifier());
        $likeRepository->updateLikeCount($like);
        $updated = $likeRepository->findById($like->likeIdentifier());
        $this->assertSame($likeCount, $updated->likeCount()->toInt());
    }
}
