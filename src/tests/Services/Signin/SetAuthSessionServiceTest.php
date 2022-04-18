<?php
declare(strict_types=1);

namespace Tests\Services\Signin;

use App\Interfaces\Services\Signin\SetAuthSessionServiceInterface;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\Signin\SetAuthSessionService;

class SetAuthSessionServiceTest extends TestCase
{
    /**
     * @return SetAuthSessionServiceInterface
     */
    public function test__construct(): SetAuthSessionServiceInterface
    {
        $setAuthSessionService = $this->app->make(SetAuthSessionServiceInterface::class);
        $this->assertInstanceOf(SetAuthSessionService::class, $setAuthSessionService);
        return $setAuthSessionService;
    }

    /**
     * @depends test__construct
     * @param SetAuthSessionServiceInterface $setAuthSessionService
     * @return void
     */
    public function testProcess(SetAuthSessionServiceInterface $setAuthSessionService): void
    {
        $user = new User();
        $userId = $setAuthSessionService->process($user);
        $this->assertTrue(Auth::check());
        $this->assertSame(1, $userId);
    }
}
