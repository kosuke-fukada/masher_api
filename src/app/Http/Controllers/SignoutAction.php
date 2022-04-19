<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Interfaces\Usecases\Signout\SignoutInterface;
use App\ValueObjects\Foundation\StatusCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

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
        $this->usecase->process();
        return Response::json([], StatusCode::STATUS_CODE_NO_CONTENT->value);
    }
}
