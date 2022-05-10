<?php
declare(strict_types=1);

namespace Tests\Factories\Tweet;

use App\Entities\Tweet\Tweet;
use App\Factories\Tweet\TweetFactory;
use App\Interfaces\Factories\Tweet\TweetFactoryInterface;
use Tests\TestCase;

class TweetFactoryTest extends TestCase
{
    /**
     * @return TweetFactoryInterface
     */
    public function test__construct(): TweetFactoryInterface
    {
        $factory = $this->app->make(TweetFactoryInterface::class);
        $this->assertInstanceOf(TweetFactory::class, $factory);
        return $factory;
    }

    /**
     * @depends test__construct
     * @param TweetFactoryInterface $factory
     * @return void
     */
    public function testCreateTweet(TweetFactoryInterface $factory): void
    {
        $tweetId = '1';
        $authorId = 'test_author_id';
        $authorName = 'test_user_name';
        $tweet = $factory->createTweet(
            $tweetId,
            $authorId,
            $authorName
        );
        $this->assertInstanceOf(Tweet::class, $tweet);
        $this->assertSame($tweetId, (string)$tweet->tweetId());
        $this->assertSame($authorId, (string)$tweet->authorId());
        $this->assertSame($authorName, (string)$tweet->authorName());
    }
}
