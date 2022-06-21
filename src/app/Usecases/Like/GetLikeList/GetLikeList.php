<?php
declare(strict_types=1);

namespace App\Usecases\Like\GetLikeList;

use App\Interfaces\Repositories\User\UserRepositoryInterface;
use App\Models\Like;
use RuntimeException;
use Fig\Http\Message\StatusCodeInterface;
use App\Interfaces\Usecases\Like\GetLikeList\GetLikeListInputPort;
use App\Interfaces\Usecases\Like\GetLikeList\GetLikeListInterface;
use App\Interfaces\Services\Like\AddAuthorNameToLikeListServiceInterface;
use App\ValueObjects\User\AccessToken;

class GetLikeList implements GetLikeListInterface
{
    private const PAGINATE_LENGTH = 10;

    /**
     * @var Like
     */
    private Like $model;

    /**
     * @var AddAuthorNameToLikeListServiceInterface
     */
    private AddAuthorNameToLikeListServiceInterface $addAuthorNameToLikeListService;

    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * @param Like $model
     * @param AddAuthorNameToLikeListServiceInterface $addAuthorNameToLikeListService
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        Like $model,
        AddAuthorNameToLikeListServiceInterface $addAuthorNameToLikeListService,
        UserRepositoryInterface $userRepository
    )
    {
        $this->model = $model;
        $this->addAuthorNameToLikeListService = $addAuthorNameToLikeListService;
        $this->userRepository = $userRepository;
    }

    /**
     * @param GetLikeListInputPort $input
     * @return array
     */
    public function process(GetLikeListInputPort $input): array
    {
        $authUser = $this->userRepository->findAuthUser();
        if (is_null($authUser)) {
            throw new RuntimeException('User is not signed in.', StatusCodeInterface::STATUS_FORBIDDEN);
        }

        $query = $this->model->newQuery()
            ->where('user_id', '=', $input->userId()->toInt())
            ->orderBy($input->orderKey()->value, $input->orderValue()->value);

        $paginate = $query->paginate(self::PAGINATE_LENGTH);
        $likeList = $this->addAuthorNameToLikeListService->process(
            $paginate->getCollection(),
            new AccessToken($authUser->getAttribute('access_token'))
        );

        return [
            'like_list' => $likeList,
            'current_page' => $paginate->currentPage(),
            'total' => $paginate->total(),
            'count' => $paginate->count()
        ];
    }
}
