<?php
declare(strict_types=1);

namespace App\Usecases\Like\GetLikeList;

use App\Interfaces\Usecases\Like\GetLikeList\GetLikeListInputPort;
use App\Interfaces\Usecases\Like\GetLikeList\GetLikeListInterface;
use App\Models\Like;

class GetLikeList implements GetLikeListInterface
{
    private const PAGINATE_LENGTH = 10;

    /**
     * @var Like
     */
    private Like $model;

    /**
     * @param Like $model
     */
    public function __construct(Like $model)
    {
        $this->model = $model;
    }
    /**
     * @param GetLikeListInputPort $input
     * @return array
     */
    public function process(GetLikeListInputPort $input): array
    {
        $query = $this->model->newQuery()
            ->where('user_id', '=', $input->userId()->toInt())
            ->orderBy($input->orderKey()->value, $input->orderValue()->value);

        $paginate = $query->paginate(self::PAGINATE_LENGTH);
        $items = array_map(static function ($item) {
            return $item->toArray();
        }, $paginate->items());

        return [
            'like_list' => $items,
            'current_page' => $paginate->currentPage(),
            'total' => $paginate->total(),
            'count' => $paginate->count()
        ];
    }
}
