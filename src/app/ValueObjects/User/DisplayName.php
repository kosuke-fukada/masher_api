<?php
declare(strict_types=1);

namespace App\ValueObjects\User;

use InvalidArgumentException;
use App\ValueObjects\Foundation\StringValueObject;

class DisplayName extends StringValueObject
{
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
    }
}
