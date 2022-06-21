<?php
declare(strict_types=1);

namespace Tests\Services\Like;

use App\Interfaces\Services\Like\AddAuthorNameToLikeListServiceInterface;
use App\Services\Like\AddAuthorNameToLikeListService;
use App\ValueObjects\User\AccessToken;
use Tests\StrGenerator;
use Tests\TestCase;

class AddAuthorNameToLikeListServiceTest extends TestCase
{
    /**
     * @return AddAuthorNameToLikeListServiceInterface
     */
    public function test__construct(): AddAuthorNameToLikeListServiceInterface
    {
        $service = $this->app->make(AddAuthorNameToLikeListServiceInterface::class);
        $this->assertInstanceOf(AddAuthorNameToLikeListService::class, $service);
        return $service;
    }

    /**
     * @depends test__construct
     * @param AddAuthorNameToLikeListServiceInterface $service
     * @return void
     */
    public function testProcess(AddAuthorNameToLikeListServiceInterface $service): void
    {
        $like = (new \App\Models\Like())->newQuery()->first();
        $likeList = collect([$like]);
        $result = $service->process($likeList, new AccessToken(StrGenerator::generateRandomString()));
        $this->assertSame(1, $result[0]['id']);
        $this->assertSame('1', $result[0]['tweet_id']);
        $this->assertSame('1', $result[0]['author_id']);
        $this->assertSame('test_user_name', $result[0]['author_name']);
        $this->assertSame(10, $result[0]['like_count']);
    }
}
