<?php
declare(strict_types=1);

namespace App\Usecases\Like\GetLikeList;

use App\Interfaces\Usecases\Like\GetLikeList\GetLikeListInputPort;
use App\ValueObjects\Shared\OrderKey;
use App\ValueObjects\Shared\OrderValue;
use App\ValueObjects\User\UserId;

class GetLikeListInput implements GetLikeListInputPort
{
    /**
     * @var UserId
     */
    private UserId $userId;

    /**
     * @var OrderKey
     */
    private OrderKey $orderKey;

    /**
     * @var OrderValue
     */
    private OrderValue $orderValue;

    /**
     * @param UserId $userId
     * @param OrderKey $orderKey
     * @param OrderValue $orderValue
     */
    public function __construct(
        UserId $userId,
        OrderKey $orderKey,
        OrderValue $orderValue
    )
    {
        $this->userId = $userId;
        $this->orderKey = $orderKey;
        $this->orderValue = $orderValue;
    }

    /**
     * @return UserId
     */
    public function userId(): UserId
    {
        return $this->userId;
    }

    /**
     * @return OrderKey
     */
    public function orderKey(): OrderKey
    {
        return $this->orderKey;
    }

    /**
     * @return OrderValue
     */
    public function orderValue(): OrderValue
    {
        return $this->orderValue;
    }
}
