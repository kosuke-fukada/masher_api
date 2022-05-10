<?php
declare(strict_types=1);

namespace App\Http\GetTweet;

use App\ValueObjects\Tweet\TweetId;
use App\ValueObjects\Shared\AccountId;
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
            'account_id' => ['required', 'string'],
            'user_name' => ['required', 'string']
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
     * @return AccountId
     */
    public function accountId(): AccountId
    {
        return new AccountId((string)$this->get('account_id'));
    }

    /**
     * @return UserName
     */
    public function userName(): UserName
    {
        return new UserName((string)$this->get('user_name'));
    }
}
