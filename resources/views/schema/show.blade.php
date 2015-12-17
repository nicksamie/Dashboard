@extends('layouts.master')

@section('message')
  @if (session('status'))
       <div class="alert alert-success" id="alert-message">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4>  <i class="icon fa fa-check"></i> Success</h4>
          {{ session('status') }}
      </div>
  @endif
@stop

@section('breadcrumb')
    <section class="content-header">
                  <h1>Schema tables </h1> 
                  <ol class="breadcrumb">
                    <li><a href="{{URL::to('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Tables</a></li>
                    <li class="active">Schema tables</li>
                  </ol>
    </section>
@stop 

@section('schematable')
    <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                </div><!-- /.box-header -->
                <div class="box-body">
      
      {!! Form::open(array('url' => 'schema/delete', 'method' => 'DELETE', 'id' => 'deleteSelected')) !!} 
                  <table id="schematable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th><input type="checkbox" id="cbkCheckAll"/> Select All</th>
                        <th>Database Name</th>
                        <th>Schema Name</th>
                        <th>Size in GB</th>
                        <th>Hold Yes/No?</th>
                        <th>Hold By</th>
                        <th>Hold Till Date</th>
                      </tr>
                    </thead>
                   <tbody>
                      @foreach($list as $row)
                        <tr>
                            <td><input type="checkbox" class="checkbox1" name="schemaname[]" data-id="cb" value="{{$row->schema_name}}"></td>
                            <td>{{$row->database_name}}</td>
                            <td>{{$row->schema_name}}</td>
                            <td>{{$row->size_in_gb}}</td>
                            <td>
                              @if (($row->hold_status) === 1)
                                  Yes
                              @else
                                  No
                              @endif
                            </td>
                           <td>{{$row->hold_by}}</td>
                           <td>{{$row->hold_till_date}}</td>
                           
                        </tr>
                      @endforeach
                   </tbody>
                    <!-- <tfoot>
                      <tr>
                        <th>Schema Name</th>
                        <th>Hold Yes/No?</th>
                        <th>Hold By</th>
                        <th>Hold Till Date</th>
                      </tr>
                    </tfoot> -->
                  </table>
                  <div class="form-group">
                    {!! Form::submit('Delete Selected', ['id'=>'delete_selected','class' => 'btn btn-primary']) !!}
                </div>
        {!! Form::close() !!}

                </div>
              </div>
            </div>
          </div>
        </section>
@stop   
 <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>

    <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
    <!-- page script -->
    <script>
      $(document).ready(function(){
      $("#delete_particular_row").click(function(){
        if (!confirm("Do you want to delete this particular row?")){
          return false;
        }
        });
      });

      $(document).ready(function(){
      $("#delete_selected").click(function(){
        if (!confirm("Do you want to delete all selected items?")){
          return false;
        }
        });
      });

      $(document).ready(function(){ 
      $("#cbkCheckAll").change(function(){
        $(".checkbox1").prop('checked', $(this).prop("checked"));
        });
      });

     $(".alert alert-success").alert();
        window.setTimeout(function() { $(".alert alert-success").alert('close'); }, 2000);
</script>

  
 