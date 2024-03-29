<?php
declare(strict_types=1);

namespace App\Usecases\Tweet\GetTwitterLikeList;

use Throwable;
use RuntimeException;
use App\ValueObjects\User\AccountId;
use App\ValueObjects\User\AccessToken;
use Fig\Http\Message\StatusCodeInterface;
use App\Interfaces\Factories\Tweet\TweetFactoryInterface;
use App\Interfaces\Repositories\User\UserRepositoryInterface;
use App\Clients\GetTwitterLikeList\GetTwitterLikeListApiRequest;
use App\Interfaces\Usecases\Tweet\GetTwitterLikeList\GetTwitterLikeListInputPort;
use App\Interfaces\Usecases\Tweet\GetTwitterLikeList\GetTwitterLikeListInterface;
use App\Interfaces\Clients\GetTwitterLikeList\GetTwitterLikeListApiClientInterface;
use App\ValueObjects\Shared\UserName;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Tweet\TweetId;

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
                        new TweetId($tweet['id']),
                        new AuthorId($tweet['author_id']),
                        new UserName($authorName)
                    )->toArray();
                }
            }
        } catch (Throwable $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode());
        }

        return [
            'tweetList' => $tweetList,
            'nextToken' => isset($list['meta']['next_token']) ? $list['meta']['next_token'] : ''
        ];
    }
}
