<?php
declare(strict_types=1);

namespace App\ValueObjects\User;

use Carbon\Carbon;

class ExpiresAt
{
    /**
     * @param Carbon $value
     */
    public function __construct(Carbon $value)
    {
        $this->value = $value;
    }

    /**
     * @return Carbon
     */
    public function toCarbon(): Carbon
    {
        return $this->value;
    }

    /**
     * @return boolean
     */
    public function isExpiredIn30Minutes(): bool
    {
        $now = Carbon::now();
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
