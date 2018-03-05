<!-- jQuery 2.2.3 -->
<script src="css/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="css/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="css/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="css/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="css/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="css/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="css/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="css/dist/js/demo.js"></script>
<!-- page script -->
<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>

<script src="css/plugins/input-mask/jquery.inputmask.js"></script>
<script src="css/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="css/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="css/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="css/plugins/datepicker/bootstrap-datepicker.js"></script>


</body>
</html>