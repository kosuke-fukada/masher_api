<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\Like\CreateLikeCount;

interface CreateLikeCountInterface
{
    /**
     * @param CreateLikeCountInputPort $input
     * @return array<string, mixed>
     */
    public function process(CreateLikeCountInputPort $input): array;
}
