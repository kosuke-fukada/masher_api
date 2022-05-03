<?php
declare(strict_types=1);

namespace App\Clients;

use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;

class PsrFactories
{
    /**
     * @var RequestFactoryInterface
     */
    private RequestFactoryInterface $requestFactory;

    /**
     * @var StreamFactoryInterface
     */
    private StreamFactoryInterface $streamFactory;

    /**
     * @var ResponseFactoryInterface
     */
    private ResponseFactoryInterface $responseFactory;

    /**
     * @var UriFactoryInterface
     */
    private UriFactoryInterface $uriFactory;

    /**
     * @param RequestFactoryInterface $requestFactory
     * @param StreamFactoryInterface $streamFactory
     * @param ResponseFactoryInterface $responseFactory
     * @param UriFactoryInterface $uriFactory
     */
    public function __construct(
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        ResponseFactoryInterface $responseFactory,
        UriFactoryInterface $uriFactory
    )
    {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->responseFactory = $responseFactory;
        $this->uriFactory = $uriFactory;
    }

    /**
     * @return RequestFactoryInterface
     */
    public function requestFactory(): RequestFactoryInterface
    {
        return $this->requestFactory;
    }

    /**
     * @return StreamFactoryInterface
     */
    public function streamFactory(): StreamFactoryInterface
    {
        return $this->streamFactory;
    }

    /**
     * @return ResponseFactoryInterface
     */
    public function responseFactory(): ResponseFactoryInterface
    {
        return $this->responseFactory;
    }

    /**
     * @return UriFactoryInterface
     */
    public function uriFactory(): UriFactoryInterface
    {
        return $this->uriFactory;
    }
}
