   <script src="{{ URL::asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>

    <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('plugins/datatables/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <!--datepicker-->
    <script src="{{ URL::asset('plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>

    <script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js" type="text/javascript"></script>
    
<script type="text/javascript">
    $body = $("body");

    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }    
    });
</script>
@yield('scripts')
