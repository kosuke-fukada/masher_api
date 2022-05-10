<?php
declare(strict_types=1);

namespace App\Usecases\GetTweet;

use Throwable;
use RuntimeException;
use App\Clients\GetTweet\GetTweetApiClientRequest;
use App\Interfaces\Usecases\GetTweet\GetTweetInputPort;
use App\Interfaces\Usecases\GetTweet\GetTweetInterface;
use App\Interfaces\Factories\Tweet\TweetFactoryInterface;
use App\Interfaces\Clients\GetTweet\GetTweetApiClientInterface;

class GetTweet implements GetTweetInterface
{
    /**
     * @var GetTweetApiClientInterface
     */
    private GetTweetApiClientInterface $client;

    /**
     * @var TweetFactoryInterface
     */
    private TweetFactoryInterface $factory;

    /**
     * @param GetTweetApiClientInterface $client
     * @param TweetFactoryInterface $factory
     */
    public function __construct(
        GetTweetApiClientInterface $client,
        TweetFactoryInterface $factory
    )
    {
        $this->client = $client;
        $this->factory = $factory;
    }

    /**
     * @param GetTweetInputPort $input
     * @return array
     */
    public function process(GetTweetInputPort $input): array
    {
        // Entityを作成
        $tweet = $this->factory->createTweet(
            (string)$input->tweetId(),
            (string)$input->authorId(),
            (string)$input->authorName()
        );

        // APIから取得
        $request = new GetTweetApiClientRequest($tweet);
        try {
            $response = $this->client->process($request);
            $tweetData = json_decode($response->contents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode());
        }

        return $tweetData;
    }
}
