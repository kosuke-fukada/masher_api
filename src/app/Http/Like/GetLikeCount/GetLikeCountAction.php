<?php
declare(strict_types=1);

namespace App\Http\Like\GetLikeCount;

use Throwable;
use Psr\Log\LoggerInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use App\Usecases\Like\GetLikeCount\GetLikeCountInput;
use App\Interfaces\Usecases\Like\GetLikeCount\GetLikeCountInterface;

class GetLikeCountAction
{
    /**
     * @var GetLikeCountInterface
     */
    private GetLikeCountInterface $usecase;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param GetLikeCountInterface $usecase
     * @param LoggerInterface $logger
     */
    public function __construct(
        GetLikeCountInterface $usecase,
        LoggerInterface $logger
    )
    {
        $this->usecase = $usecase;
        $this->logger = $logger;
    }

    /**
     * @param GetLikeCountRequest $request
     * @return JsonResponse
     */
    public function __invoke(GetLikeCountRequest $request): JsonResponse
    {
        $input = new GetLikeCountInput(
            $request->userId(),
            $request->tweetId(),
            $request->authorId()
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
