<?php
declare(strict_types=1);

namespace Tests\Mock\Clients\RefreshTwitterAccessToken;

use Fig\Http\Message\StatusCodeInterface;
use App\Interfaces\Clients\RefreshTwitterAccessToken\RefreshTwitterAccessTokenApiClientResponseInterface;

class RefreshTwitterAccessTokenApiClientResponseMock implements RefreshTwitterAccessTokenApiClientResponseInterface
{
    /**
     * @return string
     */
    public function contents(): string
    {
        return json_encode([
            'data' => [
                'token_type' => 'bearer',
                'expires_in' => 7200,
                'access_token' => 'refreshed_access_token',
                'scope' => 'tweet.read user.read like.read',
                'refresh_token' => 'refreshed_refresh_token',
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
