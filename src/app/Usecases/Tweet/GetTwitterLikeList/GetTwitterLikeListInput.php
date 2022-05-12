<?php
declare(strict_types=1);

namespace App\Usecases\Tweet\GetTwitterLikeList;

use App\Interfaces\Usecases\Tweet\GetTwitterLikeList\GetTwitterLikeListInputPort;
use App\ValueObjects\Tweet\NextToken;

class GetTwitterLikeListInput implements GetTwitterLikeListInputPort
{
    /**
     * @var NextToken
     */
    private NextToken $nextToken;

    /**
     * @param NextToken $nextToken
     */
    public function __construct(NextToken $nextToken)
    {
        $this->nextToken = $nextToken;
    }

    /**
     * @return NextToken
     */
    public function nextToken(): NextToken
    {
        return $this->nextToken;
    }
}
