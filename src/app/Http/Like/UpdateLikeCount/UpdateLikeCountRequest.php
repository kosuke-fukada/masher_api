<?php
declare(strict_types=1);

namespace App\Http\Like\UpdateLikeCount;

use App\ValueObjects\User\UserId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Like\LikeCount;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Like\LikeIdentifier;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLikeCountRequest extends FormRequest
{
    /**
     * @return boolean
     */
    public function authorize(): bool
    {
        return $this->user()->getAttribute('id') === (int)$this->get('user_id');
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'tweet_id' => ['required', 'string'],
            'author_id' => ['required', 'string'],
            'like_count' => ['required', 'integer'],
        ];
    }

    /**
     * @return LikeIdentifier
     */
    public function id(): LikeIdentifier
    {
        return new LikeIdentifier((int)$this->get('id'));
    }

    /**
     * @return UserId
     */
    public function userId(): UserId
    {
        return new UserId((int)$this->get('user_id'));
    }

    /**
     * @return TweetId
     */
    public function tweetId(): TweetId
    {
        return new TweetId((string)$this->get('tweet_id'));
    }

    /**
     * @return AuthorId
     */
    public function authorId(): AuthorId
    {
        return new AuthorId((string)$this->get('author_id'));
    }

    /**
     * @return LikeCount
     */
    public function likeCount(): LikeCount
    {
        return new LikeCount((int)$this->get('like_count'));
    }
}
