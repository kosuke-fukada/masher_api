<?php
declare(strict_types=1);

namespace Tests\Usecases\Like\GetLikeCount;

use App\Interfaces\Usecases\Like\GetLikeCount\GetLikeCountInterface;
use App\Usecases\Like\GetLikeCount\GetLikeCount;
use App\Usecases\Like\GetLikeCount\GetLikeCountInput;
use App\ValueObjects\Shared\AccountId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\User\UserId;
use Tests\TestCase;

class GetLikeCountTest extends TestCase
{
    /**
     * @return GetLikeCountInterface
     */
    public function test__construct(): GetLikeCountInterface
    {
        $usecase = $this->app->make(GetLikeCountInterface::class);
        $this->assertInstanceOf(GetLikeCount::class, $usecase);
        return $usecase;
    }

    /**
     * @depends test__construct
     * @param GetLikeCountInterface $usecase
     * @return void
     */
    public function testProcess(GetLikeCountInterface $usecase): void
    {
        $userId = 1;
        $tweetId = '1';
        $authorId = '1';
        $input = new GetLikeCountInput(
            new UserId($userId),
            new TweetId($tweetId),
            new AccountId($authorId)
        );
        $like = $usecase->process($input);
        $this->assertSame($userId, $like['user_id']);
        $this->assertSame($tweetId, $like['tweet_id']);
        $this->assertSame($authorId, $like['author_id']);
    }
}
