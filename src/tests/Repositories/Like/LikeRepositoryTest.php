<?php
declare(strict_types=1);

namespace Tests\Repositories\Like;

use Tests\TestCase;
use App\Models\Like;
use App\ValueObjects\User\UserId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Like\LikeCount;
use App\Repositories\Like\LikeRepository;
use App\Interfaces\Repositories\Like\LikeRepositoryInterface;
use App\ValueObjects\Like\LikeIdentifier;
use App\ValueObjects\Tweet\AuthorId;

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
        $authorId = '1';
        $likeCount = 1;
        $like = new \App\Entities\Like\Like(
            null,
            new UserId($userId),
            new TweetId($tweetId),
            new AuthorId($authorId),
            new LikeCount($likeCount)
        );
        $created = $likeRepository->createLike($like);
        $this->assertInstanceOf(Like::class, $created);
        $this->assertSame($userId, (int)$created->getAttribute('user_id'));
        $this->assertSame($tweetId, (string)$created->getAttribute('tweet_id'));
        $this->assertSame($authorId, (string)$created->getAttribute('author_id'));
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
            new LikeIdentifier($likeIdentifier),
            new UserId($userId),
            new TweetId($tweetId),
            new AuthorId($accountId),
            new LikeCount($likeCount)
        );
        $likeRepository->updateLikeCount($like);
        $updated = $likeRepository->findById($like->likeIdentifier());
        $this->assertSame($likeCount, $updated->likeCount()->toInt());
    }
}
