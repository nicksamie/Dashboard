@extends('layouts.default')

@section('title', 'Login')
@include('errors.errors')
@section('content')
	<h1>Login Form</h1>
	{!! Form::open(array('url' => 'auth/login', 'class' => 'form-signin')) !!} 
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

@stop

<script>
$(document).ready(function(){
    $("input").focus(function(){
        $(this).css("background-color", "#cccccc");
    });
    $("input").blur(function(){
        $(this).css("background-color", "#ffffff");
    });
});
</script>