<?php
declare(strict_types=1);

namespace App\Http\User\SigninWithRememberToken;

use App\Interfaces\Usecases\User\SigninWithRememberToken\SigninWithRememberTokenInterface;
use App\Usecases\User\SigninWithRememberToken\SigninWithRememberTokenInput;
use App\ValueObjects\User\RememberToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Psr\Log\LoggerInterface;
use Throwable;

class SigninWithRememberTokenAction
{
    /**
     * @var SigninWithRememberTokenInterface
     */
    private SigninWithRememberTokenInterface $usecase;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param SigninWithRememberTokenInterface $usecase
     * @param LoggerInterface $logger
     */
    public function __construct(
        SigninWithRememberTokenInterface $usecase,
        LoggerInterface $logger
    )
    {
        $this->usecase = $usecase;
        $this->logger = $logger;
    }

    public function __invoke(Request $request): JsonResponse
    {
        if (!$rememberToken = $request->cookie('__session')) {
            return Response::json([]);
        }
        try {
            $input = new SigninWithRememberTokenInput(new RememberToken($rememberToken));
            $userInfo = $this->usecase->process($input);
        } catch (Throwable $e) {
            $this->logger->error((string)$e);
            return Response::json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }

        return Response::json($userInfo ? $userInfo->toArrayWithoutCredentials() : []);
    }
}
