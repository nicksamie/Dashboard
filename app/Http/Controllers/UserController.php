<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $usersdata = DB::table('users')->select('id','firstname', 'lastname','email')->get();
        return view('users.showusers')->with('data',$usersdata);
    }

    public function addNewUser()
    {
        return view('users.addnewuser');
    }

    public function showProfile($id)
    {
        //$userinfo = User::findorfail($id);
        //$user = DB::table('users')->where('name', 'John')->first();
        $userinfo = DB::table('users')->where('id',$id)->get();
        
        return view('users.profile')->with('info',$userinfo);//->with('$id');//, ['user' => User::findOrFail($id)]);
    }

    public function saveNewUser()
    {
        $firstname = Input::get('firstname');
        $lastname = Input::get('lastname');
        $email = Input::get('email');
        $password = Input::get('password');
        $role = Input::get('role');

        if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password) )
        {
            DB::table('users')->insert([
                ['firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'password' => bcrypt('$password')]
            ]);
        } else {
            return redirect()->action('UserController@index')->with('warning', 'User creation Failed');    
        }
        return redirect()->action('UserController@index')->with('message', 'User created');
    }

    public function getEditUser($id)
    {
        $usersdata = DB::table('users')->select('id','firstname', 'lastname','email','password')->where('id',$id)->get();
        return view('users.edituser')->with('data',$usersdata);
    }

    public function postEditUser()
    {
        $firstname = Input::get('firstname');
        $lastname = Input::get('lastname');
        $email = Input::get('email');
        $password = Input::get('password');
        $role = Input::get('role');

        if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password) )
        {
            DB::table('users')
                ->where('id',$id)
                ->update([
                    ['firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'password' => bcrypt('$password')]
                    ]);
        } else {
            return redirect()->action('UserController@index')->with('warning', 'User Update Failed');    
        }
        return redirect()->action('UserController@index')->with('message', 'User Updated !!');
    }

    public function deleteParticularUserById($id){
        if(DB::table('users')->where('id',$id)->delete())
            return redirect('user')->with('message', 'User Deleted!!');
        else
            return redirect('user')->with('warning', 'User could not be Deleted!!');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function getAddEditRemoveColumn()
    {
        return view('datatables.eloquent.add-edit-remove-column');
    }

    public function getAddEditRemoveColumnData()
    {
        $users = User::select(['id', 'firstname', 'lastname', 'email',  'created_at', 'updated_at']);

        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return '<a href="#edit-'.$user->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->removeColumn('password')
            ->make(true);
    }
}
