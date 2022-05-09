<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\GetTwitterLikeList;

use App\ValueObjects\Tweet\NextToken;

interface GetTwitterLikeListInputPort
{
    /**
     * @return NextToken
     */
    public function nextToken(): NextToken;
}
