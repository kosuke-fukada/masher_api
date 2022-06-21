<?php
declare(strict_types=1);

namespace App\Http\Like\GetLikeList;

use App\ValueObjects\Shared\OrderKey;
use App\ValueObjects\Shared\OrderValue;
use App\ValueObjects\User\UserId;
use Illuminate\Foundation\Http\FormRequest;

class GetLikeListRequest extends FormRequest
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
            'user_id' => ['required', 'integer'],
            'order_key' => ['nullable', 'string'],
            'order_value' => ['nullable', 'string'],
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
     * @return OrderKey
     */
    public function orderKey(): OrderKey
    {
        return OrderKey::from((string)$this->get('order_key', 'id'));
    }

    /**
     * @return OrderValue
     */
    public function orderValue(): OrderValue
    {
        return OrderValue::from((string)$this->get('order_value', 'desc'));
    }
}
