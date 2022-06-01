<?php
declare(strict_types=1);

namespace Tests\Factories\Like;

use App\Entities\Like\Like;
use App\Factories\Like\LikeFactory;
use App\Interfaces\Factories\Like\LikeFactoryInterface;
use App\ValueObjects\Like\LikeCount;
use App\ValueObjects\Like\LikeIdentifier;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\User\UserId;
use Tests\TestCase;

class LikeFactoryTest extends TestCase
{
    /**
     * @return LikeFactoryInterface
     */
    public function test__construct(): LikeFactoryInterface
    {
        $factory = $this->app->make(LikeFactoryInterface::class);
        $this->assertInstanceOf(LikeFactory::class, $factory);
        return $factory;
    }

    /**
     * @depends test__construct
     * @param LikeFactoryInterface $factory
     * @return void
     */
    public function testCreateLike(LikeFactoryInterface $factory): void
    {
        $userId = 1;
        $tweetId = '1';
        $authorId = '1';
        $likeCount = 0;
        $like = $factory->createLike(
            null,
            new UserId($userId),
            new TweetId($tweetId),
            new AuthorId($authorId),
            new LikeCount($likeCount)
        );
        $this->assertInstanceOf(Like::class, $like);

        $likeIdentifier = 1;
        $like = $factory->createLike(
            new LikeIdentifier($likeIdentifier),
            new UserId($userId),
            new TweetId($tweetId),
            new AuthorId($authorId),
            new LikeCount($likeCount)
        );
        $this->assertInstanceOf(Like::class, $like);
    }
}
