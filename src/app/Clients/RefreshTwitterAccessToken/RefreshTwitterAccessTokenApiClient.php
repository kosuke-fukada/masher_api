<?php
declare(strict_types=1);

namespace App\Clients\RefreshTwitterAccessToken;

use RuntimeException;
use App\Clients\PsrFactories;
use Psr\Http\Message\UriInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Fig\Http\Message\StatusCodeInterface;
use Fig\Http\Message\RequestMethodInterface;
use App\Interfaces\Clients\RefreshTwitterAccessToken\RefreshTwitterAccessTokenApiClientInterface;
use App\Interfaces\Clients\RefreshTwitterAccessToken\RefreshTwitterAccessTokenApiClientRequestInterface;
use App\Interfaces\Clients\RefreshTwitterAccessToken\RefreshTwitterAccessTokenApiClientResponseInterface;

class RefreshTwitterAccessTokenApiClient implements RefreshTwitterAccessTokenApiClientInterface
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
     * @param RefreshTwitterAccessTokenApiClientRequestInterface $request
     * @return RefreshTwitterAccessTokenApiClientResponseInterface
     */
    public function process(RefreshTwitterAccessTokenApiClientRequestInterface $request): RefreshTwitterAccessTokenApiClientResponseInterface
    {
        $request = $request->toPsrRequest($this->newPostRequest());
        $response = $this->sendRequest($request);
        if (!($response->getStatusCode() >= StatusCodeInterface::STATUS_OK && $response->getStatusCode() < StatusCodeInterface::STATUS_MULTIPLE_CHOICES)) {
            throw new RuntimeException('Could not refresh Twitter access token.', $response->getStatusCode());
        }

        return new RefreshTwitterAccessTokenApiClientResponse($response);
    }

    /**
     * @return RequestInterface
     */
    public function newPostRequest(): RequestInterface
    {
        return $this->psrFactory->requestFactory()
            ->createRequest(RequestMethodInterface::METHOD_POST, $this->uri);
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $request = $request->withHeader('Content-Type', 'application/x-www-form-urlencoded');
        return $this->client->sendRequest($request);
    }
}
