@section('')
    {!! Form::open(array('url' => 'user/addnew', 'class' => 'form-signin')) !!} 
        <div class="form-group">
                {!! Form::label('firstname', 'FirstName:') !!}
                {!! Form::text('firstname', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
                {!! Form::label('lastname', 'LastName:') !!}
                {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
                {!! Form::label('email', 'Email:') !!}
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
                {!! Form::label('password', 'Password:') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
                {!! Form::submit('Add User', ['class' => 'btn btn-primary']) !!}
        </div>
        </p>
    {!! Form::close() !!}
@stop

@section('')
   
                    <!-- BEGIN FORM-->
                    <form action="{{url('user/addnewuser')}}" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

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
                            
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Add User</button>
                                <button type="reset" class="btn">Reset</button>
                            </div>
                    </form>                 