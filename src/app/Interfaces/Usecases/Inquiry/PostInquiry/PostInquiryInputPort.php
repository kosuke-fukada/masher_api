<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\Inquiry\PostInquiry;

use App\ValueObjects\Inquiry\Body;
use App\ValueObjects\Inquiry\Email;
use App\ValueObjects\Inquiry\Name;

interface PostInquiryInputPort
{
    /**
     * @return Name
     */
    public function name(): Name;

    /**
     * @return Email
     */
    public function email(): Email;

    /**
     * @return Body
     */
    public function body(): Body;
}
