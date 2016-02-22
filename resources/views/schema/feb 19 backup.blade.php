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

            <!-- //pop ups -->
<!-- <a id="modal_trigger" href="#modal" class="btn">Click here to Login or register</a> -->



              <div class="box">
              </div><!-- /.box-header -->
                    <div class="btn-group">
                        <a href="{{URL::to('/schema')}}"><button class="btn btn-success"><i class="glyphicon glyphicon-refresh"> Refresh</i></button></a>
                    </div>
                    <div class="btn-group"><span id="btnEdit" class="btn btn-link"><i class="glyphicon glyphicon-edit"> Edit </i></span></div>
                    <div>
                      <span id="warning-msg"></span>
                    </div>
                
                <div class="box-body">
      
      {!! Form::open(array('url' => 'schema/delete', 'method' => 'DELETE', 'id' => 'formdeleteSelected')) !!} 
                  <table id="schematable" class="table table-striped table-bordered" cellspacing="0" width="100%" >
                    <thead>
                      <tr id="schema_row">
                        <th width="3%"><input type="checkbox" id="cbkCheckAll"/> Select All</th>
                        <th>Schema Name</th>
                        <th width="5%">Size in GB</th>
                        <th width="5%">No. of Tables</th>
                        <th width="5%">Hold Yes/No?</th>
                        <th width="5%">Hold By</th>
                        <th>Hold Till Date</th>
                        <th width="5%">Database Name</th>
                        <th width="10%">--Actions--</th>
                      </tr>
                    </thead>
                   <tbody>
                      @foreach($list as $row)
                        <tr class = "schema_row">
                            <td width="3%"><input type="checkbox" id="checkbox1" class="checkbox1" name="schemaname[]" 
                                data-id="cb" value="{{$row->schema_name}}"></td>
                            <td id="row_schema_name">{{$row->schema_name}}</td>
                            <td width="5%" id="row_size_in_gb">{{$row->size_in_gb}}</td>
                            <td width="5%">--</td>
                            <td width="5%">
                                <div id="row_hold_status">
                              @if (($row->hold_status) == 1)
                                  Yes
                              @else
                                  No
                              @endif
                                </div>
                            </td>
                            <td width="5%"><div id="row_hold_by">{{$row->hold_by}}</div></td>
                            <td><div id="row_hold_date"> {{$row->hold_till_date}}</div></td>
                            <td width="5%" id="row_database_name">{{$row->database_name}}</td>
                            <td width="10%">
                            <!-- <span class = "btnRowHold">
                              <span style="color:green" class="btn btn-link" class="btn btn-link"><i class="glyphicon glyphicon-ok"> Hold </i></span>
                            </span> -->
                            <span class= "btnRowEdit"> 
                              <span id="btnRowEdit" class="btn btn-link"><a id="modal_trigger" href="#popupmodal" class="btn"><i class="glyphicon glyphicon-edit"> Edit </a></i></span>
                            </span>
                            <span class= "btnRowDelete"> 
                              <span style="color:red"; id="btnRowDelete" class="btn btn-link"><i class="glyphicon glyphicon-remove"> Delete </i></span>
                            </span>
                            <a href="{{url('schema/viewtables/'.$row->schema_name)}}">ViewTables</a>
                            <!-- <span class= "btnRowViewTables"> 
                              <span id="btnRowViewTables" class="btn btn-link"><i class="glyphicon glyphicon-edit">ViewTables</i></span>
                            </span> -->
                            </td>
                        </tr>
                      @endforeach
                          <!-- <tr class = "edit_schema_row">
                            <td width="5%">--</td>
                            <td class="edit_table_schema_name"></td>
                            <td width="5%" class="edit_sizegb"></td>
                            <td width="5%" class="edit_hold_status"></td>
                            <td class="edit_hold_by"></td>
                            <td class="edit_hold_till_date"></td>
                            <td width="5%" class="edit_db_name"></td>
                            <td class="savebtn"><span style="color:green"; id="btnEditSave" class="btn btn-link"><i class="glyphicon glyphicon-save"> Save </i></span></td>
                                                  </tr> -->
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

        <!-- <a id="modal_trigger" href="#popupmodal" class="btn">Click here </a> -->

    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <script src="dist/js/demo.js" type="text/javascript"></script>

    <script type="text/javascript" src="plugins/popupjs/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="plugins/popupjs/jquery.leanModal.min.js"></script>


<div class="container">
  <div id="popupmodal" class="popupContainer" style="display:none;">
    <header class="popupHeader">
      <span class="header_title">Edit Changes</span>
      <span class="modal_close"><i class="fa fa-times"></i></span>
    </header>

    <section class="opupBody">
      <!-- Register Form -->
      <div class="edit_schema_row">
        <form>
          <label>Schema Name</label>
          <div class="edit_table_schema_name"></div>
          <br />

          <label>Size in Gb</label>
          <div class="edit_sizegb"></div>
          <br />

          <label>Hold Yes/No</label>
          <div class="edit_hold_status"></div>
          <br />

          <label>Hold By</label>
          <div class="edit_hold_by"></div>
          <br />

          <label>Hold Till Date</label>
          <div class="edit_hold_till_date"></div>
          <br />

          <!-- <div class="savebtn"><span style="color:green"; id="btnEditSave" class="btn btn-link">
          <i class="glyphicon glyphicon-save"> Save </i></span></div> -->

          <div class="action_btns">
            <div class="one_half"><a href="#" class="btn "><i class="fa fa-angle-double-left"></i> Reset</a></div>
            <div class="one_half last" id="btnEditSave"><a href="#" class="btn btn_red">Save</a></div>
          </div>
        </form>
      </div>
    </section>
  </div>
