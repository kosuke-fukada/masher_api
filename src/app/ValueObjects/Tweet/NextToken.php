<?php
declare(strict_types=1);

namespace App\ValueObjects\Tweet;

use App\ValueObjects\Foundation\StringValueObject;

class NextToken extends StringValueObject
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
        //
    }

    /**
     * @return boolean
     */
    public function existNext(): bool
    {
        return mb_strlen($this->value) > 0;
    }
}
