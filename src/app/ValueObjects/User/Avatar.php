<?php
declare(strict_types=1);

namespace App\ValueObjects\User;

use App\ValueObjects\Foundation\StringValueObject;
use InvalidArgumentException;

class Avatar extends StringValueObject
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
            throw new InvalidArgumentException(sprintf('%s is required.', get_class()));
        }

        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException(sprintf('%s must be URL.', get_class()));
        }

        if (!preg_match('/.*\.(jpg|jpeg|png|gif|bmp)$/', $value)) {
            throw new InvalidArgumentException(sprintf('%s must be an image file.', get_class()));
        }
    }
}
