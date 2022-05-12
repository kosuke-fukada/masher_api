<?php
declare(strict_types=1);

namespace Tests\Usecases\UpdateLikeCount;

use App\Interfaces\Repositories\Like\LikeRepositoryInterface;
use App\Interfaces\Usecases\UpdateLikeCount\UpdateLikeCountInterface;
use App\Usecases\UpdateLikeCount\UpdateLikeCount;
use App\Usecases\UpdateLikeCount\UpdateLikeCountInput;
use App\ValueObjects\Like\LikeCount;
use App\ValueObjects\Like\LikeIdentifier;
use App\ValueObjects\Shared\AccountId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\User\UserId;
use Tests\TestCase;

class UpdateLikeCountTest extends TestCase
{
    /**
     * @return UpdateLikeCountInterface
     */
    public function test__construct(): UpdateLikeCountInterface
    {
        $usecase = $this->app->make(UpdateLikeCountInterface::class);
        $this->assertInstanceOf(UpdateLikeCount::class, $usecase);
        return $usecase;
    }

    /**
     * @depends test__construct
     * @param UpdateLikeCountInterface $usecase
     * @return void
     */
    public function testProcess(UpdateLikeCountInterface $usecase): void
    {
        $likeRepository = $this->app->make(LikeRepositoryInterface::class);
        $likeIdentifier = 1;
        $userId = 1;
        $tweetId = '1';
        $accountId = '1';
        $likeCount = 1000;
        $input = new UpdateLikeCountInput(
            new LikeIdentifier($likeIdentifier),
            new UserId($userId),
            new TweetId($tweetId),
            new AccountId($accountId),
            new LikeCount($likeCount)
        );
        $original = $likeRepository->findById($input->likeIdentifier());
        $usecase->process($input);
        $updated = $likeRepository->findById($input->likeIdentifier());
        $this->assertSame($likeCount, $updated->likeCount()->toInt());
    }
}
