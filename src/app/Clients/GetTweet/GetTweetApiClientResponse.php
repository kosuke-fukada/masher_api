<?php
declare(strict_types=1);

namespace App\Clients\GetTweet;

use Psr\Http\Message\ResponseInterface;
use Fig\Http\Message\StatusCodeInterface;
use App\Interfaces\Clients\GetTweet\GetTweetApiClientResponseInterface;

class GetTweetApiClientResponse implements GetTweetApiClientResponseInterface
{
    /**
     * @var ResponseInterface|null
     */
    private ?ResponseInterface $response;

    /**
     * @var string
     */
    private string $contents;

    /**
     * @param ResponseInterface|null $response
     */
    public function __construct(?ResponseInterface $response)
    {
        $this->response = $response;
        $this->contents = $this->response ? $this->response->getBody()->getContents() : '';
    }

    /**
     * @return string
     */
    public function contents(): string
    {
        return $this->contents;
    }

    /**
     * @return integer
     */
    public function getStatusCode(): int
    {
        return $this->response ? $this->response->getStatusCode() : StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR;
    }
}
