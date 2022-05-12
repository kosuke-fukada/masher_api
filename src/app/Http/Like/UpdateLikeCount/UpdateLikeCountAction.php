<?php
declare(strict_types=1);

namespace App\Http\Like\UpdateLikeCount;

use Throwable;
use Psr\Log\LoggerInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use App\Usecases\UpdateLikeCount\UpdateLikeCountInput;
use App\Interfaces\Usecases\UpdateLikeCount\UpdateLikeCountInterface;

class UpdateLikeCountAction
{
    /**
     * @var UpdateLikeCountInterface
     */
    private UpdateLikeCountInterface $usecase;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param UpdateLikeCountInterface $usecase
     * @param LoggerInterface $logger
     */
    public function __construct(
        UpdateLikeCountInterface $usecase,
        LoggerInterface $logger
    )
    {
        $this->usecase = $usecase;
        $this->logger = $logger;
    }

    /**
     * @param UpdateLikeCountRequest $request
     * @return JsonResponse
     */
    public function __invoke(UpdateLikeCountRequest $request): JsonResponse
    {
        $input = new UpdateLikeCountInput(
            $request->id(),
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
