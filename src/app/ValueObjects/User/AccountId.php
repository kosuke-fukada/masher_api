<?php
declare(strict_types=1);

namespace App\ValueObjects\User;

use App\ValueObjects\Foundation\IntegerValueObject;
use InvalidArgumentException;

class AccountId extends IntegerValueObject
{
    /**
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    /**
     * @param int $value
     * @return void
     */
    protected function validate(int $value): void
    {
        if ($value < 0) {
            throw new InvalidArgumentException(sprintf('%s must be bigger than 0.', get_class()));
        }
    }
}
