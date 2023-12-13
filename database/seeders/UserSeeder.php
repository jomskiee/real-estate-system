<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\Client;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        User::truncate();

        $adminRole= Role::where('role_type', 'Administrator')->first();
        $privateRole= Role::where('role_type', 'Private')->first();
        $agentRole= Role::where('role_type', 'Agent')->first();
        $admin = User::create([
            'role_id' => $adminRole->id,
            'fname' => 'Administrator',
            'lname' => 'Admin',
            'mobile' => '09102341221',
            'province' => 'Bukidnon',
            'city' => 'Maramag',
            'barangay' => 'Poblacion',
            'email' => 'admin@mail.com',
            'active' => 1,
            'email_verified_at' => '2021-10-30 02:23:26',
            'password' => Hash::make('12345678')
        ]);

        $agent = User::create([
            'role_id' => $agentRole->id,
            'fname' => 'Agent',
            'lname' => 'agent',
            'mobile' => '09102342112',
            'province' => 'Bukidnon',
            'city' => 'Maramag',
            'barangay' => 'Poblacion',
            'email' => 'agent@mail.com',
            'active' => 1,
            'email_verified_at' => '2021-10-30 02:23:26',
            'password' => Hash::make('12345678')
        ]);
        $agency = Client::create([
            'user_id' => $agent->id,
            'agency_name' => 'Dela Torre Real Estate',
            'agency_address' => 'Poblacion, Maramag, Bukidnon',
            'office_no' => '09101231213'
        ]);
        $indiv = User::create([
            'role_id' =>  $privateRole->id,
            'fname' => 'Agusto',
            'lname' => 'Agento',
            'mobile' => '09102342112',
            'province' => 'Bukidnon',
            'city' => 'Maramag',
            'barangay' => 'Poblacion',
            'email' => 'agency@mail.com',
            'active' => 1,
            'email_verified_at' => '2021-10-30 02:23:26',
            'password' => Hash::make('password')
        ]);
        $agency2 = Client::create([
            'user_id' => $indiv->id,
        ]);

    }
}
