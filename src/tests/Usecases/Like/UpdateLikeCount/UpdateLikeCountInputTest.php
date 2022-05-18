<?php
declare(strict_types=1);

namespace Tests\Usecases\Like\UpdateLikeCount;

use App\Interfaces\Usecases\Like\UpdateLikeCount\UpdateLikeCountInputPort;
use App\Usecases\Like\UpdateLikeCount\UpdateLikeCountInput;
use App\ValueObjects\Like\LikeCount;
use App\ValueObjects\Like\LikeIdentifier;
use App\ValueObjects\Shared\AccountId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\User\UserId;
use PHPUnit\Framework\TestCase;

class UpdateLikeCountInputTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $likeIdentifier = 1;
        $userId = 1;
        $tweetId = '1';
        $authorId = '1';
        $likeCount = 0;
        $input = new UpdateLikeCountInput(
            new LikeIdentifier($likeIdentifier),
            new UserId($userId),
            new TweetId($tweetId),
            new AccountId($authorId),
            new LikeCount($likeCount)
        );
        $this->assertInstanceOf(UpdateLikeCountInputPort::class, $input);
        $this->assertSame($likeIdentifier, $input->likeIdentifier()->toInt());
        $this->assertSame($userId, $input->userId()->toInt());
        $this->assertSame($tweetId, (string)$input->tweetId());
        $this->assertSame($authorId, (string)$input->authorId());
        $this->assertSame($likeCount, $input->likeCount()->toInt());
    }
}
