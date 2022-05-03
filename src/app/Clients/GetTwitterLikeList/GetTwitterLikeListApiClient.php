<?php
declare(strict_types=1);

namespace App\Clients\GetTwitterLikeList;

use RuntimeException;
use App\Client\PsrFactories;
use Psr\Http\Message\UriInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Fig\Http\Message\RequestMethodInterface;
use App\Interfaces\Clients\GetTwitterLikeList\GetTwitterLikeListApiClientInterface;
use App\Interfaces\Clients\GetTwitterLikeList\GetTwitterLikeListApiClientRequestInterface;
use App\Interfaces\Clients\GetTwitterLikeList\GetTwitterLikeListApiClientResponseInterface;

class GetTwitterLikeListApiClient implements GetTwitterLikeListApiClientInterface
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
     * @param GetTwitterLikeListApiClientRequestInterface $request
     * @return GetTwitterLikeListApiClientResponseInterface
     */
    public function process(GetTwitterLikeListApiClientRequestInterface $request): GetTwitterLikeListApiClientResponseInterface
    {
        $request = $request->toPsrRequest($this->newGetRequest());
        $response = $this->sendRequest($request);
        if (!($response->getStatusCode() >= 200 && $response->getStatusCode() < 300)) {
            throw new RuntimeException('Could not get list from Twitter API.');
        }

        return new GetTwitterLikeListApiResponse($response);
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
