@extends('layouts.master')
 
@section('breadcrumb')
	<section class="content-header">
          <h1>Users tables </h1> 
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{URL::to('/user')}}">User</a></li>
            <li class="active">User tables</li>
          </ol>
    </section>
@stop 

@section('message')
  @if (session('message'))
         <div class="alert alert-success" id="alert-message">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>  <i class="icon fa fa-check"></i> Success</h4>
            {{ session('message') }}
        </div>
  @endif
  @if (session('warning'))
       <div class="alert alert-warning" id="alert-message">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4>  <i class="icon fa fa-check"></i><strong>Warning!</strong></h4>
          {{ session('warning') }}
      </div>
  @endif
@stop  

@section('content')
    <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <div class="btn-group">
                      <a href="{{URL::to('add-new-user')}}"><button class="btn btn-success">Add New User </button></a>
                                      </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="usertable" class="table table-striped table-bordered" cellspacing="0" width="100%" >
                    <thead>
                      <tr>
                        <th>User Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                   <tbody>
                      @foreach($data as $user)
                      <tr>
                          <td>{{$user->id}}</td>
                          <td>{{$user->firstname}}</td>
                          <td>{{$user->lastname}}</td>
                          <td>{{$user->email}}</td>
                          <td>
                            <a href="{{url('user/profile/' . $user->id)}}">View Profile</a> | 
                            <a href="{{$user->id}}" class="btnEditUser"><span class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</span></a> |
                            <a href="user/delete/{{$user->id}}" id="deleteUser" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove" style="color:red";></i> Delete</a>
                          </td>
                      </tr>
                      @endforeach
                   </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
    </section><!-- /.content -->


    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
          var table = $('#usertable').DataTable();
          $('#usertable tbody').on( 'click', 'tr', function () {
              if ( $(this).hasClass('selected') ) {
                  $(this).removeClass('selected');
              }
              else {
                  table.$('tr.selected').removeClass('selected');
                  $(this).addClass('selected');
              }
          } );

      $(".btnEditUser").click(function(event) {
        var href = $(this).attr('href');
        //alert(href);
        event.preventDefault();

        var $row = $(this).closest("tr");
        alert("Edit ?? " + href);

        $row.find('.btnRowEdit').hide();
        $row.find('.btnRowDelete').hide();
        $row.find('.btnRowViewTables').hide();

        $row.find('.btnEditSave').show();
        $row.find('.btnEditCancel').show();

        $row.find('.row_hold_status').hide();
        $row.find('.row_hold_by').hide();
        $row.find('.row_hold_date').hide();

        $row.find('.edit_hold_status').show();

        $row.find('.input_hold_by').show();
        $row.find('.datepicker').show();
    });

    });
</script>
@stop