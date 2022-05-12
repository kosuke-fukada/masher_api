<?php
declare(strict_types=1);

namespace App\Http\User\Signout;

use App\Interfaces\Usecases\Signout\SignoutInterface;
use App\ValueObjects\Foundation\StatusCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Throwable;

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
            return Response::json([], StatusCode::STATUS_CODE_NO_CONTENT->value);
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
