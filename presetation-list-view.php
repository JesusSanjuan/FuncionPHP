<?php
    include "./vistas/inc/admin_security.php";
    include "./vistas/inc/logoutInactividad.php";
?>
<div class="full-box page-header">
    <h3 class="text-left text-uppercase">
        <?php echo $lc->enrutador("presentacion_list","encabezado",0); ?>
    </h3>
    <?php include "./vistas/desc/desc_presentacion.php"; ?>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs text-uppercase">
        <li><?php echo $lc->enrutador("presentacion_new","inactivo",0); ?></li>
        <li><?php echo $lc->enrutador("presentacion_list","activo",0); ?></li>
    </ul>	
</div>

<div class="container-fluid">
     <div class="form-neon">         
            <legend><i class="fas fa-clipboard-list"></i> Lista&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</legend> 
     <hr> 
    <?php
        require_once "./controladores/presentacionControlador.php";
        $ins_presentacion = new presentacionControlador();

        echo $ins_presentacion->paginador_presentacion_controlador();
    ?>
     <br>
    </div>
</div>
<?php
    if ($_SESSION['cargo_svi'] == "Administrador" && $_SESSION['id_svi']==1) {
        $columnas="0,3,4";
    }else{
        $columnas="0,3";
    }
    ?>
<script>
$(document).ready( function () {
    var t = $('#table_presentacion').DataTable( {
        "language": {
            "url": "../vistas/js/DataTableSpanish.json",
        },// Lenguaje
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": [<?php echo $columnas; ?>]
        } ],
        "order": [[ 1, 'asc' ]],
        responsive: true,
        paging: true, //Paginado
        colReorder: true, //Reordenar columnas
        scrollX:true,
        destroy: true,
        "lengthMenu": [[50, 100, 250, 500, -1], [50, 100, 250, 500, "Todos"]]
    });
    
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
});
</script>

<script>
$(function() {
    Swal.fire({
      icon: 'warning',
      title: 'Zona en construccion',
      text: 'Este módulo aun no está enlazado con a los productos, sea paciente, próximamente!',
      allowOutsideClick: false,
      confirmButtonText: 'He comprendido',
      backdrop: `
        rgba(255,100,0,0.2)
        url("../vistas/assets/img/alert.gif")        
        center top
        no-repeat
      `,
      showClass: {
      popup: 'animate__animated animate__fadeInDown'
      },
      hideClass: {
        popup: 'animate__animated animate__fadeOutDown'
      }
    })
});
</script>
