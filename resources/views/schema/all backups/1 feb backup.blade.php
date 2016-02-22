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
              <!-- Create a Combo Box -->
              Select Database
                <select id="db_list_select" class="db_combo" selected="">
                  @foreach($db_list as $row)
                    <option id="{{$row->schema_name}}" value="{{$row->schema_name}}" >{{$row->schema_name}}</option>
                  @endforeach
                </select>
              <button id="selectdb">Submit</button>

              </div><!-- /.box-header -->
              <button id="button">Delete selected row</button>
                    <div class="btn-group">
                        <a href="{{URL::to('/schema')}}"><button class="btn btn-success"><i class="glyphicon glyphicon-refresh"> Refresh</i></button></a>
                    </div>
                    <div class="btn-group"><span id="btnEdit" class="btn btn-link"><i class="glyphicon glyphicon-edit"> Edit </i></span></div>
                    <div>
                      <span id="warning-msg"></span>
                    </div>
                
                <div class="box-body">
      
      {!! Form::open(array('url' => 'schema/delete', 'method' => 'DELETE', 'id' => 'formdeleteSelected')) !!} 
                  <!-- <table id="schematable" class="table table-striped table-bordered" cellspacing="0" width="100%" > -->
                  <table id="schematable" class="display" cellspacing="0" width="100%">
                    <thead>
                      <tr id="schema_row">
                        <th width="5%"><input type="checkbox" id="cbkCheckAll"/> Select All</th>
                        <th>Schema Name</th>
                        <th width="5%">Size in GB</th>
                        <th width="5%">Hold Yes/No?</th>
                        <th>Hold By</th>
                        <th>Hold Till Date</th>
                        <th width="5%">Database Name</th>
                        <th>--Actions--</th>
                      </tr>
                    </thead>
                   <tbody>
                      @foreach($list as $row)
                        <tr class = "schema_row">
                            <td width="5%"><input type="checkbox" id="checkbox1" class="checkbox1" name="schemaname[]" 
                                data-id="cb" value="{{$row->schema_name}}"></td>
                            <td id="row_schema_name">{{$row->schema_name}}</td>
                            <td width="5%" id="row_size_in_gb">{{$row->size_in_gb}}</td>
                            <td width="5%">
                                <div id="row_hold_status">
                              @if (($row->hold_status) == 1)
                                  Yes
                              @else
                                  No
                              @endif
                                </div>
                            </td>
                            <td><div id="row_hold_by">{{$row->hold_by}}</div></td>
                            <td><div id="row_hold_date"> {{$row->hold_till_date}}</div></td>
                            <td width="5%" id="row_database_name">{{$row->database_name}}</td>
                            <td>
                            <span class = "btnRowHold">
                              <span style="color:green" class="btn btn-link" class="btn btn-link"><i class="glyphicon glyphicon-ok"> Hold </i></span>
                            </span>
                            <span class= "btnRowEdit"> 
                              <span id="btnRowEdit" class="btn btn-link"><i class="glyphicon glyphicon-edit"> Edit </i></span>
                            </span>
                              <span class= "btnRowDelete"> 
                                <span style="color:red"; id="btnRowDelete" class="btn btn-link"><i class="glyphicon glyphicon-remove"> Delete </i></span>
                              </span>
                            </td>
                        </tr>
                      @endforeach
                          <tr class = "edit_schema_row">
                            <td width="5%">--</td>
                            <td class="edit_table_schema_name"></td>
                            <td width="5%" class="edit_sizegb"></td>
                            <td width="5%" class="edit_hold_status"></td>
                            <td class="edit_hold_by"></td>
                            <td class="edit_hold_till_date"></td>
                            <td width="5%" class="edit_db_name"></td>
                            <td class="savebtn"><span style="color:green"; id="btnEditSave" class="btn btn-link"><i class="glyphicon glyphicon-save"> Save </i></span></td>
                        </tr>
                   </tbody>
                  </table>
                  <div class="form-group">
                    {!! Form::submit('Delete Selected Schema', ['id'=>'delete_selected','class' => 'btn btn-primary']) !!}
                  </div>
      {!! Form::close() !!}

                </div>
            </div>
          </div>

          <!--Newly Added box to edit-->
          <!-- <div class="boxbody2">
            <table class="editable_table" class="table table-striped table-bordered" cellspacing="0" width="100%" >
                    <thead>
                     <tr id="schema_row">
                        <th>Schema Name</th>
                        <th>Size in GB</th>
                        <th width="5%">Hold Yes/No?</th>
                        <th>Hold By</th>
                        <th>Hold Till Date</th>
                        <th width="5%">Database Name</th>
                        <th>--Actions--</th>
                     </tr>
                                       </thead>
          
                        <tr class = "edit_schema_row">
                            <td width="5%">--</td>
                            <td class="edit_table_schema_name"></td>
                            <td width="5%" class="edit_sizegb"></td>
                            <td width="5%" class="edit_hold_status"></td>
                            <td class="edit_hold_by"></td>
                            <td class="edit_hold_till_date"></td>
                            <td width="5%" class="edit_db_name"></td>
                            <td class="savebtn"><span style="color:green"; id="btnEditSave" class="btn btn-link"><i class="glyphicon glyphicon-save"> Save </i></span></td>
                        </tr>
            </table>
            
          </div> -->
        </section>

    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <script src="dist/js/demo.js" type="text/javascript"></script>
    

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
     
        $('#button').click( function () {
            table.row('.selected').remove().draw( false );
        } );
    } );

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
            //var $row = $(this).closest(".checkbox1 tr");
            //var status = $row.find("#row_hold_status").text();
            //alert("deleted item has hold_status : "+status);
            if (!confirm("Are you sure you want to delete these " + no_of_checkedbox + " selected items ?")){
            return false;
            }
          }
        });

        $('#selectdb').click(function(){
          var db_select = $('#db_list_select').val();
          alert('Db Selected : '+db_select);
        })
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
          //sch = $row.find('#row_schema_name').text();
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

        //var $row = $(this).closest("tr");
                /*alert("selected schema : "+selectedSchema);
                alert("hold status : "+hold_status);
                alert("hold by : "+hold_by);
                alert("date : "+_date);*/
                selectedSchema = $row.find('#row_schema_name').text();
                var size_in_gb = $row.find("#row_size_in_gb").text();
                var hold_status = $row.find("#row_hold_status").text();
                var hold_by = $row.find("#row_hold_by").text();
                var _date = $row.find("#row_hold_date").text();
                var db_name = $row.find("#row_database_name").text();      

          $(".btnRowEdit" ).click(function(event){
            $row.find('.btnRowHold').hide();
          $row.find('.btnRowEdit').hide();
          $row.find('.btnRowDelete').hide();
            alert('Edit button Clicked');
                /*alert("selected schema : "+selectedSchema);
                alert("hold status : "+hold_status);
                alert("hold by : "+hold_by);
                alert("date : "+_date);*/

                //$('table tr').first().closest("tr").slideDown();
                    //$('.edit_schema_row').show();
                    $( ".edit_schema_row" ).slideDown();

                //$('.edit_schema_row').show();

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
                       // $(this).datepicker('hide');
                  });
                });
          });

          $("#btnEditSave").click(function(){
                alert("You are about to make changes!!");

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
            alert('Delete button Clicked');
                alert("delete button selected : "+selectedSchema + '- hold by : '+hold_by);
                /*if (confirm("Are you sure you want to delete " + selectedSchema + "???")){
                    $.ajax({
                        type: "GET",
                       // url: "/laravel/dashboard/public/schema/update",
                        url: "{{URL::to('/schema/deleteRow') }}",
                        data: {
                          schemaname: selectedSchema
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
                }*/
                
          });

          $(".btnRowHold").click(function(){
            if (confirm("Are you sure you want to Hold " + selectedSchema + "???")){
                //var hold_status = $row.find("#row_hold_status").text();
                alert("hold status : "+hold_status);
                if(hold_status === "Yes"){
                  
                  alert("It's already on HOLD!");
                  return false;
                } else {
                  alert("Holding Now!!");

                $.ajax({
                        type: "GET",
                       // url: "/laravel/dashboard/public/schema/update",
                        //url: "{{URL::to('/schema/update') }}",
                        data: {
                          selectedSchema: _selectedSchema, hold_status: _hold_status, hold_by: _hold_by, date: _date
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
              }
            } else {
              return false;
            }
          });
    });

});

</script>
 @stop