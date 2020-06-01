</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="http://adminlte.io">tbi.com</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block ">
        <b>Developement by Yassen Sayed <a class="text-danger"
                href="mailto:devysm2019@gmail.com">devysm2019@gmail.com</a></b>
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('backend/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('backend/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('backend/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('backend/dist/js/pages/dashboard.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>
<script src="{{ asset('backend/dist/js/lightbox.min.js') }}"></script>
<script src="{{ asset('backend/dist/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('backend/dist/js/dropify.min.js') }}"></script>
<script src="{{ asset('backend/dist/js/main.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
@yield('js')
<script>
    $(function () {
    // Summernote
    $('.textarea').summernote({
        height: 150,   //set editable area's height
        codemirror: { // codemirror options
            theme: 'monokai'
        }
    })
  })
</script>
@if(Session::has('success'))
<script>
    $(document).ready(function (){
    swal("Successfully Request.", "{{Session::get('success')}}!", "success");
   })
</script>
@elseif(Session::has('error'))
<script>
    $(document).ready(function (){
    swal("Failed request.", "{{Session::get('error')}}!", "error");
})
</script>
@endif

<script>
    function confirmDelete(location) {
    swal({
        title: "Are You Sure?",
        text: "You will not be able to recover this data again.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ff4f4f",
        cancelButtonColor: "#000",
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",
        closeOnConfirm: true,
        closeOnCancel: true
        }, function(isConfirm) {
        if (isConfirm) {
            console.log(location)
            window.location.href = location;
        } else {
            // swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    });
}
</script>

<script>
    lightbox.option({
  'resizeDuration': 200,
  'wrapAround': true
})
</script>
<script>
    $(function () {
 
      $('.data-table').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
        lengthMenu: [5, 10, 20, 50, 100, 200, 500],
       });
    });

    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
 
  })
</script>
</body>


</html>