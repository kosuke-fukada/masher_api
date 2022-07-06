<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Throwable;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;
use Illuminate\Support\Facades\Auth;
use App\ValueObjects\User\RememberToken;
use Illuminate\Support\Facades\Response;
use App\Usecases\User\SigninWithRememberToken\SigninWithRememberTokenInput;
use App\Interfaces\Usecases\User\SigninWithRememberToken\SigninWithRememberTokenInterface;

class RememberTokenSignin
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

    public function handle(Request $request, Closure $next)
    {
        if (!is_null(Auth::user())) {
            return $next($request);
        }
        if (!$rememberToken = $request->cookie('__session')) {
            return $next($request);
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

        return $next($request);
    }
}
