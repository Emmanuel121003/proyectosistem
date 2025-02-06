<?php
require_once "../config/Conexion.php";

$id = $_GET['id'];
$sql = "DELETE FROM pedidos WHERE id=$id";

if ($conexion->query($sql) === TRUE) {
    header("Location: ../vistas/pedidos.php");
} else {
    echo "Error al eliminar: " . $conexion->error;
}
?>
