<!-- /.content-wrapper 
  <footer class="main-footer">
    <strong>Perú - 2019</strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Sistema de Prestamos</b> v1
    </div>
  </footer>
-->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>


<!-- jQuery -->
<script src="<?php echo base_url();?>/public/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url();?>/public/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url();?>/public/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url();?>/public/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url();?>/public/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url();?>/public/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url();?>/public/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url();?>/public/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url();?>/public/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url();?>/public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url();?>/public/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url();?>/public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>/public/dist/js/adminlte.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>/public/dist/js/demo.js"></script>

<script src="<?php echo base_url();?>/public/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>/public/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url();?>/public/plugins/select2/js/select2.full.min.js"></script>

<script src="<?php echo base_url();?>/public/alerta/notify.js"></script>
<script src="<?php echo base_url();?>/public/alerta/alerta.js"></script>


<script  src="<?php echo base_url()?>/public/toastr/toastr.min.js"></script>

<script src="<?php echo base_url();?>/public/plugins/jquery-ui/jquery-ui.js"></script>

<!-- page script -->
<script>
  $(function () {
    var table= $('#exampleReport').DataTable({

 
     
        
       
        "language":{
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrando &nbsp _MENU_ &nbsp registros por página",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar&nbsp",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}

  });
    $("#example1").DataTable();
  });
    $(document).on("click",".btn-remove-comprobante",function(){
             $(this).closest("tr").remove();});
   $(function () {
     //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
 
</script>
<script src="<?php echo base_url(); ?>/public/myjs/caja.js"></script>
<script src="<?php echo base_url(); ?>/public/myjs/validacion.js"></script>
<script src="<?php echo base_url(); ?>/public/myjs/ventas.js"></script>
<script src="<?php echo base_url(); ?>/public/myjs/clientes.js"></script>
<script src="<?php echo base_url(); ?>/public/myjs/facturacion.js"></script>
<script src="<?php echo base_url(); ?>/public/myjs/pedidos.js"></script>
</body>
</html>
