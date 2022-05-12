<?php
declare(strict_types=1);

namespace Tests\Usecases\Like\CreateLikeCount;

use App\Interfaces\Usecases\Like\CreateLikeCount\CreateLikeCountInputPort;
use App\Usecases\Like\CreateLikeCount\CreateLikeCountInput;
use App\ValueObjects\Like\LikeCount;
use App\ValueObjects\Shared\AccountId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\User\UserId;
use PHPUnit\Framework\TestCase;

class CreateLikeCountInputTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $userId = 1;
        $tweetId = '1';
        $accountId = '1';
        $likeCount = 0;
        $input = new CreateLikeCountInput(
            new UserId($userId),
            new TweetId($tweetId),
            new AccountId($accountId),
            new LikeCount($likeCount)
        );
        $this->assertInstanceOf(CreateLikeCountInputPort::class, $input);
        $this->assertNull($input->likeIdentifier());
        $this->assertSame($userId, $input->userId()->toInt());
        $this->assertSame($tweetId, (string)$input->tweetId());
        $this->assertSame($accountId, (string)$input->accountId());
        $this->assertSame($likeCount, $input->likeCount()->toInt());
    }
}
