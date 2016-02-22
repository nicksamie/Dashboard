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
                    <li><a href="{{URL::to('/schema')}}">Tables</a></li>
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
              </div><!-- /.box-header -->
                    <div class="btn-group">
                        <a href="{{URL::to('/schema')}}"><button class="btn btn-success"><i class="glyphicon glyphicon-refresh"> Refresh</i></button></a>
                    </div>
                      <span id="warning-msg"></span>
                    </div>
                <div class="box-body">
      
      {!! Form::open(array('url' => 'schema/delete', 'method' => 'DELETE', 'id' => 'formdeleteSelected')) !!} 
                  <table id="schematable" class="table table-striped table-bordered" cellspacing="0" width="100%" >
                    <thead>
                      <tr id="schema_row">
                        <th width="3%"><input type="checkbox" id="cbkCheckAll"/> Select All</th>
                        <th width="5%">Schema Name</th>
                        <th width="5%">Size in GB</th>
                        <th width="5%">No. of Tables</th>
                        <th width="5%">Hold Yes/No?</th>
                        <th width="5%">Hold By</th>
                        <th width="5%">Hold Till Date</th>
                        <th width="3%">Database Name</th>
                        <th width="15%">--Actions--</th>
                      </tr>
                    </thead>
                   <tbody>
                      @foreach($list as $row)
                        <tr class = "schema_row">
                            <td width="3%">
                              <input type="checkbox" id="checkbox1" class="checkbox1" name="schemaname[]" data-id="cb" value="{{$row->schema_name}}">
                            </td>
                            <td width="5%" id="row_schema_name">{{$row->schema_name}}</td>
                            <td width="5%" id="row_size_in_gb">{{$row->size_in_gb}}</td>
                            <td width="5%">--</td>
                            <td width="5%">
                                <div class="row_hold_status" id="row_hold_status">
                                  @if (($row->hold_status) == 1)
                                      Yes
                                  @else
                                      No
                                  @endif
                                </div>
                                <div class="edit_hold_status">
                                  <select id="edit_selectBox" class="selectBox" name="new_hold_status" selected="">
                                    <option id="s_yes" value="yes" >Yes</option>
                                    <option id="s_no" value="no" >No</option>
                                  </select>
                                </div>
                            </td>
                            <td width="5%">
                              <div class="row_hold_by">{{$row->hold_by}}</div>
                              <input type="text" name="new_hold_by" id="input_hold_by" class="input_hold_by" placeholder ="{{$row->hold_by}}" value="{{$row->hold_by}}" />
                            </td>
                            <td width="5%">
                              <div class="row_hold_date"> {{$row->hold_till_date}}</div>
                              <input id="datepicker" type="text" name="new_hold_date" class="datepicker" data-provide="datepicker" placeholder="{{$row->hold_till_date}}" value="{{$row->hold_till_date}}">
                            </td>
                            <td width="3%" id="row_database_name">{{$row->database_name}}</td>
                            <td width="15%">
                              <a href="{{$row->schema_name}}" class="btnRowEdit" ><span class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit </span></a>
                              <a href="{{$row->schema_name}}" class="btnRowDelete" ><span class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove" style="color:red";></i> Delete </span></a> 
                              <a href="{{url('schema/viewtables/'.$row->schema_name)}}" class="btnRowViewTables"><span class="btn btn-xs btn-primary">View Tables</span></a>

                              <a href="{{$row->schema_name}}" class="btnEditSave"> <span style="font-color:green"; class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-save"> Save </i></span></a>
                              <a href="" class="btnEditCancel"><span class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-ban-circle"> Cancel </i></span></a>
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
    </section>

    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="plugins/popupjs/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="plugins/popupjs/jquery.leanModal.min.js"></script>

