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
                            <td width="3%"><input type="checkbox" id="checkbox1" class="checkbox1" name="schemaname[]" 
                                data-id="cb" value="{{$row->schema_name}}"></td>
                            <td width="5%" id="row_schema_name">{{$row->schema_name}}</td>
                            <td class="edit_table_schema_name"></td>
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
                            <td width="5%">
                              <div id="row_hold_by">{{$row->hold_by}}</div>
                              <input type="text" name="new_hold_by" class="input_hold_by" id="input_hold_by"  value ="{{$row->hold_by}}"/>
                            </td>
                            <td width="5%"><div id="row_hold_date"> {{$row->hold_till_date}}</div></td>
                            <td width="3%" id="row_database_name">{{$row->database_name}}</td>
                            <td width="15%">
                    <a href="{{$row->schema_name}}" class="btnRowEdit" ><button class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</button></a> |
                    <a href="{{$row->schema_name}}" class="btnRowDelete" ><button class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove" style="color:red";></i> Delete</button></a> |
                    <a href="{{url('schema/viewtables/'.$row->schema_name)}}" class="btn btn-xs btn-primary">View Tables</a>
                            <!-- <span class= "btnRowEdit"> 
                              <span id="btnRowEdit" class="btn btn-link"><a id="modal_trigger" href="#popupmodal" class="btn"><i class="glyphicon glyphicon-edit"> Edit </a></i></span>
                            </span> -->
                            <!-- <span class= "btnRowDelete"> 
                              <span style="color:red"; id="btnRowDelete" class="btn btn-link"><i class="glyphicon glyphicon-remove"> Delete </i></span>
                            </span> -->
                            
                            <!-- <span class= "btnRowViewTables"> 
                              <span id="btnRowViewTables" class="btn btn-link"><i class="glyphicon glyphicon-edit">ViewTables</i></span>
                            </span> -->
                            </td>
                        </tr>
                      @endforeach
                        <!-- <div id="boxEdit">
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
                        </div> -->
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
  <div id="bxEdit" class="popupContainer" style="display:none;">
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

    $(".btnRowEdit").click(function(event) {
        var href = $(this).attr('href');
        alert(href);
        event.preventDefault();
        $("#row_schema_name").hide();

        $(".edit_table_schema_name").show();
        
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
</script>

@stop