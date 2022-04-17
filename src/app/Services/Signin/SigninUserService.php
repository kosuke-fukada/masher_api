<?php
declare(strict_types=1);

namespace App\Services\Signin;

use App\Entities\User\User;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\Signin\SigninUserServiceInterface;
use Psr\Log\LoggerInterface;
use RuntimeException;
use Throwable;

class SigninUserService implements SigninUserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, LoggerInterface $logger)
    {
        $this->userRepository = $userRepository;
        $this->logger = $logger;
    }

    /**
     * @param User $user
     * @return \App\Models\UserInfo
     */
    public function process(User $user): \App\Models\UserInfo
    {
        try {
            return $this->userRepository->signin($user);
        } catch (Throwable $e) {
            $this->logger->info($e->getMessage());
            throw new RuntimeException('Failed to signin.', $e->getCode());
        }
    }
}
