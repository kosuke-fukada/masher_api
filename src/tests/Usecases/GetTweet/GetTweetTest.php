<?php
declare(strict_types=1);

namespace Tests\Usecases\GetTweet;

use App\Interfaces\Usecases\GetTweet\GetTweetInterface;
use App\Usecases\GetTweet\GetTweet;
use App\Usecases\GetTweet\GetTweetInput;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Tweet\AuthorName;
use App\ValueObjects\Tweet\TweetId;
use Tests\TestCase;

class GetTweetTest extends TestCase
{
    /**
     * @return GetTweetInterface
     */
    public function test__construct(): GetTweetInterface
    {
        $usecase = $this->app->make(GetTweetInterface::class);
        $this->assertInstanceOf(GetTweet::class, $usecase);
        return $usecase;
    }

    /**
     * @depends test__construct
     * @param GetTweetInterface $usecase
     * @return void
     */
    public function testProcess(GetTweetInterface $usecase): void
    {
        $tweetId = '1';
        $authorId = 'test_author_id';
        $authorName = 'test_user_name';
        $input = new GetTweetInput(
            new TweetId($tweetId),
            new AuthorId($authorId),
            new AuthorName($authorName)
        );
        $tweetData = $usecase->process($input);
        $this->assertIsArray($tweetData);
        $this->assertSame($authorName, $tweetData['author_name']);
    }
}
