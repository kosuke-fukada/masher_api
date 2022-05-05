<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;
use App\Interfaces\Factories\User\UserFactoryInterface;
use App\Http\Controllers\RefreshTwitterAccessTokenAction;
use App\Interfaces\Repositories\User\UserRepositoryInterface;
use App\Interfaces\Usecases\RefreshTwitterAccessToken\RefreshTwitterAccessTokenInterface;
use RuntimeException;
use Throwable;

class VerifyTwitterAccessTokenExpired
{
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * @var UserFactoryInterface
     */
    private UserFactoryInterface $factory;

    /**
     * @var RefreshTwitterAccessTokenInterface
     */
    private RefreshTwitterAccessTokenInterface $usecase;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param UserFactoryInterface $factory
     * @param RefreshTwitterAccessTokenInterface $usecase
     * @param LoggerInterface $logger
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        UserFactoryInterface $factory,
        RefreshTwitterAccessTokenInterface $usecase,
        LoggerInterface $logger
    )
    {
        $this->userRepository = $userRepository;
        $this->factory = $factory;
        $this->usecase = $usecase;
        $this->logger = $logger;
    }

    /**
     * @param Request $request
     * @param Closure $next
     */
    public function handle(Request $request, Closure $next)
    {
        $authUser = $this->userRepository->findAuthUser();

        // Entityを作成
        $userInfo = $this->factory->createUserEntity(
            $authUser->getAttribute('id'),
            $authUser->getAttribute('account_id'),
            $authUser->getAttribute('user_name'),
            $authUser->getAttribute('display_name'),
            $authUser->getAttribute('avatar'),
            $authUser->getAttribute('access_token'),
            $authUser->getAttribute('refresh_token'),
            (int)strtotime($authUser->getAttribute('expires_at')),
            $authUser->getAttribute('provider'),
        );

        // AccessToken期限切れ30分前を過ぎていたら更新
        if ($userInfo->expiresAt()->isExpiredIn30Minutes()) {
            try {
                $this->usecase->process();
            } catch (Throwable $e) {
                $this->logger->error((string)$e);
                throw new RuntimeException($e->getMessage(), $e->getCode());
            }
        }

        return $next($request);
    }
}
