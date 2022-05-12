<?php
declare(strict_types=1);

namespace Tests\Usecases\Tweet\GetTwitterLikeList;

use App\Interfaces\Usecases\Tweet\GetTwitterLikeList\GetTwitterLikeListInputPort;
use App\Usecases\Tweet\GetTwitterLikeList\GetTwitterLikeListInput;
use App\ValueObjects\Tweet\NextToken;
use PHPUnit\Framework\TestCase;

class GetTwitterLikeListInputTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $nextToken = 'test_next_token';
        $input = new GetTwitterLikeListInput(
            new NextToken($nextToken)
        );
        $this->assertInstanceOf(GetTwitterLikeListInputPort::class, $input);
        $this->assertSame($nextToken, (string)$input->nextToken());
    }
}
