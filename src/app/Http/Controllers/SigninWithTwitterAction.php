<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\ExceptionBaseClass;
use App\Interfaces\Usecases\Signin\SigninAuthUserInterface;
use App\ValueObjects\User\OauthProviderName;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Symfony\Component\ErrorHandler\Error\FatalError;
use Throwable;

class SigninWithTwitterAction extends Controller
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
            $user = $this->usecase->process(OauthProviderName::TWITTER);
        } catch (Throwable $e) {
            throw new FatalError('Failed to signin.', ExceptionBaseClass::STATUS_CODE_INTERNAL_SERVER_ERROR, []);
        }

        return Response::json($user->toArrayWithoutCredentials());
    }
}
