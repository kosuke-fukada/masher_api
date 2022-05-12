<?php
declare(strict_types=1);

namespace App\Http\Like\CreateLikeCount;

use Throwable;
use Psr\Log\LoggerInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use App\Http\CreateLikeCount\CreateLikeCountRequest;
use App\Usecases\Like\CreateLikeCount\CreateLikeCountInput;
use App\Interfaces\Usecases\Like\CreateLikeCount\CreateLikeCountInterface;

class CreateLikeCountAction
{
    /**
     * @var CreateLikeCountInterface
     */
    private CreateLikeCountInterface $usecase;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param CreateLikeCountInterface $usecase
     * @param LoggerInterface $logger
     */
    public function __construct(
        CreateLikeCountInterface $usecase,
        LoggerInterface $logger
    )
    {
        $this->usecase = $usecase;
        $this->logger = $logger;
    }

    /**
     * @param CreateLikeCountRequest $request
     * @return JsonResponse
     */
    public function __invoke(CreateLikeCountRequest $request): JsonResponse
    {
        $input = new CreateLikeCountInput(
            $request->userId(),
            $request->tweetId(),
            $request->accountId(),
            $request->likeCount()
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
