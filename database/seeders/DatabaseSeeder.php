<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            CategoryPSeeder::class,
            FixWinWinCategoryRootSeeder::class,
            RemoveBatDongSanCategoryPSeeder::class,
            CategoryNSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            RolePermissionSeeder::class,
            TitleSeeder::class,
            SettingSeeder::class,
            OauthClientsSeeder::class
        ]);
    }

}
