<?php
include('conexion.php');

$codigo = $_POST['codigo'];
$password = $_POST['password'];

// Consultar la base de datos para validar cliente
$sql = "SELECT * FROM bp_clientes WHERE codigo = '$codigo' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Si el cliente existe, redirigir a la página de productos
    header("Location: productos.php");
} else {
    // Si el cliente no existe, mostrar mensaje de error
    echo "Cliente no cuenta con accesos";
}
$conn->close();
?>
