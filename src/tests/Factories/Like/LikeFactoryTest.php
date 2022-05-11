<?php
declare(strict_types=1);

namespace Tests\Factories\Like;

use App\Entities\Like\Like;
use App\Factories\Like\LikeFactory;
use App\Interfaces\Factories\Like\LikeFactoryInterface;
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
        $accountId = '1';
        $likeCount = 0;
        $like = $factory->createLike(
            $userId,
            $tweetId,
            $accountId,
            $likeCount
        );
        $this->assertInstanceOf(Like::class, $like);
    }
}
