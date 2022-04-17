<?php
declare(strict_types=1);

namespace App\Services\Signin;

use Throwable;
use RuntimeException;
use App\Models\UserInfo;
use App\Entities\User\User;
use Psr\Log\LoggerInterface;
use App\Interfaces\Repositories\UserInfoRepositoryInterface;
use App\Interfaces\Services\Signin\SigninUserServiceInterface;

class SigninUserService implements SigninUserServiceInterface
{
    /**
     * @var UserInfoRepositoryInterface
     */
    private UserInfoRepositoryInterface $userInfoRepository;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param UserInfoRepositoryInterface $userInfoRepository
     */
    public function __construct(UserInfoRepositoryInterface $userInfoRepository, LoggerInterface $logger)
    {
        $this->userInfoRepository = $userInfoRepository;
        $this->logger = $logger;
    }

    /**
     * @param User $user
     * @return UserInfo
     */
    public function process(User $user): UserInfo
    {
        try {
            return $this->userInfoRepository->signin($user);
        } catch (Throwable $e) {
            $this->logger->info($e->getMessage());
            throw new RuntimeException('Failed to signin.', $e->getCode());
        }
    }
}
