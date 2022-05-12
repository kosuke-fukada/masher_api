<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\UpdateLikeCount;

interface UpdateLikeCountInterface
{
    /**
     * @param UpdateLikeCountInputPort $input
     * @return void
     */
    public function process(UpdateLikeCountInputPort $input): void;
}
