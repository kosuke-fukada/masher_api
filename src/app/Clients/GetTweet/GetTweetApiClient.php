<?php
declare(strict_types=1);

namespace App\Clients\GetTweet;

use RuntimeException;
use App\Clients\PsrFactories;
use Psr\Http\Message\UriInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Fig\Http\Message\StatusCodeInterface;
use Fig\Http\Message\RequestMethodInterface;
use App\Interfaces\Clients\GetTweet\GetTweetApiClientInterface;
use App\Interfaces\Clients\GetTweet\GetTweetApiClientRequestInterface;
use App\Interfaces\Clients\GetTweet\GetTweetApiClientResponseInterface;

class GetTweetApiClient implements GetTweetApiClientInterface
{
    /**
     * @var UriInterface
     */
    private UriInterface $uri;

    /**
     * @var ClientInterface
     */
    private ClientInterface $client;

    /**
     * @var PsrFactories
     */
    private PsrFactories $psrFactory;

    /**
     * @param UriInterface $uri
     * @param ClientInterface $client
     * @param PsrFactories $psrFactory
     */
    public function __construct(
        UriInterface $uri,
        ClientInterface $client,
        PsrFactories $psrFactory
    )
    {
        $this->uri = $uri;
        $this->client = $client;
        $this->psrFactory = $psrFactory;
    }

    /**
     * @param GetTweetApiClientRequestInterface $request
     * @return GetTweetApiClientResponseInterface
     */
    public function process(GetTweetApiClientRequestInterface $request): GetTweetApiClientResponseInterface
    {
        $request = $request->toPsrRequest($this->newGetRequest());
        $response = $this->sendRequest($request);
        if (!($response->getStatusCode() >= StatusCodeInterface::STATUS_OK && $response->getStatusCode() < StatusCodeInterface::STATUS_MULTIPLE_CHOICES)) {
            throw new RuntimeException('Could not get list from Twitter API.', $response->getStatusCode());
        }

        return new GetTweetApiClientResponse($response);
    }

    /**
     * @return RequestInterface
     */
    public function newGetRequest(): RequestInterface
    {
        return $this->psrFactory->requestFactory()
            ->createRequest(RequestMethodInterface::METHOD_GET, $this->uri);
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $request = $request->withHeader('Content-Type', 'application/json');
        return $this->client->sendRequest($request);
    }
}
