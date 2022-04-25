<?php
declare(strict_types=1);

namespace App\ValueObjects\User;

use InvalidArgumentException;

class RefreshToken
{
    /**
     * @param string|null $value
     */
    public function __construct(?string $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    /**
     * @param string|null $value
     * @return void
     */
    protected function validate(?string $value): void
    {
        if (is_null($value)) {
            return;
        }

        if (mb_strlen($value) === 0) {
            return;
        }

        if (!preg_match('/^[[:graph:]]+$/', $value)) {
            throw new InvalidArgumentException('Included invalid characters.');
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value ?? '';
    }
}
