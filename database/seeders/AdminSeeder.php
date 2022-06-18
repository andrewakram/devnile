<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::updateOrCreate([
            'email' => 'admin1@admin.com',
        ], [
            'name' => 'admin1',
            'phone' => '1234561',
            'password' => '123456',
        ]);

        Admin::updateOrCreate([
            'email' => 'admin2@admin.com',
        ], [
            'name' => 'admin2',
            'phone' => '1234562',
            'password' => '123456',
        ]);

        Admin::updateOrCreate([
            'email' => 'admin3@admin.com',
        ],[
            'name' => 'admin3',
            'phone' => '1234563',
            'password' => '123456',
        ]);
    }
}
