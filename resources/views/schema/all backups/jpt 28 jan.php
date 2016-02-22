<script>
      $('.checkbox1').click(function (event) {
        no_checkedbox = $('input[name="schemaname[]"]:checked').length;
        if (no_checkedbox > 1){
          console.log(no_checkedbox);
          $('#btnEdit').hide();
        } else if (no_checkedbox = 1) {
          /*$('.btnRowHold').show();
          $('.btnRowEdit').show();
          $('.btnRowDelete').show();*/
         
          $('#btnEdit').show(); 
          $("#btnSave").hide();
          var $row = $(this).closest("tr");

          $("#btnRowEdit" ).click(function(event){
            $('.box-body').hide();
            $('.boxbody2').show();
            $('table').hide();
            $("#btnSave").show();
            $('.editable_table').show();
            $('.edit_schema_row').show();

                selectedSchema = $row.find("#row_schema_name").text();
                alert("selected schema : "+selectedSchema);
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

     $(".checkbox1").click(function() {
          if($(this).is(":checked")) 
          {
              alert('home is checked');
          } else if(!$(this).is(':checked')){
             alert('UNChecked');
          }
      });

                /*var $row = $(this).closest("tr");
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
            console.log(no_checkedbox);
            $('#btnEdit').hide();
          }*/