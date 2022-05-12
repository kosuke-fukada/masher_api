<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\Tweet\GetTwitterLikeList;

use App\ValueObjects\Tweet\NextToken;

interface GetTwitterLikeListInputPort
{
    /**
     * @return NextToken
     */
    public function nextToken(): NextToken;
}
