<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nip' => '123',
            'name' => 'Admin Aplikasi',
            'email' => 'admin@gmail.com',
            'email_verified_at' => Carbon::now(), // Tambahkan field email_verified_at
            'password' => bcrypt('admin123'),
            'role' => 'Admin',
            'profile_image' => Storage::url('profile_images/default/user.png'), // Menggunakan Storage::url()
            'latitude' => '-7.00582,',
            'longitude' => '107.52632',
            'remember_token' => Str::random(60),
        ]);
    }
}
