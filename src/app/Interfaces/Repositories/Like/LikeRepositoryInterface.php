<?php
declare(strict_types=1);

namespace App\Interfaces\Repositories\Like;

use App\Models\Like;
use App\ValueObjects\Like\LikeIdentifier;

interface LikeRepositoryInterface
{
    /**
     * @param \App\Entities\Like\Like $like
     * @return Like
     */
    public function createLike(\App\Entities\Like\Like $like): Like;

    /**
     * @param LikeIdentifier $id
     * @return \App\Entities\Like\Like
     */
    public function findById(LikeIdentifier $id): \App\Entities\Like\Like;
}
