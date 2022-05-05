<?php
declare(strict_types=1);

namespace App\Usecases\RefreshTwitterAccessToken;

use Throwable;
use RuntimeException;
use App\ValueObjects\User\ExpiresAt;
use App\ValueObjects\User\AccessToken;
use App\ValueObjects\User\RefreshToken;
use Fig\Http\Message\StatusCodeInterface;
use App\Interfaces\Factories\User\UserFactoryInterface;
use App\Interfaces\Repositories\User\UserRepositoryInterface;
use App\Clients\RefreshTwitterAccessToken\RefreshTwitterAccessTokenApiClientRequest;
use App\Interfaces\Usecases\RefreshTwitterAccessToken\RefreshTwitterAccessTokenInterface;
use App\Interfaces\Clients\RefreshTwitterAccessToken\RefreshTwitterAccessTokenApiClientInterface;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RefreshTwitterAccessToken implements RefreshTwitterAccessTokenInterface
{
    /**
     * @var RefreshTwitterAccessTokenApiClientInterface
     */
    private RefreshTwitterAccessTokenApiClientInterface $client;

    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * @var UserFactoryInterface
     */
    private UserFactoryInterface $factory;

    /**
     * @param RefreshTwitterAccessTokenApiClientInterface $client
     * @param UserRepositoryInterface $userRepository
     * @param UserFactoryInterface $factory
     */
    public function __construct(
        RefreshTwitterAccessTokenApiClientInterface $client,
        UserRepositoryInterface $userRepository,
        UserFactoryInterface $factory
    )
    {
        $this->client = $client;
        $this->userRepository = $userRepository;
        $this->factory = $factory;
    }

    /**
     * @return void
     */
    public function process(): void
    {
        $authUser = $this->userRepository->findAuthUser();
        if (is_null($authUser)) {
            throw new RuntimeException('User is not signed in.', StatusCodeInterface::STATUS_FORBIDDEN);
        }

        // Entityを作成
        $userInfo = $this->factory->createUserInfoFromUserModel($authUser);

        $request = new RefreshTwitterAccessTokenApiClientRequest($userInfo->refreshToken());
        try {
            DB::beginTransaction();
            // 新しいトークン取得
            $response = $this->client->process($request);
            $newTokens = json_decode($response->contents(), true, 512, JSON_THROW_ON_ERROR);

            // Entityを更新
            $userInfo->changeAccessToken(new AccessToken($newTokens['access_token']));
            $userInfo->changeRefreshToken(new RefreshToken($newTokens['refresh_token']));
            $userInfo->changeExpiresAt(new ExpiresAt((new CarbonImmutable())->addSecond($newTokens['expires_in'])));

            // 永続化
            $this->userRepository->updateUser($userInfo);

            // 更新したユーザー情報をログインセッションにセット
            $refreshedUser = $this->userRepository->findById($userInfo->userId());
            Auth::setUser($refreshedUser);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw new RuntimeException($e->getMessage(), $e->getCode());
        }
    }
}
