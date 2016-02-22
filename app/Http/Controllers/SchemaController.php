<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use DB;
use View;
use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SchemaController extends Controller
{
    public function index()
    {
        $schemalist = DB::table('schematables')
        ->select('database_name', 'schema_name','size_in_gb','hold_status', 'hold_by','hold_till_date')->get();

        $schemaOnly = DB::table('schematables')
        ->select('schema_name')->get();

        return view('schema.schema')->with(['list' => $schemalist,'db_list' => $schemaOnly]);

        //return view('schema.schema')->with('list',$schemalist);
        //with(['name' => $name, 'age' => $age]);
    }

    public function dropAllTablesFromSchema($toBedroppedSchemaName)
    {
        $table_names = DB::table('toBedroppedSchemaName')
                        ->select ('tablename')->get();
        foreach ($table_names as $tbname) {
            DB::table('$tbname')->delete();
        }
    }

    public function deleteSelectedRows() //bulk delete
    {
        $schema_data = Input::get('schemaname');
        if($schema_data == NUll){
            return redirect()->action('SchemaController@index')->with('Warning','NO ROW SELECTED, ZERO ROWS DELETED !! ');
        } else {
            $count = 0;
            foreach($schema_data as $data){
                ++$count;
                //$schname = Input::get('row');
                //dropAllTablesFromSchema($data);
                //if(count of tables in particular schema == 0 ) then
                DB::table('schematables')->where('schema_name', $data)->delete(); //Delete the schema
            }
            return redirect()->action('SchemaController@index')->with('status','SUCCESSFULLY DELETED! '.$count.' SCHEMA(S)');
        }
    }

    public function deleteSingleSelectedRow() //delete from single row
    {
        $selectedSchema = Input::get('selectedSchema');
        //$schema_data = Input::get('schemaname');
            DB::table('schematables')->where('schema_name', $selectedSchema)->delete(); //Delete the schema
            return redirect()->action('SchemaController@index')->with('status','SUCCESSFULLY DELETED! ');
    }
   
   public function updateChangesSchema()
   {
        $hold_status = Input::get('hold_status');
        if($hold_status == 'yes')
            $hs = 1;
        elseif ($hold_status == 'no') 
            $hs = 0;
        $hold_by = Input::get('hold_by');
        $date = Input::get('date');
        $selectedSchema = Input::get('selectedSchema');

            DB::table('schematables')
            ->where('schema_name', $selectedSchema)
            ->update(['hold_status' => $hs,
                'hold_by' => $hold_by,
                'hold_till_date' => $date
                ]);
        
        return redirect('schema');
        //return redirect()->route('schema');
   }
}

/* public function updateSchemaTable($schema_name_as_id)
    {
        $updatedSchemaNameValue = $schema_name_as_id;
        $updatedHoldStatusValue = Input::get('new_hold_status');
        $updatedHoldByValue     = Input::get('new_hold_by');
        $updatedHoldTillDateValue = Input::get('new_hold_date');

            DB::table('schematables')
            ->where('schema_name', $schema_name_as_id)
            ->update(['hold_status' => $updatedHoldStatusValue,
                'hold_by' => $updatedHoldByValue,
                'hold_till_date' => $updatedHoldTillDateValue
                ]);
    }

    public function destroy( $schemaname, Request $request ) {
       // $schema = Schema::findOrFail( $schemaname );

        if ( $request->ajax() ) {
            $schema->delete( $request->all() );

            return response(['msg' => 'Schema deleted', 'status' => 'success']);
        }
        return response(['msg' => 'Failed deleting the Schema', 'status' => 'failed']);
    }

   public function deleteParticularRow()
   {
        $schemaname = Input::get('schemaname');
        
        DB::table('schematables')->where('schema_name', $schemaname)->delete();
        return redirect()->action('SchemaController@index')->with('status','Particular Row Sucessfully Deleted!');
   }

*/