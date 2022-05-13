<?php
declare(strict_types=1);

namespace App\Http\User\GetTwitterUser;

use Throwable;
use Psr\Log\LoggerInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use App\Usecases\User\GetTwitterUser\GetTwitterUserInput;
use App\Interfaces\Usecases\User\GetTwitterUser\GetTwitterUserInterface;

class GetTwitterUserAction
{
    /**
     * @var GetTwitterUserInterface
     */
    private GetTwitterUserInterface $usecase;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param GetTwitterUserInterface $usecase
     * @param LoggerInterface $logger
     */
    public function __construct(
        GetTwitterUserInterface $usecase,
        LoggerInterface $logger
    )
    {
        $this->usecase = $usecase;
        $this->logger = $logger;
    }

    public function __invoke(GetTwitterUserRequest $request): JsonResponse
    {
        $input = new GetTwitterUserInput($request->userName());

        try {
            $response = $this->usecase->process($input);
        } catch (Throwable $e) {
            $this->logger->error((string)$e);
            return Response::json(
                [
                    'message' => $e->getMessage()
                ],
                $e->getCode()
            );
        }

        return Response::json($response);
    }
}
