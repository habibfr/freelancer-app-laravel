<?php

namespace Database\Seeders;

use App\Models\DetailUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DetailUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $detail_users = [
            [
                'users_id'          => 1,
                'photo'             => "",
                'role'              => "Website Developer",
                'contact_number'    => "",
                'biography'         => "",
                'created_at'        => date('Y-m-d h:i:s'),
                'updated_at'        => date('Y-m-d h:i:s'),
            ],
            [
                'users_id'          => 2,
                'photo'             => "",
                'role'              => "Mobile Developer",
                'contact_number'    => "",
                'biography'         => "",
                'created_at'        => date('Y-m-d h:i:s'),
                'updated_at'        => date('Y-m-d h:i:s'),
            ],

        ];

        DetailUser::insert($detail_users);
    }
}
