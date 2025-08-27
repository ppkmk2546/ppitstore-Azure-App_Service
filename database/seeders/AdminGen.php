<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminGen extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seededAdminEmail = 'choke.tri@rmutto.ac.th';
        $user = User::where('email', '=', $seededAdminEmail)->first();
        if ($user === null) {
            $user = User::create([
                'name' => 'Admin',
                'email' => $seededAdminEmail,
                'password' => Hash::make('admin123'),
                'utype' => 'ADM',
            ]);
        }
        $seededAdminID = '1';
        $profile = Profile::where('user_id', '=', $seededAdminID)->first();
        if ($profile === null) {
            $profile = Profile::create([
                'user_id' => '1',
                'image' => 'default_profile.png',
            ]);
        }
    }
}
