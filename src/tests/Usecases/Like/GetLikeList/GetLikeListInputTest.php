<?php
declare(strict_types=1);

namespace Tests\Usecases\Like\GetLikeList;

use App\Interfaces\Usecases\Like\GetLikeList\GetLikeListInputPort;
use App\Usecases\Like\GetLikeList\GetLikeListInput;
use App\ValueObjects\Shared\OrderKey;
use App\ValueObjects\Shared\OrderValue;
use App\ValueObjects\User\UserId;
use PHPUnit\Framework\TestCase;

class GetLikeListInputTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $userId = 1;
        $orderKey = 'id';
        $orderValue = 'asc';
        $input = new GetLikeListInput(
            new UserId($userId),
            OrderKey::from($orderKey),
            OrderValue::from($orderValue)
        );
        $this->assertInstanceOf(GetLikeListInputPort::class, $input);
        $this->assertSame($userId, $input->userId()->toInt());
        $this->assertSame($orderKey, $input->orderKey()->value);
        $this->assertSame($orderValue, $input->orderValue()->value);
    }
}
