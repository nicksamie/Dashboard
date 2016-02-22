@extends('layouts.default')

@section('title', 'Login')
@include('errors.errors')
  @if (session('flash_message'))
       <div class="alert alert-warning" id="alert-message">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4>  <i class="icon fa fa-check"></i><strong>LOGIN ERROR!!!</strong></h4>
          {{ session('flash_message') }}
      </div>
  @endif

@section('content')
	<h1>Login Form</h1>
	{!! Form::open(array('url' => 'auth/login', 'id' => 'login-form', 'class' => 'form-signin')) !!} 
		<div class="form-group">
	            {!! Form::label('email', 'Email:') !!}
	            {!! Form::text('email', null, ['class' => 'form-control']) !!}
	        </div>
		<div class="form-group">
	            {!! Form::label('password', 'Password:') !!}
	            {!! Form::password('password', ['class' => 'form-control']) !!}
	        </div>
		<p>
			<div class="form-group">
	            {!! Form::submit('Log In!', ['class' => 'btn btn-primary']) !!}
	        </div>
		</p>
	{!! Form::close() !!}

<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
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
                $("#login-form").validate({
                    rules: {
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            required: true
                        },
                    },
                    messages: {
                        password: {
                            required: "Please provide a password"
                        },
                        email: "Please enter a valid email address"
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

