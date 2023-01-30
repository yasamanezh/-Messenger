<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            array('name' => 'user1','role' => 'user','password' => bcrypt(123),'status' => '1','email' => 'user@user.com'),
            array('name' => 'user2','role' => 'admin','password' => bcrypt(123),'status' => '1','email' => 'admin@admin.com'),
            array('name' => 'user3','role' => 'Employee','password' => bcrypt(123),'status' => '1','email' => 'admin@user.com'),
          );
        foreach($users as $item){
            DB::table('users')->insert($item);
        }
    }
}
