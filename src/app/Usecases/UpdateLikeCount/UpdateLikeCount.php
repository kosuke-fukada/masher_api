<?php
declare(strict_types=1);

namespace App\Usecases\UpdateLikeCount;

use App\Interfaces\Factories\Like\LikeFactoryInterface;
use App\Interfaces\Repositories\Like\LikeRepositoryInterface;
use App\Interfaces\Usecases\UpdateLikeCount\UpdateLikeCountInputPort;
use App\Interfaces\Usecases\UpdateLikeCount\UpdateLikeCountInterface;
use RuntimeException;
use Throwable;

class UpdateLikeCount implements UpdateLikeCountInterface
{
    /**
     * @var LikeFactoryInterface
     */
    private LikeFactoryInterface $likeFactory;

    /**
     * @var LikeRepositoryInterface
     */
    private LikeRepositoryInterface $likeRepository;

    /**
     * @param LikeFactoryInterface $likeFactory
     * @param LikeRepositoryInterface $likeRepository
     */
    public function __construct(
        LikeFactoryInterface $likeFactory,
        LikeRepositoryInterface $likeRepository
    )
    {
        $this->likeFactory = $likeFactory;
        $this->likeRepository = $likeRepository;
    }

    /**
     * @param UpdateLikeCountInputPort $input
     * @return void
     */
    public function process(UpdateLikeCountInputPort $input): void
    {
        try {
            // idから取得
            $like = $this->likeRepository->findById($input->likeIdentifier());

            // Entityを更新
            $like->updateLikeCount($input->likeCount());

            // 永続化
            $this->likeRepository->updateLikeCount($like);
        } catch (Throwable $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode());
        }
    }
}
