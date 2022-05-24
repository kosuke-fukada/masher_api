<?php
declare(strict_types=1);

namespace App\Usecases\Like\GetLikeCount;

use App\Interfaces\Factories\Like\LikeFactoryInterface;
use App\Interfaces\Usecases\Like\GetLikeCount\GetLikeCountInputPort;
use App\Interfaces\Usecases\Like\GetLikeCount\GetLikeCountInterface;
use App\Models\Like;
use App\ValueObjects\Like\LikeIdentifier;

class GetLikeCount implements GetLikeCountInterface
{
    /**
     * @var Like
     */
    private Like $model;

    /**
     * @var LikeFactoryInterface
     */
    private LikeFactoryInterface $likeFactory;

    /**
     * @param Like $model
     * @param LikeFactoryInterface $likeFactory
     */
    public function __construct(
        Like $model,
        LikeFactoryInterface $likeFactory
    )
    {
        $this->model = $model;
        $this->likeFactory = $likeFactory;
    }

    /**
     * @param GetLikeCountInputPort $input
     * @return array<string, mixed>
     */
    public function process(GetLikeCountInputPort $input): array
    {
        $like = $this->model->newQuery()
            ->where('user_id', '=', $input->userId()->toInt())
            ->where('tweet_id', '=', (string)$input->tweetId())
            ->first();

        if (is_null($like)) {
            $likeCount = 0;
        } else {
            $likeCount = $like->getAttribute('like_count');
        }

        $likeEntity = $this->likeFactory->createLike(
            $input->userId()->toInt(),
            (string)$input->tweetId(),
            (string)$input->authorId(),
            $likeCount
        );
        $likeEntity->setLikeIdentifier(new LikeIdentifier((int)$like->getAttribute('id')));
        return $likeEntity->toArray();
    }
}
