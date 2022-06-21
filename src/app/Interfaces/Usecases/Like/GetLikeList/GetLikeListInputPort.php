<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\Like\GetLikeList;

use App\ValueObjects\Shared\OrderKey;
use App\ValueObjects\Shared\OrderValue;
use App\ValueObjects\User\UserId;

interface GetLikeListInputPort
{
    /**
     * @return UserId
     */
    public function userId(): UserId;

    /**
     * @return OrderKey
     */
    public function orderKey(): OrderKey;

    /**
     * @return OrderValue
     */
    public function orderValue(): OrderValue;
}
