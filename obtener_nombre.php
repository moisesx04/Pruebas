<?php
$conexion = new mysqli("localhost", "usuario", "contraseña", "nombre_base_de_datos");

if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

$matricula = $_GET['matricula'] ?? '';

$sql = "SELECT nombre FROM estudiantes WHERE matricula = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $matricula);
$stmt->execute();
$resultado = $stmt->get_result();

if ($fila = $resultado->fetch_assoc()) {
  echo json_encode(["nombre" => $fila['nombre']]);
} else {
  echo json_encode(["nombre" => "No encontrado"]);
}
?>
