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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schemalist = DB::table('schematables')->select('database_name', 'schema_name','size_in_gb','hold_status', 'hold_by','hold_till_date')->get();
        return view('schema.schema')->with('list',$schemalist);
    }

   public function deleteParticularRow()
   {
        $schemaname = Input::get('schemaname');
        DB::table('schematables')->where('schema_name', $schemaname)->delete();
        return redirect()->action('SchemaController@index')->with('status','Particular Row Sucessfully Deleted!');
   }

   public function deleteSelectedRows()
   {
        $schema_data = Input::get('schemaname');
        //return $schema_data;
        $count = 0;
        foreach($schema_data as $data){
            ++$count;
            //echo $data;
          //  $schname = Input::get('row');
            DB::table('schematables')->where('schema_name', $data)->delete();
        }
        return redirect()->action('SchemaController@index')->with('status','Sucessfully Deleted! '.$count.' items');
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('schema.create', compact('schema'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show1(Schema $schema)
    {
        //return view('schema.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Schema $schema)
    {
        //return view('schema.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schema $schema)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy( $schemaname, Request $request ) {
       // $schema = Schema::findOrFail( $schemaname );

        if ( $request->ajax() ) {
            $schema->delete( $request->all() );

            return response(['msg' => 'Schema deleted', 'status' => 'success']);
        }
        return response(['msg' => 'Failed deleting the Schema', 'status' => 'failed']);
    }
}
