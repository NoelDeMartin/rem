<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\ApplicationModel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Noel De Martin',
            'email' => 'noeldemartin@hey.com',
            'password' => Hash::make('secret'),
        ]);

        Application::factory(10)
            ->has(ApplicationModel::factory()->count(3), 'models')
            ->create();
    }
}
