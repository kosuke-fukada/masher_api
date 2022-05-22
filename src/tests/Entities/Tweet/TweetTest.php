<?php
declare(strict_types=1);

namespace Tests\Entities\Tweet;

use Tests\TestCase;
use App\Entities\Tweet\Tweet;
use App\ValueObjects\Shared\UserName;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Tweet\TweetId;

class TweetTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $tweetId = '1';
        $authorId = 'test_author_id';
        $authorName = 'test_author_name';
        $tweet = new Tweet(
            new TweetId($tweetId),
            new AuthorId($authorId),
            new UserName($authorName)
        );
        $this->assertSame($tweetId, (string)$tweet->tweetId());
        $this->assertSame($authorId, (string)$tweet->authorId());
        $this->assertSame($authorName, (string)$tweet->authorName());
        $this->assertSame('https://twitter.com/test_author_name/status/1', $tweet->tweetUrl());
        $this->assertSame($tweetId, $tweet->toArray()['tweet_id']);
        $this->assertSame($authorId, $tweet->toArray()['author_id']);
        $this->assertSame($authorName, $tweet->toArray()['author_name']);
    }
}
