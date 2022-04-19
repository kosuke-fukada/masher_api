<?php
declare(strict_types=1);

namespace Tests\Usecases\Signout;

use App\Interfaces\Usecases\Signout\SignoutInterface;
use App\Usecases\Signout\Signout;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class SignoutTest extends TestCase
{
    /**
     * @return SignoutInterface
     */
    public function test__construct(): SignoutInterface
    {
        $signout = $this->app->make(SignoutInterface::class);
        $this->assertInstanceOf(Signout::class, $signout);
        return $signout;
    }

    /**
     * @depends test__construct
     * @param SignoutInterface $signout
     * @return void
     */
    public function testProcess(SignoutInterface $signout): void
    {
        $signout->process();
        $this->assertFalse(Auth::check());
    }
}
