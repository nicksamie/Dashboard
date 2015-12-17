@extends('layouts.master')
 
@section('breadcrumb')
	<section class="content-header">
          <h1>Add New User </h1> 
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{URL::to('/user')}}">User</a></li>
            <li class="active">Add New User</li>
          </ol>
    </section>
@stop 

@section('content')
            <div class="row-fluid">
                <!-- block -->
                <div class="block">
                    <div class="navbar navbar-inner block-header">
                        <div class="muted pull-left">Add New User</div>
                        </div>
                    <div class="block-content collapse in">
                        <div class="span12">
                    <!-- BEGIN FORM-->
                    <!-- <form  id="form_add_user" action="" method="post" class="form-horizontal" > -->
                    <form name="form_add_user" action="#" method="post">

                        <fieldset>
                            <div class="alert alert-error hide">
                                <button class="close" data-dismiss="alert"></button>
                                You have some form errors. Please check below.
                            </div>
                            <div class="alert alert-success hide">
                                <button class="close" data-dismiss="alert"></button>
                                Your form validation is successful!
                            </div>
                            <div class="control-group">
                                <label class="control-label">First Name<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="firstname" data-required="1" class="span6 m-wrap"/> 
                                    <!-- <input type="text" name="firstname" class="form-control input-lg" placeholder="FirstName"> -->
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Last Name<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="lastname" data-required="1" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="email" type="text" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Password<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="password" type="password" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Department<span class="required">*</span></label>
                                <div class="controls">
                                    <select class="span6 m-wrap" name="department">
                                        <option value="">Select...</option>
                                        <option value="Department 1">Department 1</option>
                                        <option value="Department 2">Department 2</option>
                                        <option value="Department 3">Department 3</option>
                                        <option value="Department 4">Department 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Add User</button>
                                <button type="reset" class="btn">Reset</button>
                            </div>
                        </fieldset>
                    </form>
                    <!-- END FORM-->
                        </div>
                    </div>
                </div>
                        <!-- /block -->
            </div>
@endsection

