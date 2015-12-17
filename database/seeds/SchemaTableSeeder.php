<?php
 
use Illuminate\Database\Seeder;
 
class SchemaTableSeeder extends Seeder {
 
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        //DB::table('schematables')->delete();
 
        DB::table('schematables')->insert(
            ['database_name' => 'dev','schema_name' => 'stage1', 'size_in_gb'=>'5','hold_status' => '1', 'hold_by' => 'manager', 'hold_till_date' => '2015-12-12'],
            ['database_name' => 'dev','schema_name' => 'accodate1', 'size_in_gb'=>'5', 'hold_status' => '1', 'hold_by' => 'manager', 'hold_till_date' => '2015-12-12'],
            ['database_name' => 'dev','schema_name' => 'stage2', 'size_in_gb'=>'5', 'hold_status' => '0', 'hold_by' => 'manager', 'hold_till_date' => '2015-12-12'],
            ['database_name' => 'dev','schema_name' => 'temp', 'size_in_gb'=>'5', 'hold_status' => '0', 'hold_by' => 'manager', 'hold_till_date' => '2015-12-12']
        );
 
        // Uncomment the below to run the seeder
        //DB::table('schematables')->insert($schematables);
    }
 
}