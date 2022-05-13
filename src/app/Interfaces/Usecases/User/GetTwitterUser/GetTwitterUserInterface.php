<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\User\GetTwitterUser;

interface GetTwitterUserInterface
{
    /**
     * @param GetTwitterUserInputPort $input
     * @return array<string, mixed>
     */
    public function process(GetTwitterUserInputPort $input): array;
}
