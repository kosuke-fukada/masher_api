<?php
declare(strict_types=1);

namespace Tests\Mock\Clients\GetTwitterUser;

use App\Interfaces\Clients\GetTwitterUser\GetTwitterUserApiClientResponseInterface;
use Fig\Http\Message\StatusCodeInterface;

class GetTwitterUserApiClientResponseMock implements GetTwitterUserApiClientResponseInterface
{
    /**
     * @return string
     */
    public function contents(): string
    {
        return json_encode([
            'id' => '1',
            'name' => 'test_name',
            'username' => 'test_user_name',
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
