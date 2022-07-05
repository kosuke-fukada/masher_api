<?php
declare(strict_types=1);

namespace App\Http\User\SigninWithTwitter;

use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use App\ValueObjects\Foundation\StatusCode;
use App\ValueObjects\User\OauthProviderName;
use App\Interfaces\Usecases\User\SigninAuthUser\SigninAuthUserInterface;

class SigninWithTwitterAction
{
    /**
     * @var SigninAuthUserInterface
     */
    private SigninAuthUserInterface $usecase;

    /**
     * @param SigninAuthUserInterface $usecase
     */
    public function __construct(SigninAuthUserInterface $usecase)
    {
        $this->usecase = $usecase;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        try {
            $authUser = $this->usecase->process(OauthProviderName::TWITTER);
        } catch (Throwable $e) {
            return Response::json(
                [
                    'message' => $e->getMessage(),
                ],
                $e->getCode()
            );
        }

        $cookie = cookie(
            '__session',
            $authUser->getAttribute('remember_token'),
            config('session.lifetime'),
            config('session.path'),
            config('session.domain'),
            config('session.secure'),
        );
        return response()->json([], StatusCode::STATUS_CODE_NO_CONTENT->value)
            ->cookie($cookie);
    }
}
