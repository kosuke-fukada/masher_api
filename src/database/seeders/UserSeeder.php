<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'account_id' => 'test_account_id',
            'user_name' => 'test_user_name',
            'display_name' => 'test_display_name',
            'avatar' => 'https://example.com/test_image.png',
            'access_token' => 'test_access_token',
            'refresh_token' => 'test_refresh_token',
            'expires_at' => date('Y-m-d H:i:s'),
            'provider' => 'twitter',
            'remember_token' => 'test_remember_token',
        ]);
    }
}
