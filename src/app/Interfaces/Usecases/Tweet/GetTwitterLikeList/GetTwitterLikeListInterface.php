<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\Tweet\GetTwitterLikeList;

interface GetTwitterLikeListInterface
{
    /**
     * @param GetTwitterLikeListInputPort $input
     * @return array<int, mixed>
     */
    public function process(GetTwitterLikeListInputPort $input): array;
}
