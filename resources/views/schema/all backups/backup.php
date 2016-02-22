@extends('layouts.master')
<style>
/*   table, th, td {
   border: 1px solid black;
}
#schematable.table {
  border: 1px solid black;
} */
</style>
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

@section('content')
     <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <!-- <div class="box-header">
                  <h3 class="box-title">Schema Table With Full Features</h3>
                </div> --><!-- /.box-header -->
              </div><!-- /.box-header -->
                    <div class="btn-group">
                        <a href="{{URL::to('/schema')}}"><button class="btn btn-success"><i class="glyphicon glyphicon-refresh"> Refresh</i></button></a>
                    </div>
                
                <div class="box-body">
      
      {!! Form::open(array('url' => 'schema/delete', 'method' => 'DELETE', 'id' => 'deleteSelected')) !!} 
                  <table id="schematable" class="table table-striped table-bordered" cellspacing="0" width="100%" >
                    <thead>
                      <tr>
                        <th width="5%"><input type="checkbox" id="cbkCheckAll"/> Select All</th>
                        
                        <th>Schema Name</th>
                        <th>Size in GB</th>
                        <th>Hold Yes/No?</th>
                        <th>Hold By</th>
                        <th>Hold Till Date</th>
                        <th width="5%">Database Name</th>
                      </tr>
                    </thead>
                   <tbody>
                      @foreach($list as $row)
                        <tr>
                            <td><input type="checkbox" class="checkbox1" name="schemaname[]" data-id="cb" value="{{$row->schema_name}}"></td>
                            
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
                           <td>{{$row->database_name}}</td>
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
                    {!! Form::submit('Delete Selected Schema', ['id'=>'delete_selected','class' => 'btn btn-primary']) !!}
                  </div>
        {!! Form::close() !!}

                </div>
            </div>
          </div>
        </section>

    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <script src="dist/js/demo.js" type="text/javascript"></script>
<script type="text/javascript">
      $(document).ready(function() {
          $('#schematable').DataTable();
      } );

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
  
 @stop

 /*$(".checkbox1").prop('disabled', true);*/
      /*$(document).ready(function(){
        $("#delete_selected").on("click",function(){
          if (($('.checkbox1').length)<=0) {
            alert("You must check at least 1 box");
          }
      })});
*/
      

      /*$(document).ready(function(){
      $("#delete_selected").click(function(){
        $('.checkbox1:checked').length == $('.checkbox1').length
          if (!confirm("Do you want to delete all selected items?")){
            return false;
          }
        });
      });*/

      /*$(document).ready(function(){
      $("#formdeleteSelected").click(function(){
        if (($("#checkbox1").length)<=0) {
          alert("You must check at least 1 box");
        }
        });
      });*/

      /*      $(document).ready(function(){
        var no_of_checkedbox;
        $(".checkbox1").on("click",function(){
          no_of_checkedbox = $('input[name="schemaname[]"]:checked').length;
          //alert(no_of_checkedbox);
          if(no_of_checkedbox <= 0){
            alert("You must select at least one checkbox!");
          }
          if(no_of_checkedbox == 5){
            alert('5 checkbox selected');
          }

        })
      });*/
