<?php
declare(strict_types=1);

namespace Tests\Mock\Clients\GetTweet;

use App\Interfaces\Clients\GetTweet\GetTweetApiClientResponseInterface;
use Fig\Http\Message\StatusCodeInterface;

class GetTweetApiClientResponseMock implements GetTweetApiClientResponseInterface
{
    /**
     * @return string
     */
    public function contents(): string
    {
        return json_encode([
            'url' => 'https://twitter.com/test_user_name/status/1',
            'author_name' => 'test_user_name',
            'author_url' => 'https://twitter.com/test_user_name',
            'width' => 550,
            'height' => null,
            'type' => 'rich',
            'cache_age' => '3153600000',
            'provider_name' => 'Twitter',
            'provider_url' => 'https://twitter.com',
            'version' => '1.0'
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
