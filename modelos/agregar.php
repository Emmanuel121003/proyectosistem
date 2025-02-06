<?php
require_once "../config/Conexion.php";
$query = "SELECT * FROM refacciones";
$result = $conexion->query($query);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $imagen = $_FILES["imagen"]["name"];
  $ruta_imagen = "../files/uploads/" . basename($imagen);
  move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_imagen);

  $sql = "INSERT INTO refacciones (nombre, categoria, numero_parte, stock, proveedor, ubicacion, imagen, estado) 
          VALUES ('$nombre', '$categoria', '$numero_parte', '$stock', '$proveedor', '$ubicacion', '$imagen', '$estado')";

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
                        <h2 class="text-center">Agregar Refacción</h2>
                        <div class="panel-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Nombre:</label>
                                    <input type="text" name="nombre" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Categoría:</label>
                                    <input type="text" name="categoria" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Número de Parte:</label>
                                    <input type="text" name="numero_parte" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Stock:</label>
                                    <input type="number" name="stock" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Proveedor:</label>
                                    <input type="text" name="proveedor" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Ubicación:</label>
                                    <input type="text" name="ubicacion" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Imagen:</label>
                                    <input type="file" name="imagen" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Estado:</label>
                                    <select name="estado" class="form-control">
                                        <option value="Disponible">Disponible</option>
                                        <option value="Agotado">Agotado</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- /.box -->
        </div> <!-- /.col -->
</div> <!-- /.row -->
</section> <!-- /.content -->
</div> <!-- /.content-wrapper -->
<?php require '../vistas/footer.php'; ?>