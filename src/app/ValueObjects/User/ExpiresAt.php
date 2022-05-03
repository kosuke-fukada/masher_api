<?php
declare(strict_types=1);

namespace App\ValueObjects\User;

use App\ValueObjects\Foundation\IntegerValueObject;
use InvalidArgumentException;

class ExpiresAt extends IntegerValueObject
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
        if ($value <= 0) {
            throw new InvalidArgumentException(sprintf('%s must be larger than 0', get_class()));
        }
    }

    /**
     * @return boolean
     */
    public function isExpiredIn30Minutes(): bool
    {
        return $this->value - time() <= 1800;
    }

    /**
     * @return string
     */
    public function toDate(): string
    {
        return date('Y-m-d H:i:s', $this->value);
    }
}
