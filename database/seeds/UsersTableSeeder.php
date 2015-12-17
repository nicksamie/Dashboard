<?php
 
use Illuminate\Database\Seeder;
 
class UsersTableSeeder extends Seeder {
 
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        //DB::table('users')->delete();
 
       DB::table('users')->insert(
            ['firstname' => 'sameer', 'email' => 'sameer@gmail.com', 'password' => bcrypt('secret'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['firstname' => 'abc', 'email' => 'abc@gmail.com', 'password' => bcrypt('secret'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['firstname' => 'rajan', 'email' => 'rajan@gmail.com', 'password' => bcrypt('secret'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['firstname' => 'anjan', 'email' => 'anjan@gmail.com', 'password' => bcrypt('secret'), 'created_at' => new DateTime, 'updated_at' => new DateTime]
        );
 
        // Uncomment the below to run the seeder
        //DB::table('users')->insert($users);
    }
 
}