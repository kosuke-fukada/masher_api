<?php
declare(strict_types=1);

namespace Tests\Mock\Clients\GetTwitterLikeList;

use App\Interfaces\Clients\GetTwitterLikeList\GetTwitterLikeListApiClientResponseInterface;
use Fig\Http\Message\StatusCodeInterface;

class GetTwitterLikeListApiResponseMock implements GetTwitterLikeListApiClientResponseInterface
{
    /**
     * @return string
     */
    public function contents(): string
    {
        return json_encode([
            'data' => [
                [
                    'id' => '1',
                    'text' => 'test tweet text.',
                ]
            ]
        ]);
    }

    /**
     * @return integer
     */
    public function getStatusCode(): int
    {
        return StatusCodeInterface::STATUS_OK;
    }
}
