<?php
declare(strict_types=1);

namespace App\Http\User\GetTwitterRedirectUrl;

use App\Interfaces\Usecases\Signin\GetRedirectUrlInterface;
use App\ValueObjects\User\OauthProviderName;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Throwable;

class GetTwitterRedirectUrlAction
{
    /**
     * @var GetRedirectUrlInterface
     */
    private GetRedirectUrlInterface $usecase;

    /**
     * @param GetRedirectUrlInterface $usecase
     */
    public function __construct(GetRedirectUrlInterface $usecase)
    {
        $this->usecase = $usecase;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $oauthProvider = OauthProviderName::TWITTER;
        try {
            return Response::json($this->usecase->process($oauthProvider));
        } catch(Throwable $e) {
            return Response::json(
                [
                    'message' => $e->getMessage(),
                ],
                $e->getCode()
            );
        }
    }
}
