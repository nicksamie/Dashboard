            <div id="deleteTheProduct">
              {!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteProduct', 'action' => ['SchemaController@destroy', $schema->schema_name]]) !!}
                    {!! Form::button( '<i class="fa fa-trash fa-lg"></i>', ['type' => 'submit', 'class' => 'delete text-danger deleteProduct','id' => 'btnDeleteProduct', 'data-id' => $row->schema_name ] ) !!}
               {!! Form::close() !!}
           </div>

           <script>
      $('.deleteProduct').on('click', function(e) {
      var inputData = $('#formDeleteProduct').serialize();

      var dataId = $('#btnDeleteProduct').attr('data-id');

      $.ajax({
          url: '{{ url('/admin/products') }}' + '/' + dataId,
          type: 'POST',
          data: inputData,
          success: function( msg ) {
              if ( msg.status === 'success' ) {
                  toastr.success( msg.msg );
                  setInterval(function() {
                      window.location.reload();
                  }, 5900);
              }
          },
          error: function( data ) {
              if ( data.status === 422 ) {
                  toastr.error('Cannot delete the category');
              }
          }
      });

      return false;
  });
    </script>
    <td>
            <a href="{{ url('/admin/products/' . $product->id . '/edit') }}" class="links-dark edits pull-left">
                <i class="fa fa-edit fa-lg"></i>
            </a>
            <div id="deleteTheProduct">
                {!! Form::open(['method' => 'DELETE', 'id' => 'formDeleteProduct', 'action' => ['AdminProductsController@destroy', $product->id]]) !!}
                    {!! Form::button( '<i class="fa fa-trash fa-lg"></i>', ['type' => 'submit', 'id' => 'btnDeleteProduct', 'data-id' => $product->id ] ) !!}
               {!! Form::close() !!}
           </div>
       </td>

          <script type="text/javascript">
      $(function () {
        $('#schematable').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });


    $(document).ready(function(){
        $("button").click(function(){
            $("#delete").hide();
        });
    });

    $(document).ready(function(){
    //$("#delete").hide();
    //$("#datepicker1").hide();
    //$("#save_row").hide();
     $("button").click(function(){
        $("#save_row").hide();
    });
});
    </script>

    <!-- <td>{{HTML::linkRoute('delete_formdata','Delete ',array($row->schema_name))}}</td> -->
                            <!-- <a href="{{ url('/admin/products/' . $product->id . '/edit') }}" class="links-dark edits pull-left">
                                            <i class="fa fa-edit fa-lg"></i>
                                        </a> -->

<button id="#edit-'.$user->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</button> |

<!-- { Form::open(array('url' => 'delete/', 'method' => 'get', 'id' => 'deleteSelected')) !!} -->

 <!-- <?php $name = $row->schema_name;?>
                              <form name="deleterow/" action="delete_row/<?php //echo $name ?>" method="get">
                             
                             
                                  <button id="btn_delete" type="submit" >Delete</button>
                              </form>
                              -->

                               public function deleteParticularRow(Request $request,$s)
    {
        echo ('Row deleted');
        $s = Input::get('s');
        echo ("deleted row").$s;
        //DB::table('users')->where('id', '=', 66)->delete();
        //DB::table('schematables')->where('schema_name', '=', $schemaname)->delete();

        return Redirect::to('schema.shema');
        //DELETE FROM table_name [WHERE Clause]
        //$book = Book::find($id);
        //$book->delete();

    }

    public function deleteSelectedRows($schemaname)
    {
        echo ('deleted');
        //$schemaname = Input::get('schemaname');
        //$schemaname = Request::all() ;
        //echo $schemaname;
        /*
        $schema= Schema::find($schemaname);

        $schema->delete();
        $data = Input::all();

        foreach($data['checkboxes'] as $id) {
        DB::table('schematables')->where('schema_name', $schemaname)->delete();
        }
            return redirect('schema/schema');
            */
    }

   <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4>  <i class="icon fa fa-check"></i> Alert!</h4>
                     {{ session('status') }}
      </div>

      <td>
          {!! Form::open(array('url' => 'delete_row', 'method' => 'DELETE', 'id' => 'delete_particular_row')) !!}
          {!! Form::submit('Delete', ['id'=>'delete_particular_row']) !!} 
          {!! Form::close() !!}
                           </td>