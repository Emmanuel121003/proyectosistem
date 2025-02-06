<?php

require '../config/conexion.php'; // Asegurar conexión a la base de datos

$query = "SELECT * FROM pedidos";
$result = $conexion->query($query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $categoria = $_POST["categoria"];
    $proveedor = $_POST["proveedor"];
    $stock = $_POST["stock"];
    $estado = $_POST["estado"];

    $sql = "INSERT INTO pedidos (nombre, categoria, proveedor, stock, estado) 
            VALUES ('$nombre', '$categoria', '$proveedor', '$stock', '$estado')";

if ($conexion->query($sql) === TRUE) {
    header("Location: ../vistas/pedidos.php");
  } else {
    echo "Error: " . $conexion->error;
  }
}
require '../vistas/header.php';
?>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h2 class="text-center">Agregar Pedido</h2>
                        <div class="panel-body">
                            <form method="POST">
                                <div class="form-group">
                                    <label>Nombre del Producto:</label>
                                    <input type="text" name="nombre" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Categoría:</label>
                                    <input type="text" name="categoria" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Proveedor:</label>
                                    <input type="text" name="proveedor" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Cantidad:</label>
                                    <input type="number" name="stock" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Estado:</label>
                                    <select name="estado" class="form-control">
                                        <option value="pendiente">Pendiente</option>
                                        <option value="enviado">Enviado</option>
                                        <option value="cancelado">Cancelado</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- /.box -->
        </div> <!-- /.col -->
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->

<?php require '../vistas/footer.php'; ?>
