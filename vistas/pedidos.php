<?php
require '../config/conexion.php';

$query = "SELECT * FROM pedidos";
$result = $conexion->query($query);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST["nombre"];
  $categoria = $_POST["categoria"];
  $stock = $_POST["stock"];
  $proveedor = $_POST["proveedor"];
  $fecha = $_POST["fecha"];
  $estado = $_POST["estado"];
}

$sql = "SELECT * FROM pedidos";
$result_pedidos = $conexion->query($sql);

// Verificar si la consulta fue exitosa
if (!$result_pedidos) {
    die("Error en la consulta: " . $conexion->error);
}


require '../vistas/header.php';
?>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
            <div class="box">
            <div class="box-header with-border">
                        <h1 class="box-title">Gestion de Pedidos</h1>
                        <a href="../modelos/pedidos.php" class="btn btn-success pull-right"><i class="fa fa-plus-circle"></i> Agregar Pedido</a>
                    </div>
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table class="table table-bordered table-striped" id="tbllistado">
                            <thead>
                                <tr>
                                    <th>ID Pedido</th>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th> <!-- Nueva columna para acciones -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result_pedidos->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $row["id"]; ?></td>
                                        <td><?php echo $row["nombre"]; ?></td>
                                        <td><?php echo $row["estado"]; ?></td>
                                        <td><?php echo $row["fecha"]; ?></td>
                                        <td>
                                            <a href="../modelos/edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Editar</a>
                                            <button class="btn btn-danger" onclick="confirmarEliminacion(<?php echo $row['id']; ?>)">Eliminar</button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                        </table>
                    </div>
                </div> <!-- /.box -->
            </div> <!-- /.col -->
        </div> <!-- /.row -->
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->

<script>
$(document).ready(function() {
    if (!$.fn.DataTable.isDataTable("#tbllistado")) {
        $('#tbllistado').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    }
});

function cambiarEstado(id, estado) {
    // Aquí puedes llamar a tu backend con AJAX para cambiar el estado del pedido
    alert("Cambiar estado del pedido " + id + " a " + estado);
}
function confirmarEliminacion(id) {
    if (confirm("¿Estás seguro de que deseas eliminar esta refacción?")) {
        window.location.href = "../modelos/delete.php?id=" + id;
    }
}
</script>

<?php require 'footer.php'; ?>
