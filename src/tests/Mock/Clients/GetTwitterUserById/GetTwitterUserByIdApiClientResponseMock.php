<?php
declare(strict_types=1);

namespace Tests\Mock\Clients\GetTwitterUserById;

use Fig\Http\Message\StatusCodeInterface;
use App\Interfaces\Clients\GetTwitterUserById\GetTwitterUserByIdApiClientResponseInterface;

class GetTwitterUserByIdApiClientResponseMock implements GetTwitterUserByIdApiClientResponseInterface
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
