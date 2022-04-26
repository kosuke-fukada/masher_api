<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Interfaces\Usecases\Signin\SigninAuthUserInterface;
use App\ValueObjects\Foundation\StatusCode;
use App\ValueObjects\User\OauthProviderName;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
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
            $this->usecase->process(OauthProviderName::TWITTER);
        } catch (Throwable $e) {
            throw new Exception($e->getMessage(), StatusCode::STATUS_CODE_INTERNAL_SERVER_ERROR->value);
        }

        return Response::json([], StatusCode::STATUS_CODE_NO_CONTENT);
    }
}
