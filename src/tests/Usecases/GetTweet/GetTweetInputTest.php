<?php
declare(strict_types=1);

namespace Tests\Usecases\GetTweet;

use PHPUnit\Framework\TestCase;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Tweet\AuthorName;
use App\Usecases\GetTweet\GetTweetInput;
use App\Interfaces\Usecases\GetTweet\GetTweetInputPort;

class GetTweetInputTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $tweetId = '1';
        $authorName = 'test_user_name';
        $input = new GetTweetInput(
            new TweetId($tweetId),
            new AuthorName($authorName)
        );
        $this->assertInstanceOf(GetTweetInputPort::class, $input);
        $this->assertSame($tweetId, (string)$input->tweetId());
        $this->assertSame($authorName, (string)$input->authorName());
    }
}
