<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\GetTwitterLikeList;

interface GetTwitterLikeListInterface
{
    /**
     * @return array<int, mixed>
     */
    public function process(): array;
}
