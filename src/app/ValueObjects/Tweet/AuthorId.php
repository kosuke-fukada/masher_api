<?php
declare(strict_types=1);

namespace App\ValueObjects\Tweet;

use InvalidArgumentException;
use App\ValueObjects\Foundation\StringValueObject;

class AuthorId extends StringValueObject
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

        if (!preg_match('/^[[:graph:]]+$/', $value)) {
            throw new InvalidArgumentException('Included invalid characters.');
        }
    }
}
