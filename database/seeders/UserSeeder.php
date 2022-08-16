<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'first_name' => 'Sheina',
            'last_name' => 'Paclibar',
            'email' => 'sheinavi@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('Esperanza2004!')
        ]);

        $admin->assignRole('admin');
    }
}
