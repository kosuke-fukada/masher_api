<?php
declare(strict_types=1);

namespace App\Repositories\Like;

use App\Interfaces\Factories\Like\LikeFactoryInterface;
use App\Interfaces\Repositories\Like\LikeRepositoryInterface;
use App\Models\Like;
use App\ValueObjects\Like\LikeIdentifier;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Database\RecordsNotFoundException;

class LikeRepository implements LikeRepositoryInterface
{
    /**
     * @var Like
     */
    private Like $model;

    /**
     * @var LikeFactoryInterface
     */
    private LikeFactoryInterface $factory;

    /**
     * @param Like $model
     * @param LikeFactoryInterface $factory
     */
    public function __construct(
        Like $model,
        LikeFactoryInterface $factory
    )
    {
        $this->model = $model;
        $this->factory = $factory;
    }

    /**
     * @param \App\Entities\Like\Like $like
     * @return Like
     */
    public function createLike(\App\Entities\Like\Like $like): Like
    {
        return $this->model->newQuery()->create([
            'user_id' => $like->userId()->toInt(),
            'tweet_id' => (string)$like->tweetId(),
            'author_id' => (string)$like->accountId(),
            'like_count' => $like->likeCount()->toInt()
        ]);
    }

    /**
     * @param LikeIdentifier $id
     * @return \App\Entities\Like\Like
     */
    public function findById(LikeIdentifier $id): \App\Entities\Like\Like
    {
        $like = $this->model->newQuery()->find($id->toInt());
        if (is_null($like)) {
            throw new RecordsNotFoundException('Not found.', StatusCodeInterface::STATUS_NOT_FOUND);
        }

        $likeEntity = $this->factory->createLike(
            (int)$like->getAttribute('user_id'),
            (string)$like->getAttribute('tweet_id'),
            (string)$like->getAttribute('author_id'),
            (int)$like->getAttribute('like_count')
        );
        $likeEntity->setLikeIdentifier($id);

        return $likeEntity;
    }

    /**
     * @param \App\Entities\Like\Like $like
     * @return void
     */
    public function updateLikeCount(\App\Entities\Like\Like $like): void
    {
        $this->model->newQuery()->find($like->likeIdentifier()->toInt())
            ->fill([
                'like_count' => $like->likeCount()->toInt()
            ])
            ->save();
    }
}
