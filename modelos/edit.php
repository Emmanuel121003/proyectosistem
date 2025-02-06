<?php

require_once "../config/Conexion.php";
$id = $_GET['id'];
$query = "SELECT * FROM pedidos WHERE id = $id";
$result = $conexion->query($query);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $categoria = $_POST["categoria"];
    $proveedor = $_POST["proveedor"];
    $stock = $_POST["stock"];
    $estado = $_POST["estado"];

    $sql = "UPDATE pedidos SET  nombre='$nombre', categoria='$categoria', proveedor='$proveedor', stock='$stock', estado='$estado' WHERE id=$id";

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
                        <h2 class="text-center">Editar Pedido</h2>
                        <form method="POST">
                            <div class="form-group">
                                <label>Nombre del Producto:</label>
                                <input type="text" name="nombre" class="form-control" value="<?php echo $row['nombre']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Categoría:</label>
                                <input type="text" name="categoria" class="form-control" value="<?php echo $row['categoria']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Proveedor:</label>
                                <input type="text" name="proveedor" class="form-control" value="<?php echo $row['proveedor']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Stock:</label>
                                <input type="number" name="stock" class="form-control" value="<?php echo $row['stock']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Estado:</label>
                                <select name="estado" class="form-control">
                                    <option value="pendiente" <?php if ($row['estado'] == 'pendiente') echo 'selected'; ?>>Pendiente</option>
                                    <option value="enviado" <?php if ($row['estado'] == 'enviado') echo 'selected'; ?>>Enviado</option>
                                    <option value="cancelado" <?php if ($row['estado'] == 'cancelado') echo 'selected'; ?>>Cancelado</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div> <!-- /.box -->
        </div> <!-- /.col -->
</div> <!-- /.row -->
</section> <!-- /.content -->
</div> <!-- /.content-wrapper -->

<?php require '../vistas/footer.php'; ?>
