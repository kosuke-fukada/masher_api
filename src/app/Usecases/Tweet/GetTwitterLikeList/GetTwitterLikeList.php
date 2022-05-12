<?php
declare(strict_types=1);

namespace App\Usecases\Tweet\GetTwitterLikeList;

use Throwable;
use RuntimeException;
use App\ValueObjects\Shared\AccountId;
use App\ValueObjects\User\AccessToken;
use Fig\Http\Message\StatusCodeInterface;
use App\Interfaces\Factories\Tweet\TweetFactoryInterface;
use App\Interfaces\Repositories\User\UserRepositoryInterface;
use App\Clients\GetTwitterLikeList\GetTwitterLikeListApiRequest;
use App\Interfaces\Usecases\Tweet\GetTwitterLikeList\GetTwitterLikeListInputPort;
use App\Interfaces\Usecases\Tweet\GetTwitterLikeList\GetTwitterLikeListInterface;
use App\Interfaces\Clients\GetTwitterLikeList\GetTwitterLikeListApiClientInterface;

class GetTwitterLikeList implements GetTwitterLikeListInterface
{
    /**
     * @var GetTwitterLikeListApiClientInterface
     */
    private GetTwitterLikeListApiClientInterface $client;

    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * @var TweetFactoryInterface
     */
    private TweetFactoryInterface $tweetFactory;

    /**
     * @param GetTwitterLikeListApiClientInterface $client
     * @param UserRepositoryInterface $userRepository
     * @param TweetFactoryInterface $tweetFactory
     */
    public function __construct(
        GetTwitterLikeListApiClientInterface $client,
        UserRepositoryInterface $userRepository,
        TweetFactoryInterface $tweetFactory
    )
    {
        $this->client = $client;
        $this->userRepository = $userRepository;
        $this->tweetFactory = $tweetFactory;
    }

    /**
     * @param GetTwitterLikeListInputPort $input
     * @return array<int, mixed>
     */
    public function process(GetTwitterLikeListInputPort $input): array
    {
        $authUser = $this->userRepository->findAuthUser();
        if (is_null($authUser)) {
            throw new RuntimeException('User is not signed in.', StatusCodeInterface::STATUS_FORBIDDEN);
        }

        $request = new GetTwitterLikeListApiRequest(
            new AccountId((string)$authUser->getAttribute('account_id')),
            new AccessToken((string)$authUser->getAttribute('access_token')),
            $input->nextToken()
        );
        try {
            $response = $this->client->process($request);
            $list = json_decode($response->contents(), true, 512, JSON_THROW_ON_ERROR);

            // dataとincludesを突き合わせて詰め直す
            $tweetList = [];
            if (isset($list['data'])) {
                foreach ($list['data'] as $tweet) {
                    $authorName = array_values(array_filter($list['includes']['users'], function($user) use($tweet) {
                        return $user['id'] === $tweet['author_id'];
                    }))[0]['username'];

                    $tweetList[] = $this->tweetFactory->createTweet(
                        $tweet['id'],
                        $tweet['author_id'],
                        $authorName
                    )->toArray();
                }
            }
        } catch (Throwable $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode());
        }

        return $tweetList;
    }
}
