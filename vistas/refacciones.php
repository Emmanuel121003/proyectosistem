<?php 
require_once "../config/Conexion.php";
$query = "SELECT * FROM refacciones";
$result = $conexion->query($query);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST["nombre"];
  $categoria = $_POST["categoria"];
  $numero_parte = $_POST["numero_parte"];
  $stock = $_POST["stock"];
  $proveedor = $_POST["proveedor"];
  $ubicacion = $_POST["ubicacion"];
  $estado = $_POST["estado"];

  // Manejo de imagen
  $imagen = $_FILES["imagen"]["name"];
  $ruta_imagen = "../files/uploads/" . basename($imagen);
  move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_imagen);
}
require '../vistas/header.php';
?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title">Refacciones</h1>
                        <a href="../modelos/agregar.php" class="btn btn-success pull-right">
                            <i class="fa fa-plus-circle"></i> Agregar Refacción
                        </a>
                    </div>
                    
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table class="table table-bordered table-striped" id="tbllistado">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Número de Parte</th>
                                    <th>Stock</th>
                                    <th>Proveedor</th>
                                    <th>Ubicación</th>
                                    <th>Imagen</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $row["nombre"]; ?></td>
                                        <td><?php echo $row["categoria"]; ?></td>
                                        <td><?php echo $row["numero_parte"]; ?></td>
                                        <td><?php echo $row["stock"]; ?></td>
                                        <td><?php echo $row["proveedor"]; ?></td>
                                        <td><?php echo $row["ubicacion"]; ?></td>
                                        <td>
                                            <img src="../files/uploads/<?php echo $row["imagen"]; ?>" class="img-thumbnail" width="50" height="50">
                                        </td>
                                        <td><?php echo $row["estado"]; ?></td>
                                        <td>
                                            <a href="../modelos/editar.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Editar</a>
                                            <button class="btn btn-danger" onclick="confirmarEliminacion(<?php echo $row['id']; ?>)">Eliminar</button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
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

function confirmarEliminacion(id) {
    if (confirm("¿Estás seguro de que deseas eliminar esta refacción?")) {
        window.location.href = "../modelos/eliminar.php?id=" + id;
    }
}
</script>


<?php require 'footer.php'; ?>