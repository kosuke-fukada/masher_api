<?php
declare(strict_types=1);

namespace App\Usecases\User\GetTwitterUser;

use RuntimeException;
use App\ValueObjects\User\AccessToken;
use Fig\Http\Message\StatusCodeInterface;
use App\Clients\GetTwitterUser\GetTwitterUserApiClientRequest;
use App\Interfaces\Usecases\User\GetTwitterUser\GetTwitterUserInputPort;
use App\Interfaces\Usecases\User\GetTwitterUser\GetTwitterUserInterface;
use App\Interfaces\Clients\GetTwitterUser\GetTwitterUserApiClientInterface;
use App\Interfaces\Repositories\User\UserRepositoryInterface;
use Throwable;

class GetTwitterUser implements GetTwitterUserInterface
{
    /**
     * @var GetTwitterUserApiClientInterface
     */
    private GetTwitterUserApiClientInterface $client;

    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * @param GetTwitterUserApiClientInterface $client
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        GetTwitterUserApiClientInterface $client,
        UserRepositoryInterface $userRepository
    )
    {
        $this->client = $client;
        $this->userRepository = $userRepository;
    }

    /**
     * @param GetTwitterUserInputPort $input
     * @return array<string, mixed>
     */
    public function process(GetTwitterUserInputPort $input): array
    {
        $authUser = $this->userRepository->findAuthUser();
        if (is_null($authUser)) {
            throw new RuntimeException('User is not signed in.', StatusCodeInterface::STATUS_FORBIDDEN);
        }

        $request = new GetTwitterUserApiClientRequest(
            $input->userName(),
            new AccessToken((string)$authUser->getAttribute('access_token'))
        );

        try {
            $response = $this->client->process($request);
            $twitterUser = json_decode($response->contents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode());
        }

        return $twitterUser;
    }
}
