@extends('layouts.master')
 
@section('breadcrumb')
	<section class="content-header">
          <h1>Users tables </h1> 
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">User tables</li>
          </ol>
    </section>
@stop 

@section('content')
     <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <div class="btn-group">
                      <a href="{{URL::to('/add')}}"><button class="btn btn-success">Add New User </button></a>
                                      </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="schematable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>User Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                      </tr>
                    </thead>
                   <tbody>
                      @foreach($data as $row)
                      <tr>
                         <td>{{$row->id}}</td>
                         <td>{{$row->firstname}}</td>
                         <td>{{$row->lastname}}</td>
                         <td>{{$row->email}}</td>
                          <td><a href="#">View Profile</a> | 
                          <a href="#edit-'.$user->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> |
                          <a href="#delete-'.'$user->id'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i> Delete</a></td>
                          
                      </tr>
                      @endforeach
                   </tbody>
                    <tfoot>
                      <tr>
                        <th>User Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
@endsection

<script type="text/javascript">
$('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'http://datatables.yajrabox.com/eloquent/add-edit-remove-column-data',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
</script>