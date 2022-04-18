<?php
declare(strict_types=1);

namespace App\ValueObjects\Foundation;

abstract class IntegerValueObject
{
    /**
     * @var int
     */
    protected int $value;

    /**
     * @param int $value
     */
    abstract public function __construct(int $value);

    /**
     * @param int $value
     * @return void
     */
    abstract protected function validate(int $value): void;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->value;
    }

    /**
     * @return int
     */
    public function toInt(): int
    {
        return $this->value;
    }
}
