<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vvv = Visitor::connect('mysql_old')->get();

        foreach ($vvv as $v) {
            // Add default visitor
            $visitor = Visitor::create([
                'email'     =>  $v->email,
                'email_verified_at' => $v->email_verified_at,
                'password'  =>  $v->password,
                'is_blocked'    => 0,
            ]);
        }

        // Add visitor card
    }
}
