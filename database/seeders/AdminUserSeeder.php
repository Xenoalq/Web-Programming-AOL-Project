<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        // 1. php artisan tinker
        // 2. jalankan code dibawah untuk mengubah pass admin
        // use App\Models\User;
        // use Illuminate\Support\Facades\Hash;

        // // Find the user by ID 1
        // $user = User::find(1);

        // // Set the new password hash
        // if ($user) {
        //     $user->users_pass = Hash::make('admin123'); // Set the new plaintext password to 'admin123'
        //     $user->save();
        //     echo "Password for Admin Boss (ID 1) reset to 'admin123' successfully!\n";
        // } else {
        //     echo "Admin user not found.\n";
        // }
    }
}
