<?php
declare(strict_types=1);

namespace App\Clients\GetTwitterUser;

use RuntimeException;
use App\Clients\PsrFactories;
use Psr\Http\Message\UriInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Fig\Http\Message\RequestMethodInterface;
use App\Interfaces\Clients\GetTwitterUser\GetTwitterUserApiClientInterface;
use App\Interfaces\Clients\GetTwitterUser\GetTwitterUserApiClientRequestInterface;
use App\Interfaces\Clients\GetTwitterUser\GetTwitterUserApiClientResponseInterface;
use Fig\Http\Message\StatusCodeInterface;

class GetTwitterUserApiClient implements GetTwitterUserApiClientInterface
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
     * @param GetTwitterUserApiClientRequestInterface $request
     * @return GetTwitterUserApiClientResponseInterface
     */
    public function process(GetTwitterUserApiClientRequestInterface $request): GetTwitterUserApiClientResponseInterface
    {
        $request = $request->toPsrRequest($this->newGetRequest());
        $response = $this->sendRequest($request);
        if (!($response->getStatusCode() >= StatusCodeInterface::STATUS_OK && $response->getStatusCode() < StatusCodeInterface::STATUS_MULTIPLE_CHOICES)) {
            throw new RuntimeException('Could not get user from Twitter API.', $response->getStatusCode());
        }

        return new GetTwitterUserApiClientResponse($response);
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
