<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Permission;
use App\Models\PermissionLevel;
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

        $user = User::factory()->create([
            'name' => 'roses.duke',
            'email' => 'roses.duke@gmail.com',
        ]);

        $user->permission()->save(
            Permission::create(['level' => PermissionLevel::ADMIN]),
        );
    }
}
