<?php
declare(strict_types=1);

namespace App\ValueObjects\User;

use App\ValueObjects\Foundation\IntegerValueObject;
use InvalidArgumentException;

class UserId extends IntegerValueObject
{
    /**
     * @param integer $value
     */
    public function __construct(int $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    /**
     * @param integer $value
     * @return void
     */
    protected function validate(int $value): void
    {
        if ($value < 0) {
            throw new InvalidArgumentException(sprintf('%s must be bigger than 0.', get_class()));
        }
    }
}
