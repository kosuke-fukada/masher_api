<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('likes')->insert(
            [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'tweet_id' => '1',
                    'author_id' => '1',
                    'like_count' => 10,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 2,
                    'user_id' => 1,
                    'tweet_id' => '2',
                    'author_id' => '2',
                    'like_count' => 20,
                    'created_at' => now()->addHour(),
                    'updated_at' => now()->addHour()
                ],
                [
                    'id' => 3,
                    'user_id' => 1,
                    'tweet_id' => '3',
                    'author_id' => '3',
                    'like_count' => 15,
                    'created_at' => now()->addHour(2),
                    'updated_at' => now()->addHour(2)
                ],
            ]
        );
    }
}
