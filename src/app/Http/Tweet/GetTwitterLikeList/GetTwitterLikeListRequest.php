<?php
declare(strict_types=1);

namespace App\Http\Tweet\GetTwitterLikeList;

use App\ValueObjects\Tweet\NextToken;
use Illuminate\Foundation\Http\FormRequest;

class GetTwitterLikeListRequest extends FormRequest
{
    /**
     * @return boolean
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'next_token' => ['nullable', 'string']
        ];
    }

    /**
     * @return NextToken
     */
    public function nextToken(): NextToken
    {
        return new NextToken((string)$this->get('next_token', ''));
    }
}
