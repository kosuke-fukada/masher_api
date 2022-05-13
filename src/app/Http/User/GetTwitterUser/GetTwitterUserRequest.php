<?php
declare(strict_types=1);

namespace App\Http\User\GetTwitterUser;

use App\ValueObjects\Shared\UserName;
use Illuminate\Foundation\Http\FormRequest;

class GetTwitterUserRequest extends FormRequest
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
            'user_name' => ['required', 'string'],
        ];
    }

    /**
     * @return UserName
     */
    public function userName(): UserName
    {
        return new UserName((string)$this->get('user_name'));
    }
}
