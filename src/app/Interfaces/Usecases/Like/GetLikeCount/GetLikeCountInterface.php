<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\Like\GetLikeCount;

interface GetLikeCountInterface
{
    /**
     * @param GetLikeCountInputPort $input
     * @return array<string, mixed>
     */
    public function process(GetLikeCountInputPort $input): array;
}
