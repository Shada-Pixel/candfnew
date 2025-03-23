<?php

namespace Database\Seeders;

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
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AgentSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BankSeeder::class);
        $this->call(NoticeSeeder::class);
        $this->call(BankAccountSeeder::class);
        $this->call(BankTransactionSeeder::class);
        $this->call(IeDataSeeder::class);
        $this->call(FileDataSeeder::class);
    }
}
