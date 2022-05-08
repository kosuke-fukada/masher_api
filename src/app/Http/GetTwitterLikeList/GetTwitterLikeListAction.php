<?php
declare(strict_types=1);

namespace App\Http\GetTwitterLikeList;

use Throwable;
use Psr\Log\LoggerInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use App\Interfaces\Usecases\GetTwitterLikeList\GetTwitterLikeListInterface;

class GetTwitterLikeListAction
{
    /**
     * @var GetTwitterLikeListInterface
     */
    private GetTwitterLikeListInterface $usecase;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    public function __construct(
        GetTwitterLikeListInterface $usecase,
        LoggerInterface $logger
    )
    {
        $this->usecase = $usecase;
        $this->logger = $logger;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        try {
            $list = $this->usecase->process();
        } catch (Throwable $e) {
            $this->logger->error((string)$e);
            return Response::json(
                [
                    'message' => $e->getMessage()
                ],
                $e->getCode()
            );
        }

        return Response::json($list);
    }
}
