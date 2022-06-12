<?php
declare(strict_types=1);

namespace App\ValueObjects\Inquiry;

use InvalidArgumentException;
use App\ValueObjects\Foundation\StringValueObject;

class Body extends StringValueObject
{
    public const MAX_LENGTH = 500;

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

        if (mb_strlen($value) > self::MAX_LENGTH) {
            throw new InvalidArgumentException(sprintf('%s must be %s length.', __CLASS__, self::MAX_LENGTH));
        }
    }
}
