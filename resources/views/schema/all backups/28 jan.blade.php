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
                    <div class="btn-group"><span id="btnEdit" class="btn btn-link"><i class="glyphicon glyphicon-edit"> Edit </i></span></div>
                    <div>
                      <span id="warning-msg"></span>
                    </div>
                
                <div class="box-body">
      
      {!! Form::open(array('url' => 'schema/delete', 'method' => 'DELETE', 'id' => 'formdeleteSelected')) !!} 
                  <table id="schematable" class="table table-striped table-bordered" cellspacing="0" width="100%" >
                    <thead>
                      <tr id="schema_row">
                        <th width="5%"><input type="checkbox" id="cbkCheckAll"/> Select All</th>
                        
                        <th>Schema Name</th>
                        <th>Size in GB</th>
                        <th width="5%">Hold Yes/No?</th>
                        <th>Hold By</th>
                        <th>Hold Till Date</th>
                        <th width="5%">Database Name</th>
                        <th>--</th>
                      </tr>
                    </thead>
                   <tbody>
                      @foreach($list as $row)
                        <tr class = "schema_row">
                            <td><input type="checkbox" id="checkbox1" class="checkbox1" name="schemaname[]" 
                                data-id="cb" value="{{$row->schema_name}}"></td>
                            <td id="row_schema_name">{{$row->schema_name}}</td>
                            <td>{{$row->size_in_gb}}</td>
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
                            <td width="5%">{{$row->database_name}}</td>
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
          <div class="boxbody2">
            <table class="editable_table" class="table table-striped table-bordered" cellspacing="0" width="100%" >
                    <thead>
                      <tr id="schema_row">
                        <th>Schema Name</th>
                        <th>Hold Yes/No?</th>
                        <th>Hold By</th>
                        <th>Hold Till Date</th>
                      </tr>
                    </thead>
              <tbody>
                        <tr class = "edit_schema_row">
                            <td class="edit_table_schema_name"></td>
                            <td class="edit_hold_status"></td>
                            <td class="edit_hold_by"></td>
                            <td class="edit_hold_till_date"></td>
                        </tr>
              </tbody>
            </table>
            <span style="color:green"; id="btnSave" class="btn btn-link"><i class="glyphicon glyphicon-save"> Save </i></span>
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
            var status = $row.find("#row_hold_status").text();
            alert("deleted item has hold_status : "+status);
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
      $('.btnRowHold').hide();
      $('.btnRowEdit').hide();
      $('.btnRowDelete').hide();

      

      $('.checkbox1').click(function (event) {
        no_checkedbox = $('input[name="schemaname[]"]:checked').length;
        if (no_checkedbox > 1){
          console.log(no_checkedbox);
          $('#btnEdit').hide();
        } else if (no_checkedbox = 1) {
          $('.btnRowHold').show();
          $('.btnRowEdit').show();
          $('.btnRowDelete').show();
         
          $('#btnEdit').show(); 
          $("#btnSave").hide();
          var $row = $(this).closest("tr");

          $("#btnEdit" ).click(function(event){
            $('.box-body').hide();
            $('.boxbody2').show();
            $('table').hide();
            $("#btnSave").show();
            $('.editable_table').show();
            $('.edit_schema_row').show();

                selectedSchema = $row.find("#row_schema_name").text();
                var hold_status = $row.find("#row_hold_status").text();
                var hold_by = $row.find("#row_hold_by").text();
                var _date = $row.find("#row_hold_date").text();

                /*alert("Schema Name "+selectedSchema);
                alert('hold_status : '+hold_status);
                alert('hold by '+hold_by);
                alert('date : '+_date);*/

                var _code_hold_status = '<select id="edit_selectBox" class="selectBox" name="new_hold_status" selected="'+hold_status+'"><option id="s_yes" value="yes" >Yes</option><option id="s_no" value="no" >No</option></select>';
                var _code_hold_by = '<input type="text" name="edit_hold_by" class="edit_input_hold_by" id="edit_input_hold_by" value ="'+hold_by+'"/>';
                var _code_hold_till_date = '<input id="input_datepicker" type="text" name="new_hold_date" class="input_datepicker" data-provide="datepicker" value="'+_date+'" placeholder="'+_date+'">';
                
                $('.edit_table_schema_name').html(selectedSchema);
                $('.edit_hold_status').append(_code_hold_status);
                $('.edit_hold_by').append(_code_hold_by);
                $('.edit_hold_till_date').append(_code_hold_till_date);

                $('.edit_hold_till_date').on('click', '.input_datepicker', function() {
                  $(".input_datepicker").datepicker("setDate", new Date());
                  $('.input_datepicker').datepicker({
                        dateFormat: 'yy-mm-dd'
                  });
                  $('.input_datepicker').on('changeDate', function(ev){
                       // $(this).datepicker('hide');
                  });
                });

          $("#btnSave").click(function(){
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
                        }, 1000);
                    },
                    error: function() {
                      alert('ERROR!! Could not be Updated');
                       //$('#notification-bar').text('An error occurred');
                    }
                });
            }
            else{
                return false;
            }
          });
      })
    }
  })

});
</script>
 @stop