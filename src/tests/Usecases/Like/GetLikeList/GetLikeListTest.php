<?php
declare(strict_types=1);

namespace Tests\Usecases\Like\GetLikeList;

use Tests\TestCase;
use App\ValueObjects\User\UserId;
use App\ValueObjects\Shared\OrderKey;
use App\ValueObjects\Shared\OrderValue;
use App\Usecases\Like\GetLikeList\GetLikeList;
use App\Usecases\Like\GetLikeList\GetLikeListInput;
use App\Interfaces\Usecases\Like\GetLikeList\GetLikeListInterface;

class GetLikeListTest extends TestCase
{
    /**
     * @return GetLikeListInterface
     */
    public function test__construct(): GetLikeListInterface
    {
        $usecase = $this->app->make(GetLikeListInterface::class);
        $this->assertInstanceOf(GetLikeList::class, $usecase);
        return $usecase;
    }

    /**
     * @depends test__construct
     * @param GetLikeListInterface $usecase
     * @return void
     */
    public function testProcess(GetLikeListInterface $usecase): void
    {
        $userId = 1;
        $orderKey = OrderKey::ID;
        $orderValue = OrderValue::ASC;
        $input = new GetLikeListInput(
            new UserId($userId),
            $orderKey,
            $orderValue
        );
        $result = $usecase->process($input);
        $this->assertSame(1, $result['like_list'][0]['id']);
        $this->assertSame(1, $result['current_page']);
        $this->assertSame(3, $result['total']);
        $this->assertSame(3, $result['count']);

        $orderValue = OrderValue::DESC;
        $input = new GetLikeListInput(
            new UserId($userId),
            $orderKey,
            $orderValue
        );
        $result = $usecase->process($input);
        $this->assertSame(3, $result['like_list'][0]['id']);

        $orderKey = OrderKey::LIKE_COUNT;
        $input = new GetLikeListInput(
            new UserId($userId),
            $orderKey,
            $orderValue
        );
        $result = $usecase->process($input);
        $this->assertSame(2, $result['like_list'][0]['id']);

        $orderKey = OrderKey::UPDATED_AT;
        $input = new GetLikeListInput(
            new UserId($userId),
            $orderKey,
            $orderValue
        );
        $result = $usecase->process($input);
        $this->assertSame(3, $result['like_list'][0]['id']);

        $userId = 100;
        $input = new GetLikeListInput(
            new UserId($userId),
            $orderKey,
            $orderValue
        );
        $result = $usecase->process($input);
        $this->assertEmpty($result['like_list']);
        $this->assertSame(1, $result['current_page']);
        $this->assertSame(0, $result['total']);
        $this->assertSame(0, $result['count']);
    }
}
