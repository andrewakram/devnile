<?php

namespace Database\Seeders;

use App\Models\Supervisor;
use Illuminate\Database\Seeder;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supervisor::updateOrCreate([
        'email' => 'supervisor1@admin.com',
        ], [
            'name' => 'supervisor1',
            'phone' => '1234561',
            'password' => '123456',
        ]);

        Supervisor::updateOrCreate([
            'email' => 'supervisor2@admin.com',
        ], [
            'name' => 'supervisor2',
            'phone' => '1234562',
            'password' => '123456',
        ]);

        Supervisor::updateOrCreate([
            'email' => 'supervisor3@admin.com',
        ],[
            'name' => 'supervisor3',
            'phone' => '1234563',
            'password' => '123456',
        ]);
    }
}
