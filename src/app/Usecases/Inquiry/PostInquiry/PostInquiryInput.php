<?php
declare(strict_types=1);

namespace App\Usecases\Inquiry\PostInquiry;

use App\Interfaces\Usecases\Inquiry\PostInquiry\PostInquiryInputPort;
use App\ValueObjects\Inquiry\Body;
use App\ValueObjects\Inquiry\Email;
use App\ValueObjects\Inquiry\Name;

class PostInquiryInput implements PostInquiryInputPort
{
    /**
     * @var Name
     */
    private Name $name;

    /**
     * @var Email
     */
    private Email $email;

    /**
     * @var Body
     */
    private Body $body;

    /**
     * @param Name $name
     * @param Email $email
     * @param Body $body
     */
    public function __construct(
        Name $name,
        Email $email,
        Body $body
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->body = $body;
    }

    /**
     * @return Name
     */
    public function name(): Name
    {
        return $this->name;
    }

    /**
     * @return Email
     */
    public function email(): Email
    {
        return $this->email;
    }

    /**
     * @return Body
     */
    public function body(): Body
    {
        return $this->body;
    }
}
