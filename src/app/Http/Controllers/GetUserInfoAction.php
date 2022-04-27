<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Interfaces\Usecases\GetUserInfo\GetUserInfoInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Throwable;

class GetUserInfoAction extends Controller
{
    /**
     * @var GetUserInfoInterface
     */
    private GetUserInfoInterface $usecase;

    /**
     * @param GetUserInfoInterface $usecase
     */
    public function __construct(GetUserInfoInterface $usecase)
    {
        $this->usecase = $usecase;
    }

    /**
     * @return void
     */
    public function __invoke(): JsonResponse
    {
        try {
            $userInfo = $this->usecase->process();
            return Response::json($userInfo ? $userInfo->toArrayWithoutCredentials() : []);
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
