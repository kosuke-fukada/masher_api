<?php
declare(strict_types=1);

namespace App\Http\Like\GetLikeCount;

use App\ValueObjects\Shared\AccountId;
use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\User\UserId;
use Illuminate\Foundation\Http\FormRequest;

class GetLikeCountRequest extends FormRequest
{
    /**
     * @return boolean
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer'],
            'tweet_id' => ['required', 'string'],
            'author_id' => ['required', 'string'],
        ];
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
     * @return AccountId
     */
    public function authorId(): AccountId
    {
        return new AccountId((string)$this->get('author_id'));
    }
}
