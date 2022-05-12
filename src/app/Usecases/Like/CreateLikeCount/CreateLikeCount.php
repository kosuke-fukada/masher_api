<?php
declare(strict_types=1);

namespace App\Usecases\Like\CreateLikeCount;

use App\Interfaces\Factories\Like\LikeFactoryInterface;
use App\Interfaces\Repositories\Like\LikeRepositoryInterface;
use App\Interfaces\Usecases\Like\CreateLikeCount\CreateLikeCountInputPort;
use App\Interfaces\Usecases\Like\CreateLikeCount\CreateLikeCountInterface;
use App\ValueObjects\Like\LikeIdentifier;
use RuntimeException;
use Throwable;

class CreateLikeCount implements CreateLikeCountInterface
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
     * @param CreateLikeCountInputPort $input
     * @return array<string, mixed>
     */
    public function process(CreateLikeCountInputPort $input): array
    {
        // Entityを作成
        $like = $this->likeFactory->createLike(
            $input->userId()->toInt(),
            (string)$input->tweetId(),
            (string)$input->accountId(),
            $input->likeCount()->toInt()
        );

        try {
            // 永続化
            $created = $this->likeRepository->createLike($like);

            // 返り値を元にEntityにidをセット
            $like->setLikeIdentifier(new LikeIdentifier((int)$created->getAttribute('id')));
        } catch (Throwable $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode());
        }

        return $like->toArray();
    }
}
