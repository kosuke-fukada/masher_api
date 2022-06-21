<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\Like\GetLikeList;

interface GetLikeListInterface
{
    /**
     * @param GetLikeListInputPort $input
     * @return array
     */
    public function process(GetLikeListInputPort $input): array;
}
