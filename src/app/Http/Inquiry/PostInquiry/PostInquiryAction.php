<?php
declare(strict_types=1);

namespace App\Http\Inquiry\PostInquiry;

use App\Interfaces\Usecases\Inquiry\PostInquiry\PostInquiryInterface;
use App\Usecases\Inquiry\PostInquiry\PostInquiryInput;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Psr\Log\LoggerInterface;
use Throwable;

class PostInquiryAction
{
    /**
     * @var PostInquiryInterface
     */
    private PostInquiryInterface $usecase;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param PostInquiryInterface $usecase
     * @param LoggerInterface $logger
     */
    public function __construct(
        PostInquiryInterface $usecase,
        LoggerInterface $logger
    )
    {
        $this->usecase = $usecase;
        $this->logger = $logger;
    }

    public function __invoke(PostInquiryRequest $request): JsonResponse
    {
        try {
            $input = new PostInquiryInput(
                $request->name(),
                $request->email(),
                $request->body()
            );

            $this->usecase->process($input);
        } catch (Throwable $e) {
            $this->logger->error((string)$e);
            return Response::json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }

        return Response::json([], StatusCodeInterface::STATUS_NO_CONTENT);
    }
}
