<?php
declare(strict_types=1);

namespace App\ValueObjects\Like;

use App\ValueObjects\Foundation\IntegerValueObject;
use InvalidArgumentException;

class LikeCount extends IntegerValueObject
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
            throw new InvalidArgumentException(sprintf('%s must be unsigned.', get_class()));
        }
    }
}