</div>

<script type="text/javascript">
  $("#modal_trigger").leanModal({top : 200, overlay : 0.6, closeButton: ".modal_close" });
</script>   

<script type="text/javascript">
    $(document).ready(function() {
        var table = $('schematable').DataTable();
        $('#schematable tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
     
        $('#button').click( function () {
            table.row('.selected').remove().draw( false );
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
      $('#btnEdit').hide();  
      $('.boxbody2').hide(); 
      $('.edit_schema_row').hide();
      $('.btnRowHold').hide();
      $('.btnRowEdit').hide();
      $('.btnRowDelete').hide();
     

    $('.checkbox1').on('change',function() {

      var $row = $(this).closest("tr");

        if($(this).is(":checked")) {
          //alert('home is checked');
          $row.find('.btnRowHold').show();
          $row.find('.btnRowEdit').show();
          $row.find('.btnRowDelete').show();
          sch = $row.find('#row_schema_name').text();
          //alert("selected schema : "+sch);
          no_checkedbox = $('input[name="schemaname[]"]:checked').length;
          if (no_checkedbox > 1){
            $('.btnRowHold').hide();
            $('.btnRowEdit').hide();
            $('.btnRowDelete').hide();
          }
        } else if(!$(this).is(':checked')){
          //alert('UNChecked');
          $row.find('.btnRowHold').hide();
          $row.find('.btnRowEdit').hide();
          $row.find('.btnRowDelete').hide();
          //$('.edit_schema_row').hide();
        }
                selectedSchema = $row.find('#row_schema_name').text();
                var size_in_gb = $row.find("#row_size_in_gb").text();
                var hold_status = $row.find("#row_hold_status").text();
                var hold_by = $row.find("#row_hold_by").text();
                var _date = $row.find("#row_hold_date").text();
                var db_name = $row.find("#row_database_name").text();

          $(".btnRowEdit" ).click(function(event){
                $( ".edit_schema_row" ).slideDown();

                var _code_hold_status = '<select id="edit_selectBox" class="selectBox" name="new_hold_status" selected="'+hold_status+'"><option id="s_yes" value="yes" >Yes</option><option id="s_no" value="no" >No</option></select>';
                var _code_hold_by = '<input type="text" name="edit_hold_by" class="edit_input_hold_by" id="edit_input_hold_by" value ="'+hold_by+'"/>';
                var _code_hold_till_date = '<input id="input_datepicker" type="text" name="new_hold_date" class="input_datepicker" data-provide="datepicker" value="'+_date+'" placeholder="'+_date+'">';
                
                $('.edit_table_schema_name').html(selectedSchema);
                $('.edit_sizegb').html(size_in_gb);
                $('.edit_hold_status').append(_code_hold_status);
                $('.edit_hold_by').append(_code_hold_by);
                $('.edit_hold_till_date').append(_code_hold_till_date);
                $('.edit_db_name').html(db_name);

                $('.edit_hold_till_date').on('click', '.input_datepicker', function() {
                  $(".input_datepicker").datepicker("setDate", new Date());
                  $('.input_datepicker').datepicker({
                        dateFormat: 'yy-mm-dd'
                  });
                  $('.input_datepicker').on('changeDate', function(ev){
                      //$(this).datepicker('hide');
                  });
                });
          });

          $("#btnEditSave").click(function(){
                //alert("You are about to make changes!!");

                var _selectedSchema = selectedSchema;
                var _hold_status = $("#edit_selectBox").val();
                var _hold_by = $("#edit_input_hold_by").val();
                var _date = $("#input_datepicker").val();

                /*alert("Schema Name "+_selectedSchema);
                alert('hold_status : '+_hold_status);
                alert('hold by '+_hold_by);
                alert('date : '+_date);*/

                alert('Schema Name : '+_selectedSchema+
                      'hold_status : '+_hold_status+
                      'hold by : '+_hold_by+
                      'date : '+_date);

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
                           //$('#notification-bar').text('An error occurred');
                        }
                    });
                } else {
                    return false;
                }
          });

          $(".btnRowDelete").click(function(){
                //alert("delete button selected : "+selectedSchema + '- hold by : '+hold_by);
                if (confirm("Are you sure you want to delete " + selectedSchema + "???")){
                    $.ajax({
                        type: "GET",
                        url: "{{URL::to('/schema/deletesinglerow') }}",
                        data: {
                          selectedSchema: selectedSchema
                        },
                        success: function ( data ) {
                            alert('Successfully Deleted Schema !! :(');
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

          $(".btnRowViewTables").click(function(){
            //view tables
            //href="user/delete/user->id
            alert("view table clicked");
            alert("Selected Schema Name "+selectedSchema);
                $.ajax({
                        type: "GET",
                        url: "{{URL::to('/schema/viewtables') }}",
                        data: {
                          selectedSchema: selectedSchema
                        },
                        success: function ( data ) {
                            alert('Successfully View table !! :(');
                              setTimeout(function() {
                              window.location.href = "{{URL::to('/schema/viewtables') }}";
                            }, 100);
                        },
                        error: function() {
                          alert('ERROR!! Could not be Viewed');
                           //$('#notification-bar').text('An error occurred');
                        }
                    });
             /* }
            } else {
              return false;
            }*/
          });



    });

});

</script>
@stop