<?php
declare(strict_types=1);

namespace Tests\Usecases\Like\CreateLikeCount;

use App\Interfaces\Usecases\Like\CreateLikeCount\CreateLikeCountInterface;
use App\Usecases\Like\CreateLikeCount\CreateLikeCount;
use App\Usecases\Like\CreateLikeCount\CreateLikeCountInput;
use App\ValueObjects\Like\LikeCount;
use App\ValueObjects\Shared\AccountId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\User\UserId;
use Tests\TestCase;

class CreateLikeCountTest extends TestCase
{
    /**
     * @return CreateLikeCountInterface
     */
    public function test__construct(): CreateLikeCountInterface
    {
        $usecase = $this->app->make(CreateLikeCountInterface::class);
        $this->assertInstanceOf(CreateLikeCount::class, $usecase);
        return $usecase;
    }

    /**
     * @depends test__construct
     * @param CreateLikeCountInterface $usecase
     * @return void
     */
    public function testProcess(CreateLikeCountInterface $usecase): void
    {
        $userId = 1;
        $tweetId = '1';
        $authorId = '1';
        $likeCount = 1;
        $input = new CreateLikeCountInput(
            new UserId($userId),
            new TweetId($tweetId),
            new AccountId($authorId),
            new LikeCount($likeCount)
        );
        $created = $usecase->process($input);
        $this->assertSame($userId, $created['user_id']);
        $this->assertSame($tweetId, $created['tweet_id']);
        $this->assertSame($authorId, $created['author_id']);
        $this->assertSame($likeCount, $created['like_count']);
    }
}
