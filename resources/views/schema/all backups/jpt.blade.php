<table id="editable_table" class="table table-striped table-bordered" cellspacing="0" width="100%" >
                    <thead>
                      <tr id="schema_row">
                        <th>Schema Name</th>
                        <th>Size in GB</th>
                        <th>Hold Yes/No?</th>
                        <th width="5%">Hold By</th>
                        <th>Hold Till Date</th>
                        <th width="5%">Database Name</th>
                      </tr>
                    </thead>
<tbody>
                      @foreach($list as $row)
                        <tr class = "schema_row">
                            <td id="row_schema_name">{{$row->schema_name}}</td>
                            <td>{{$row->size_in_gb}}</td>
                            <td>
                                  <select id="selectBox" class="selectBox" name="new_hold_status" selected="{{$row->hold_status}}"> 
                                              <option id="s_yes" value="yes" >Yes</option>
                                              <option id="s_no" value="no" >No</option>
                                  </select>
                            </td>
                            <td>
                              <input type="text" name="new_hold_by" class="input_hold_by" id="input_hold_by"  value ="{{$row->hold_by}}"/>
                            </td>
                            <td>
                               <input id="datepicker" type="text" name="new_hold_date" class="datepicker" data-provide="datepicker" value="{{$row->hold_till_date}}" placeholder="{{$row->hold_till_date}}">
                              
                            </td>
                            <td>{{$row->database_name}}</td>
                        </tr>
                      @endforeach
              </tbody>
</table>

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

      $('.datepicker')
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
    });

    /*$("#schematable tr").click(function(event) {
          var $row = $(this).closest("tr");    // Find the row
          var $text = $row.find("#row_schema_name").val(); // Find the text
          var $sch = $("#row_schema_name").closest("tr").val();
          console.log("text : ",$text);
          console.log($sch);
          alert($sch);
          alert(this);
        });*/
  });
</script>

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
    });

    /*$("#schematable tr").click(function(event) {
          var $row = $(this).closest("tr");    // Find the row
          var $text = $row.find("#row_schema_name").val(); // Find the text
          var $sch = $("#row_schema_name").closest("tr").val();
          console.log("text : ",$text);
          console.log($sch);
          alert($sch);
          alert(this);
        });*/

        $(".use-address").click(function() {
    var $row = $(this).closest("tr");    // Find the row
    var $text = $row.find(".nr").text(); // Find the text
    
    // Let's test it out
    alert($text);
});


  //$(".checkbox1").click(){

 
      /*$('#btnRowEdit' ).click(function() {
         var bid = this.id; // button ID 
         var trid = $(this).closest('tr').attr('id'); // table row ID 
         console.log(" id : ",bid);
         console.log("schema id : ",trid);
       });*/

      /*$(".checkbox1").on("click",function(){
          var no_of_box = $('input[name="schemaname[]"]:checked').value;
          var value_box = $('.checkbox1').val();
          console.log("no of box : ",no_of_box);
          console.log("value  of box : ",value_box);
         // console.log($unique_id_schema);
          alert("no of box : "+no_of_box);
          alert("value of box : "+value_box);
        });*/


              /*
              alert("Schema Name "+selectedSchema);
              alert('hold_status : '+hold_status);
              alert('hold by '+hold_by);
              alert('date : '+date);*/