<?php
declare(strict_types=1);

namespace App\ValueObjects\Inquiry;

use InvalidArgumentException;
use App\ValueObjects\Foundation\StringValueObject;

class Email extends StringValueObject
{
    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    /**
     * @param string $value
     * @return void
     */
    protected function validate(string $value): void
    {
        if (mb_strlen($value) === 0) {
            throw new InvalidArgumentException(sprintf('%s is required.', __CLASS__));
        }

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(sprintf('%s must be email format.', __CLASS__));
        }
    }
}
