<?php
declare(strict_types=1);

namespace Tests\Usecases\User\GetTwitterUser;

use App\Interfaces\Usecases\User\GetTwitterUser\GetTwitterUserInputPort;
use App\Usecases\User\GetTwitterUser\GetTwitterUserInput;
use App\ValueObjects\Shared\UserName;
use PHPUnit\Framework\TestCase;

class GetTwitterUserInputTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $userName = 'test_user_name';
        $input = new GetTwitterUserInput(new UserName($userName));
        $this->assertInstanceOf(GetTwitterUserInputPort::class, $input);
        $this->assertSame($userName, (string)$input->userName());
    }
}
