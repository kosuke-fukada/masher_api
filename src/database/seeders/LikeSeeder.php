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
        DB::table('likes')->insert([
            'id' => 1,
            'user_id' => 1,
            'tweet_id' => '1',
            'author_id' => '1',
            'like_count' => 0,
        ]);
    }
}
