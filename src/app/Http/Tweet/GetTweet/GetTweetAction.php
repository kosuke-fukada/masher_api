<?php
declare(strict_types=1);

namespace App\Http\Tweet\GetTweet;

use Throwable;
use Psr\Log\LoggerInterface;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Usecases\Tweet\GetTweet\GetTweetInput;
use App\Interfaces\Usecases\Tweet\GetTweet\GetTweetInterface;

class GetTweetAction extends Controller
{
    /**
     * @var GetTweetInterface
     */
    private GetTweetInterface $usecase;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param GetTweetInterface $usecase
     * @param LoggerInterface $logger
     */
    public function __construct(
        GetTweetInterface $usecase,
        LoggerInterface $logger
    )
    {
        $this->usecase = $usecase;
        $this->logger = $logger;
    }

    /**
     * @param GetTweetRequest $request
     * @return JsonResponse
     */
    public function __invoke(GetTweetRequest $request): JsonResponse
    {
        $input = new GetTweetInput(
            $request->tweetId(),
            $request->accountId(),
            $request->userName()
        );

        try {
            $tweet = $this->usecase->process($input);
        } catch (Throwable $e) {
            $this->logger->error((string)$e);
            return Response::json(
                [
                    'message' => $e->getMessage()
                ],
                $e->getCode()
            );
        }

        return Response::json($tweet);
    }
}
