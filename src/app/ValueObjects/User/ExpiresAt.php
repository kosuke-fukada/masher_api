<?php
declare(strict_types=1);

namespace App\ValueObjects\User;

use Carbon\CarbonImmutable;

class ExpiresAt
{
    /**
     * @param CarbonImmutable $value
     */
    public function __construct(CarbonImmutable $value)
    {
        $this->value = $value;
    }

    /**
     * @return CarbonImmutable
     */
    public function toCarbon(): CarbonImmutable
    {
        return $this->value;
    }

    /**
     * @return boolean
     */
    public function isExpiredIn30Minutes(): bool
    {
        $now = CarbonImmutable::now();
        return $this->value->diffInSeconds($now) <= 1800;
    }

    /**
     * @return string
     */
    public function toDate(): string
    {
        return $this->value->format('Y-m-d H:i:s');
    }

    /**
     * @return integer
     */
    public function toTimestamp(): int
    {
        return $this->value->timestamp;
    }
}
