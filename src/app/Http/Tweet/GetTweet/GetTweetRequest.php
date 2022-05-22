<?php
declare(strict_types=1);

namespace App\Http\Tweet\GetTweet;

use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\Shared\UserName;
use Illuminate\Foundation\Http\FormRequest;

class GetTweetRequest extends FormRequest
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
            'tweet_id' => ['required', 'string'],
            'author_id' => ['nullable', 'string'],
            'author_name' => ['required', 'string']
        ];
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
     * @return UserName
     */
    public function authorName(): UserName
    {
        return new UserName((string)$this->get('author_name'));
    }
}
