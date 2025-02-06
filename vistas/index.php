<?php 

require_once "../config/Conexion.php";


// Pedidos pendientes
$query_pedidos = "SELECT * FROM pedidos WHERE estado = 'pendiente'";
$result_pedidos = $conexion->query($query_pedidos);

// Refacciones con escasez (stock menor a 5)
$query_escasez = "SELECT * FROM refacciones WHERE stock < 5";
$result_escasez = $conexion->query($query_escasez);
require '../vistas/header.php';
?>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title">Escritorio</h1>
                    </div>

                    <div class="panel-body">

                        <!-- Pedidos Pendientes -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Pedidos Pendientes</h3>
                            </div>
                            <div class="box-body table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="tbllistado_pedidos">
                                    <thead>
                                        <tr>
                                            <th>ID Pedido</th>
                                            <th>Nombre</th>                                           
                                            <th>Estado</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $result_pedidos->fetch_assoc()): ?>
                                            <tr>
                                                <td><?php echo $row["id"]; ?></td>
                                                <td><?php echo $row["nombre"]; ?></td>
                                                <td><?php echo $row["estado"]; ?></td>
                                                <td><?php echo $row["fecha"]; ?></td>                            
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Refacciones con Escasez -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Refacciones con Escasez</h3>
                            </div>
                            <div class="box-body table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="tbllistado_escasez">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Stock</th>
                                            <th>Ubicación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $result_escasez->fetch_assoc()): ?>
                                            <tr>
                                                <td><?php echo $row["nombre"]; ?></td>
                                                <td><?php echo $row["stock"]; ?></td>
                                                <td><?php echo $row["ubicacion"]; ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.box -->
            </div> <!-- /.col -->
        </div> <!-- /.row -->
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->

<?php require 'footer.php'; ?>

<script>
$(document).ready(function() {
    $('#tbllistado_pedidos, #tbllistado_escasez').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true
    });
});
</script>
