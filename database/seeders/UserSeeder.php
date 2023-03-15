<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $users = DB::connection('mysql_old')->table('users')->get();
        foreach ($users as $user) {
            $usr = User::create([
                'email' => $user->email,
                'password' => $user->password,
                'is_blocked' => 0,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
            ]);
        }
    }
}
