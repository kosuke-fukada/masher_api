<?php
declare(strict_types=1);

namespace App\Http\Inquiry\PostInquiry;

use App\ValueObjects\Inquiry\Body;
use App\ValueObjects\Inquiry\Email;
use App\ValueObjects\Inquiry\Name;
use Illuminate\Foundation\Http\FormRequest;

class PostInquiryRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email:filter'],
            'body' => ['required', 'string', 'max:500'],
        ];
    }

    /**
     * @return Name
     */
    public function name(): Name
    {
        return new Name((string)$this->get('name'));
    }

    /**
     * @return Email
     */
    public function email(): Email
    {
        return new Email((string)$this->get('email'));
    }

    /**
     * @return Body
     */
    public function body(): Body
    {
        return new Body((string)$this->get('body'));
    }
}