<script type="text/javascript">
      $(document).ready(function() {
          var table = $('#schematable').DataTable();
          $('#schematable tbody').on( 'click', 'tr', function () {
              if ( $(this).hasClass('selected') ) {
                  $(this).removeClass('selected');
              }
              else {
                  table.$('tr.selected').removeClass('selected');
                  $(this).addClass('selected');
              }
          } );
      });

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
          no_of_checkedbox = $('input[name="schemaname[]"]:checked').length;
          if ($('input[name="schemaname[]"]:checked').length <= 0){
            alert("You must check at least 1 box!!!!!");
            return false; 
          } else {
            var $row = $(this).closest(".checkbox1 tr");
            if (!confirm("Are you sure you want to delete these " + no_of_checkedbox + " selected items ?")){
            return false;
            }
          }
        });
</script>

<script>
  $(document).ready(function() {
    $('.row_hold_by').show();
    $('.row_hold_date').show();

    $('.edit_hold_status').hide();
    $('.input_hold_by').hide();
    $('.datepicker').hide();

    $('.btnEditSave').hide();
    $('.btnEditCancel').hide();
 
    $('.datepicker').datepicker({
          format: "yyyy/mm/dd"
    });  
    $(".datepicker").datepicker("setDate", new Date());
    $('.datepicker').on('changeDate', function(ev){
          $(this).datepicker('hide');
    });

    $(".btnRowEdit").click(function(event) {
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

    $('.btnRowDelete').click(function (event){ 
        event.preventDefault(); 
        var schemaname = $(this).attr('href');
                if (confirm("Are you sure you want to delete schema : " + schemaname + " ???")){
                    $.ajax({
                        type: "GET",
                        url: "{{URL::to('/schema/deletesinglerow') }}",
                        data: {
                          selectedSchema: schemaname
                        },
                        beforeSend: function() {
                          $('#response').html("<img src='/images/opc-ajax-loading-black.gif' />");
                        },
                        success: function ( data ) {
                            alert('Successfully Deleted Schema : ' + schemaname + ' !!! :(');
                              setTimeout(function() {
                              window.location.href = "{{URL::to('/schema') }}";
                            }, 100);
                        },
                        error: function() {
                          alert('ERROR!! Could not be Deleted');
                        }
                    });
                } else {
                    return false;
                }
    });

    $(".btnEditSave").click(function(event){
        event.preventDefault(); 
        var schemaname = $(this).attr('href');
                alert("You are about to make changes!!");

                var $row = $(this).closest("tr");

                var _selectedSchema = schemaname;
                var _hold_status = $row.find("#edit_selectBox").val();
                var _hold_by = $row.find("#input_hold_by").val();
                var _date = $row.find("#datepicker").val();

                alert("Schema Name "+_selectedSchema);
                alert('hold_status : '+_hold_status);
                alert('hold by '+_hold_by);
                alert('date : '+_date);

                if(confirm("Are you sure you want to Edit & Save?")){
                    $.ajax({
                        type: "GET",
                       // url: "/laravel/dashboard/public/schema/update",
                        url: "{{URL::to('/schema/update') }}",
                        data: {
                          selectedSchema: _selectedSchema, hold_status: _hold_status, hold_by: _hold_by, date: _date
                        },
                        beforeSend: function() {
                          $('#response').html("<img src='/images/opc-ajax-loading-black.gif' />");
                        },
                        success: function ( data ) {
                            alert('Successfully Updated table !! :(');
                              setTimeout(function() {
                              window.location.href = "{{URL::to('/schema') }}";
                            }, 100);
                        },
                        error: function() {
                          alert('ERROR!! Could not be Updated');
                        }
                    });
                } else {
                    return false;
                }
    });

    $(".btnEditCancel").click(function(event){
          $('.row_hold_status').show();
          $('.row_hold_by').show();
          $('.row_hold_date').show();

          $('.edit_hold_status').hide();
          $('.input_hold_by').hide();
          $('.datepicker').hide();

          $('.btnRowEdit').show();
          $('.btnRowDelete').show();
          $('.btnRowViewTables').show();

          $('.btnEditSave').hide();
          $('.btnEditCancel').hide();
    });
  });
</script>

@stop