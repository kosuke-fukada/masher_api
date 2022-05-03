<?php
declare(strict_types=1);

namespace App\Usecases\GetTwitterLikeList;

use RuntimeException;
use App\ValueObjects\User\AccountId;
use App\ValueObjects\User\AccessToken;
use App\Clients\GetTwitterLikeList\GetTwitterLikeListApiRequest;
use App\Interfaces\Usecases\GetTwitterLikeList\GetTwitterLikeListInterface;
use App\Interfaces\Clients\GetTwitterLikeList\GetTwitterLikeListApiClientInterface;
use App\Interfaces\Repositories\User\UserRepositoryInterface;
use Fig\Http\Message\StatusCodeInterface;
use Throwable;

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
     * @param GetTwitterLikeListApiClientInterface $client
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        GetTwitterLikeListApiClientInterface $client,
        UserRepositoryInterface $userRepository
    )
    {
        $this->client = $client;
        $this->userRepository = $userRepository;
    }

    /**
     * @return array<int, mixed>
     */
    public function process(): array
    {
        $authUser = $this->userRepository->findAuthUser();
        if (is_null($authUser)) {
            throw new RuntimeException('User is not signed in.', StatusCodeInterface::STATUS_FORBIDDEN);
        }

        $request = new GetTwitterLikeListApiRequest(
            new AccountId((string)$authUser->getAttribute('account_id')),
            new AccessToken((string)$authUser->getAttribute('access_token'))
        );
        try {
            $response = $this->client->process($request);
            $list = json_decode($response->contents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode());
        }
        return $list['data'];
    }
}
