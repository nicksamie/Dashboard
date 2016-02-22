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
    <div class="col-md-6">
              <!-- Horizontal Form -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Add User Form</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form action="{{url('user/addnewuser')}}" method="post" id="register-form" novalidate="novalidate" class="form-horizontal">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputFirstname3" class="col-sm-2 control-label">Firstname</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="firstname" id="inputFirstname" placeholder="Firstname">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputLastname3" class="col-sm-2 control-label">Lastname</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="lastname" id="inputLastname" placeholder="Lastname">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password">
                      </div>
                    </div>

                    <div class="form-group">
                        <label for="inputRole3" class="col-sm-2 control-label">Role</label>
                        <div class="col-sm-10">
                          <select class="form-control" id="inputSelectRole">
                            <option>Admin</option>
                            <option>DBA</option>
                            <option>normal user</option>
                          </select>
                        </div>
                    </div>
 
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-info pull-right">Add User</button>
                  </div><!-- /.box-footer -->
                </form>
    </div><!-- /.box -->     

<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="plugins/jQuery/jquery.validate.min.js"></script>

<script type="text/javascript">
    (function($,W,D)
    {
        var JQUERY4U = {};
        JQUERY4U.UTIL =
        {
            setupFormValidation: function()
            {
                //form validation rules
                $("#register-form").validate({
                    rules: {
                        firstname: "required",
                        lastname: "required",
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            required: true,
                            minlength: 5
                        },
                    },
                    messages: {
                        firstname: "Please enter your firstname",
                        lastname: "Please enter your lastname",
                        password: {
                            required: "Please provide a password",
                            minlength: "Your password must be at least 5 characters long"
                        },
                        email: "Please enter a valid email address",
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                });
            }
        }

        //when the dom has loaded setup form validation rules
        $(D).ready(function($) {
            JQUERY4U.UTIL.setupFormValidation();
        });

    })(jQuery, window, document);
</script>

@stop