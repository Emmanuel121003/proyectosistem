<?php
require_once "../config/Conexion.php";
$id = $_GET['id'];
$query = "SELECT * FROM refacciones WHERE id = $id";
$result = $conexion->query($query);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $categoria = $_POST["categoria"];
    $numero_parte = $_POST["numero_parte"];
    $stock = $_POST["stock"];
    $proveedor = $_POST["proveedor"];
    $ubicacion = $_POST["ubicacion"];
    $estado = $_POST["estado"];

    $sql = "UPDATE refacciones SET nombre='$nombre', categoria='$categoria', numero_parte='$numero_parte', stock='$stock', proveedor='$proveedor', ubicacion='$ubicacion', estado='$estado' WHERE id=$id";

    if ($conexion->query($sql) === TRUE) {
        header("Location: ../vistas/refacciones.php");
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
                        <h2 class="text-center">Editar Refacción</h2>
                        <form method="POST">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" name="nombre" class="form-control" value="<?php echo $row['nombre']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Categoría:</label>
                                <input type="text" name="categoria" class="form-control" value="<?php echo $row['categoria']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Número de Parte:</label>
                                <input type="text" name="numero_parte" class="form-control" value="<?php echo $row['numero_parte']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Stock:</label>
                                <input type="number" name="stock" class="form-control" value="<?php echo $row['stock']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Proveedor:</label>
                                <input type="text" name="proveedor" class="form-control" value="<?php echo $row['proveedor']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Ubicación:</label>
                                <input type="text" name="ubicacion" class="form-control" value="<?php echo $row['ubicacion']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Estado:</label>
                                <select name="estado" class="form-control">
                                    <option value="Disponible" <?php if ($row['estado'] == 'Disponible') echo 'selected'; ?>>Disponible</option>
                                    <option value="Agotado" <?php if ($row['estado'] == 'Agotado') echo 'selected'; ?>>Agotado</option>
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