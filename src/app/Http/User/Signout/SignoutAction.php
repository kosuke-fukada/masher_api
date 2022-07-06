<?php
declare(strict_types=1);

namespace App\Http\User\Signout;

use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use App\ValueObjects\Foundation\StatusCode;
use App\Interfaces\Usecases\User\Signout\SignoutInterface;
use Illuminate\Support\Facades\Cookie;

class SignoutAction
{
    /**
     * @var SignoutInterface
     */
    private SignoutInterface $usecase;

    /**
     * @param SignoutInterface $usecase
     */
    public function __construct(SignoutInterface $usecase)
    {
        $this->usecase = $usecase;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        try {
            $this->usecase->process();
            return response()->json([], StatusCode::STATUS_CODE_NO_CONTENT->value)->withoutCookie('__session');
        } catch (Throwable $e) {
            return Response::json(
                [
                    'message' => $e->getMessage(),
                ],
                $e->getCode()
            );
        }
    }
}
