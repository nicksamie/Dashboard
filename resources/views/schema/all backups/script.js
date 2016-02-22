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

  $(document).ready(function() {
          $("#btnRowEdit").show();
          $("#btnRowSave").hide();
          $(".btnRowSave").hide();

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

     $('#datepicker').datepicker({
          format: "yyyy/mm/dd"
      });  
     $("#datepicker").datepicker("setDate", new Date());
     $('#datepicker').on('changeDate', function(ev){
          $(this).datepicker('hide');
      });

     $('#schematable tr').click(function (event) {
        $unique_id_schema = $(this).attr('id');
        alert("Schema id : " +$unique_id_schema);    
     //});

      $("#schematable tr").each(function(i, unique_id_schema) {

        //$("#btnRowEdit").click(function(){
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

              /*alert("Schema Name "+selectedSchema);
              alert('hold_status : '+hold_status);
              alert('hold by '+hold_by);
              alert('date : '+date);
              */
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

  });
              /*
              alert("Schema Name "+selectedSchema);
              alert('hold_status : '+hold_status);
              alert('hold by '+hold_by);
              alert('date : '+date);*/
</script>
 $('#datepicker').datepicker({
            format: "yyyy/mm/dd"
          });  
          $("#datepicker").datepicker("setDate", new Date());
          $('#datepicker').on('changeDate', function(ev){
            $(this).datepicker('hide');
          });

                    $('#datepicker')
            .datepicker({format: "yyyy/mm/dd"})
            .datepicker("setDate", new Date())
            .on('changeDate', function(ev){$(this).datepicker('hide')});