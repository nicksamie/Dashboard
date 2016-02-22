@extends('layouts.master')

@section('title')
  Schema Tables
@stop
@section('message')
  @if (session('status'))
       <div class="alert alert-success" id="alert-message">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4>  <i class="icon fa fa-check"></i> Success</h4>
          {{ session('status') }}
      </div>
  @endif
  @if (session('Warning'))
       <div class="alert alert-warning" id="alert-message">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4>  <i class="icon fa fa-check"></i><strong>Warning!</strong></h4>
          {{ session('Warning') }}
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

                    <div class="btn-group">
                        <button id="btn_edit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"> Edit </i></button>
                        <button id="btn_save_changes" class="btn btn-alert"><i class="glyphicon glyphicon-save"> Save </i></button>
                    </div>
<!-- <div class="input-group date" data-provide="datepicker">
                        <input type="text" class="form-control">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div> -->
                    
                     <!-- <input class="datepicker" data-date-format="mm/dd/yyyy"> -->
                
                <div class="box-body">
      
      {!! Form::open(array('url' => 'schema/delete', 'method' => 'DELETE', 'id' => 'formdeleteSelected')) !!} 
                  <table id="schematable" class="table table-striped table-bordered" cellspacing="0" width="100%" >
                    <thead>
                      <tr>
                        <th width="5%"><input type="checkbox" id="cbkCheckAll"/> Select All</th>
                        
                        <th>Schema Name</th>
                        <th>Size in GB</th>
                        <th>Hold Yes/No?</th>
                        <th width="5%">Hold By</th>
                        <th>Hold Till Date</th>
                        <th width="5%">Database Name</th>
                        <th>--</th>
                      </tr>
                    </thead>
                   <tbody>
                      @foreach($list as $row)
                        <tr>
                            <td><input type="checkbox" id="checkbox1" class="checkbox1" name="schemaname[]" data-id="cb" value="{{$row->schema_name}}"></td>
                            
                            <td>{{$row->schema_name}}</td>
                            <td>{{$row->size_in_gb}}</td>
                            <td>
                                <div class="row_hold_status">
                              @if (($row->hold_status) == 1)
                                  Yes
                              @else
                                  No
                              @endif
                                </div>
                                  <select id="selectBox" class="selectBox" name="new_hold_status" selected="{{$row->hold_status}}"> 
                                              <option id="s_yes" value="yes" >Yes</option>
                                              <option id="s_no" value="no" >No</option>
                                  </select>
                            </td>
                            <td>
                              <div class="row_hold_by">{{$row->hold_by}}</div>
                              <input type="text" name="new_hold_by" class="input_hold_by" placeholder ="{{$row->hold_by}}"/>
                            </td>
                            <td>
                              <div class="row_hold_date"> {{$row->hold_till_date}}</div>
                               <input id="datepicker" type="text" name="new_hold_date" class="datepicker" data-provide="datepicker" placeholder="{{$row->hold_till_date}}" >
                              
                            </td>
                            <td>{{$row->database_name}}</td>
                            <td>
                              <!-- <span id="{{$row->schema_name}}" class="delete"><i class="glyphicon glyphicon-edit"></i> Edit</span> #edit-{{$row->schema_name}}-->
                              <span id="row_edit"> <i class="glyphicon glyphicon-edit"></i> Edit </span>
                              <!-- <a href="#edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> |
                              <a href="#delete-'.'$user->id'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i> Delete</a> -->
                            </td>
                        </tr>
                      @endforeach
                   </tbody>
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

      //$( "#checkbox1" ).hide();
      /*if ("#hold_status" == yes){
       $(".checkbox1").prop('disabled', true);
      }*/

      $(document).ready(function(){ 
        $("#cbkCheckAll").change(function(){
          $(".checkbox1").prop('checked', $(this).prop("checked"));
          });
      });

      $(document).ready(function(){
        var no_of_checkedbox;
        $(".checkbox1").on("click",function(){
          no_of_checkedbox = $('input[name="schemaname[]"]:checked').length;
        })
      });

        $("#delete_selected").on("click",function(){
          //var no_of_checkedbox;
          /*$(".checkbox1").on("click",function(){
            no_of_checkedbox = $('input[name="schemaname[]"]:checked').length;
          })*/

          no_of_checkedbox = $('input[name="schemaname[]"]:checked').length;
          if ($('input[name="schemaname[]"]:checked').length <= 0){
            alert("You must check at least 1 box!!!!!");
            return false; 
          } else {
            //alert("You want to delete "+no_of_checkedbox+" items");
            if (!confirm("Are you sure you want to delete these " + no_of_checkedbox + " selected items ?")){
            return false;
            }
          }
        });
</script>

<script>
      $(document).ready(function() {
          $("#btn_edit").show();
          $("#btn_save_changes").hide();
          $(".input_hold_by").hide();
          $(".input_date").hide();
          $(".datepicker").hide();
          $(".selectBox").hide();
          //$(".row_hold_status").hide();

        $("#btn_edit").click(function(){
            $("#btn_edit").hide();
            $("#btn_save_changes").show();
            $(".input_hold_by").show();
            $(".input_date").show();
            $('.row_hold_by').hide();
            $('.row_hold_date').hide();
            $('.datepicker').datepicker()
            $(".datepicker").show();
            $(".selectBox").show();
            $(".row_hold_status").hide();
            //$(".datepicker").toggle();
        });

        $("#btn_save_changes").click(function(){
            $("#btn_edit").show();
            $("#btn_save_changes").hide();
            $(".input_hold_by").hide();
            $(".input_date").hide();
            $('.row_hold_by').show();
            $('.row_hold_date').show();
            $(".datepicker").hide();
            $(".selectBox").hide();
            $(".row_hold_status").show();
        });
      });

      $(document).ready(function () {
           $('#datepicker').datepicker({
                format: "dd/mm/yyyy"
            });  
      });
</script>

<script>
      $("#row_edit").click(function(){
            $("#input_hold_by").show();
            $("#input_date").show();
            $('#row_hold_by').hide();
            $('#row_hold_date').hide();
            $('#datepicker').datepicker()
            $("#datepicker").show();
            $("#selectBox").show();
            $("#row_hold_status").hide();
            //$(".datepicker").toggle();
        });

  $(document).on('click', '#schematable tr .delete', function() {
    //$(this).closest('tr').hide()
     rn = this.rowIndex;
      alert('You clicked row: '+rn);
  });

  function DoAction(schemaname)
  {
     rn = schemaname;
    alert( "Schema name: " + rn );
     
  }
</script>

<!-- 
To get values from textbox
$("#btn1").click(function(){
    alert("Value: " + $("#test").val());
}); -->
  
 @stop