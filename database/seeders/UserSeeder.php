<?php
namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'     => 'Admin',
            'email'    => 'lurah@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('admin');

        User::create([
            'name'     => 'Kepala Keluarga',
            'email'    => 'headoffamily@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('head-of-family');

        UserFactory::new ()->count(15)->create();
    }
}
