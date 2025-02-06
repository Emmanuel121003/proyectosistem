<?php
require_once "../config/Conexion.php";

class Orden {
    public function __construct() {}

    public function listar() {
        $sql = "SELECT * FROM ordenes";
        return ejecutarConsulta($sql);
    }

    public function insertar($cliente, $producto, $cantidad, $total) {
        $sql = "INSERT INTO ordenes (cliente, producto, cantidad, total) VALUES ('$cliente', '$producto', '$cantidad', '$total')";
        return ejecutarConsulta($sql);
    }
}

$orden = new Orden();

switch ($_GET["op"]) {
    case 'listar':
        $rspta = $orden->listar();
        $data = array();
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "id" => $reg->id,
                "cliente" => $reg->cliente,
                "producto" => $reg->producto,
                "cantidad" => $reg->cantidad,
                "total" => $reg->total
            );
        }
        echo json_encode($data);
        break;
    case 'insertar':
        $cliente = $_POST['cliente'];
        $producto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        $total = $_POST['total'];
        $rspta = $orden->insertar($cliente, $producto, $cantidad, $total);
        echo json_encode($rspta);
        break;
}
