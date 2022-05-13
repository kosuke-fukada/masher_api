<?php
declare(strict_types=1);

namespace Tests\Usecases\Like\GetLikeCount;

use App\Interfaces\Usecases\Like\GetLikeCount\GetLikeCountInputPort;
use App\Usecases\Like\GetLikeCount\GetLikeCountInput;
use App\ValueObjects\Shared\AccountId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\User\UserId;
use PHPUnit\Framework\TestCase;

class GetLikeCountInputTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $userId = 1;
        $tweetId = '1';
        $accountId = '1';
        $input = new GetLikeCountInput(
            new UserId($userId),
            new TweetId($tweetId),
            new AccountId($accountId)
        );
        $this->assertInstanceOf(GetLikeCountInputPort::class, $input);
        $this->assertSame($userId, $input->userId()->toInt());
        $this->assertSame($tweetId, (string)$input->tweetId());
        $this->assertSame($accountId, (string)$input->accountId());
    }
}
