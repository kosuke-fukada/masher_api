<?php
declare(strict_types=1);

namespace App\Http\RefreshTwitterAccessToken;

use Throwable;
use Psr\Log\LoggerInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Fig\Http\Message\StatusCodeInterface;
use App\Interfaces\Usecases\RefreshTwitterAccessToken\RefreshTwitterAccessTokenInterface;

class RefreshTwitterAccessTokenAction
{
    /**
     * @var RefreshTwitterAccessTokenInterface
     */
    private RefreshTwitterAccessTokenInterface $usecase;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param RefreshTwitterAccessTokenInterface $usecase
     * @param LoggerInterface $logger
     */
    public function __construct(
        RefreshTwitterAccessTokenInterface $usecase,
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
            $this->usecase->process();
        } catch (Throwable $e) {
            $this->logger->error((string)$e);
            return Response::json(
                [
                    'message' => $e->getMessage()
                ],
                $e->getCode()
            );
        }

        return Response::json([], StatusCodeInterface::STATUS_NO_CONTENT);
    }
}
