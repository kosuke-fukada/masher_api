<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\GetTweet;

interface GetTweetInterface
{
    /**
     * @param GetTweetInputPort $input
     * @return array
     */
    public function process(GetTweetInputPort $input): array;
}
