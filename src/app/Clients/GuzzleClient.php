<?php
declare(strict_types=1);

namespace App\Clients;

use GuzzleHttp\Client;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GuzzleClient implements ClientInterface
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * Undocumented function
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        return $this->client->send($request);
    }
}
