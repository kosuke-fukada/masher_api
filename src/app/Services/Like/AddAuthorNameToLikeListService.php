<?php
declare(strict_types=1);

namespace App\Services\Like;

use Illuminate\Support\Collection;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\User\AccessToken;
use App\Clients\GetTwitterUserById\GetTwitterUserByIdApiClientRequest;
use App\Interfaces\Services\Like\AddAuthorNameToLikeListServiceInterface;
use App\Interfaces\Clients\GetTwitterUserById\GetTwitterUserByIdApiClientInterface;

class AddAuthorNameToLikeListService implements AddAuthorNameToLikeListServiceInterface
{
    /**
     * @var GetTwitterUserByIdApiClientInterface
     */
    private GetTwitterUserByIdApiClientInterface $client;

    /**
     * @param GetTwitterUserByIdApiClientInterface $client
     */
    public function __construct(GetTwitterUserByIdApiClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param Collection $likeList
     * @param AccessToken $accessToken
     * @return array
     */
    public function process(Collection $likeList, AccessToken $accessToken): array
    {
        return $likeList->map(function ($like) use ($accessToken) {
            $apiRequest = new GetTwitterUserByIdApiClientRequest(
                new AuthorId($like->getAttribute('author_id')),
                $accessToken
            );
            $response = $this->client->process($apiRequest);
            $author = json_decode($response->contents(), true, 512, JSON_THROW_ON_ERROR);
            return [
                'id' => $like->getAttribute('id'),
                'tweet_id' => $like->getAttribute('tweet_id'),
                'author_id' => $like->getAttribute('author_id'),
                'author_name' => $author['username'],
                'like_count' => $like->getAttribute('like_count')
            ];
        })->toArray();
    }
}
