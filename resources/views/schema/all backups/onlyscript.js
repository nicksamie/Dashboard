    //})
          //});


/*      $('#schematable tr').click(function (event) {
        //$(this).closest('tr').attr('id');
        alert($(this).closest("tr").attr('id'));
      });*/

      //$("tr.schema_row").each(function(tr) {
     
         //if ( $(this).hasClass('selected') ) {
          //$("#btnRowEdit").click(function(){
              $("#btnRowEdit").hide();
              $("#btnRowSave").show();
              $(".btnRowSave").show();

              $("#row_hold_status").hide();
              $('#row_hold_by').hide();
              $('#row_hold_date').hide();
              
              $("#selectBox").show();
              $("#input_hold_by").show();
              $("#input_date").show();
              
              $('.datepicker').datepicker()
              $("#datepicker").show();
          })
       });

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
          });
      //});
  });
  /*     $('#schematable tr btnRowEdit').click(function (event) {
                  $unique_id_schema = $(this).attr('id');
                  alert("Edit Schema " +$unique_id_schema + "???");    
               //s});*/
    /*  $("#schematable tr").each(function(i, unique_id_schema) {

        //

        

    });

  });
              /*
              alert("Schema Name "+selectedSchema);
              alert('hold_status : '+hold_status);
              alert('hold by '+hold_by);
              alert('date : '+date);*/