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
              </div><!-- /.box-header -->
                    <div class="btn-group">
                        <a href="{{URL::to('/schema')}}"><button class="btn btn-success"><i class="glyphicon glyphicon-refresh"> Refresh</i></button></a>
                    </div>
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
                        <th>Hold Yes/No?</th>
                        <th width="5%">Hold By</th>
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
                            <td>
                                <div id="row_hold_status">
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
                              <div id="row_hold_by">{{$row->hold_by}}</div>
                              <input type="text" name="new_hold_by" class="input_hold_by" id="input_hold_by"  value ="{{$row->hold_by}}"/>
                            </td>
                            <td>
                              <div id="row_hold_date"> {{$row->hold_till_date}}</div>
                               <input id="datepicker" type="text" name="new_hold_date" class="datepicker" data-provide="datepicker" value="{{$row->hold_till_date}}" placeholder="{{$row->hold_till_date}}">
                              
                            </td>
                            <td>{{$row->database_name}}</td>
                            <td>
                              <span id="btnRowEdit" class="btn btn-link"><i class="glyphicon glyphicon-edit"> Edit </i></span>
                              <span style="color:green"; id="btnRowSave" class="btn btn-link"><i class="glyphicon glyphicon-save"> Save </i></span>
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
            if (!confirm("Are you sure you want to delete these " + no_of_checkedbox + " selected items ?")){
            return false;
            }
          }
        });

       // var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
        //alert(chkbox_checked);

        

        
</script>

<script>

  $(document).ready(function() {
          $("#btnRowSave").css("color", "green");
          $("#btnRowEdit").show();
          $("#btnRowSave").hide();

          $('#row_hold_by').show();
          $('#row_hold_date').show();
          $("#row_hold_status").show();

          $("#input_hold_by").hide();
          $("#input_date").hide();
          $("#datepicker").hide();
          $("#selectBox").hide();

          $(".input_hold_by").hide();
          $(".input_date").hide();
          $(".datepicker").hide();
          $(".selectBox").hide();

      $('#datepicker')
            .datepicker({format: "yyyy/mm/dd"})
            .datepicker("setDate", new Date())
            .on('changeDate', function(ev){$(this).datepicker('hide')});



    $("tr.schema_row").each(function(i, tr) {
        $("#btnRowEdit").click(function(){
              $("#btnRowEdit").hide();
              $("#btnRowSave").show();

              $("#row_hold_status").hide();
              $('#row_hold_by').hide();
              $('#row_hold_date').hide();
              
              $("#selectBox").show();
              $("#input_hold_by").show();
              $("#input_date").show();
              
              $('.datepicker').datepicker()
              $("#datepicker").show();
        })

        $("#btnRowSave").click(function(){
              $("#btnRowEdit").show();
              $("#btnRowSave").hide();

              $("#row_hold_status").show();
              $('#row_hold_by').show();
              $('#row_hold_date').show();
                
              $("#selectBox").hide();
              $("#input_hold_by").hide();
              $("#input_date").hide();
                
              $('.datepicker').datepicker()
              $("#datepicker").hide();

              var hold_status = $("#selectBox", tr).val();
              var hold_by = $("input.input_hold_by", tr).val();
              var date = $("input.datepicker", tr).val();
              var selectedSchema = $("#row_schema_name",tr).text();

              alert("Schema Name "+selectedSchema);
              alert('hold_status : '+hold_status);
              alert('hold by '+hold_by);
              alert('date : '+date);

              $.ajax({
                  type: "GET",
                 // url: "/laravel/dashboard/public/schema/update",
                  url: "{{URL::to('/schema/update') }}",
                  data: {
                    selectedSchema: selectedSchema, hold_status: hold_status, hold_by: hold_by, date: date
                  },
                  success: function( data ) {
                    alert('Successfully Updated table !! :(');
                  }
                });
        })
    
        $(".checkbox1").click(function() {
          var $row = $(this).closest("tr");    // Find the row
          var $text = $row.find("#row_schema_name").val(); // Find the text
          var $sch = $("#row_schema_name").closest("tr").val();
          console.log("text : ",$text);
          console.log($sch);
    // Let's test it out
          alert($sch);
        });
    });
 });
</script>

 @stop

