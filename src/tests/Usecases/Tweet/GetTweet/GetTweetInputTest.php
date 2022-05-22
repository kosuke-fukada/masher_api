<?php
declare(strict_types=1);

namespace Tests\Usecases\Tweet\GetTweet;

use PHPUnit\Framework\TestCase;
use App\ValueObjects\Tweet\TweetId;
use App\Usecases\Tweet\GetTweet\GetTweetInput;
use App\Interfaces\Usecases\Tweet\GetTweet\GetTweetInputPort;
use App\ValueObjects\Shared\UserName;
use App\ValueObjects\Tweet\AuthorId;

class GetTweetInputTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $tweetId = '1';
        $authorId = 'test_author_id';
        $authorName = 'test_author_name';
        $input = new GetTweetInput(
            new TweetId($tweetId),
            new AuthorId($authorId),
            new UserName($authorName)
        );
        $this->assertInstanceOf(GetTweetInputPort::class, $input);
        $this->assertSame($tweetId, (string)$input->tweetId());
        $this->assertSame($authorId, (string)$input->authorId());
        $this->assertSame($authorName, (string)$input->authorName());
    }
}
