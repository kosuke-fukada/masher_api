<?php
declare(strict_types=1);

namespace App\Http\Like\GetLikeList;

use App\Interfaces\Usecases\Like\GetLikeList\GetLikeListInterface;
use App\Usecases\Like\GetLikeList\GetLikeListInput;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Psr\Log\LoggerInterface;
use Throwable;

class GetLikeListAction
{
    /**
     * @var GetLikeListInterface
     */
    private GetLikeListInterface $usecase;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param GetLikeListInterface $usecase
     * @param LoggerInterface $logger
     */
    public function __construct(
        GetLikeListInterface $usecase,
        LoggerInterface $logger
    )
    {
        $this->usecase = $usecase;
        $this->logger = $logger;
    }

    public function __invoke(GetLikeListRequest $request): JsonResponse
    {
        $input = new GetLikeListInput(
            $request->userId(),
            $request->orderKey(),
            $request->orderValue()
        );

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
