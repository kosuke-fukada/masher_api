<?php
declare(strict_types=1);

namespace Tests\Factories\Tweet;

use App\Entities\Tweet\Tweet;
use App\Factories\Tweet\TweetFactory;
use App\Interfaces\Factories\Tweet\TweetFactoryInterface;
use App\ValueObjects\Shared\UserName;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Tweet\TweetId;
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
        $authorName = 'test_author_name';
        $tweet = $factory->createTweet(
            new TweetId($tweetId),
            new AuthorId($authorId),
            new UserName($authorName)
        );
        $this->assertInstanceOf(Tweet::class, $tweet);
        $this->assertSame((string)$tweetId, (string)$tweet->tweetId());
        $this->assertSame((string)$authorId, (string)$tweet->authorId());
        $this->assertSame((string)$authorName, (string)$tweet->authorName());
    }
}
