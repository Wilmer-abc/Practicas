<?php
include('conexion.php');

// Capturar el filtro de búsqueda (opcional)
$filtro = "";
if (isset($_GET['filtro'])) {
    $filtro = $_GET['filtro'];
}

// Verificar si hay algún filtro aplicado
if ($filtro != "") {
    // Si hay filtro, realizar la consulta con filtro (buscar en descripción o código)
    $sql = "SELECT * FROM bp_productos WHERE descripcion LIKE '%$filtro%' OR codigo LIKE '%$filtro%'";
} else {
    // Si no hay filtro, mostrar todos los productos
    $sql = "SELECT * FROM bp_productos";
}

// Consultar la base de datos
$result = $conn->query($sql);

// Depurar: Mostrar la consulta generada
echo "<!-- SQL Query: " . $sql . " -->";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 80%;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container img {
            max-width: 150px; /* Tamaño ajustable */
            height: auto;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
        }

        label {
            margin-right: 10px;
            font-weight: bold;
            color: #444;
        }

        input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 2px solid #ccc;
            border-radius: 5px;
            outline: none;
            transition: border 0.3s ease;
        }

        input[type="text"]:focus {
            border-color: #007BFF;
        }

        input[type="submit"] {
            padding: 10px 15px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: #fff;
        }

        td {
            background-color: #f9f9f9;
        }

        tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        tr:hover td {
            background-color: #f1f1f1;
        }

        .no-results {
            text-align: center;
            color: #ff0000;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Contenedor para el logo -->
        <div class="logo-container">
            <img src="images/walmart-logo.png" alt="Logo de WallMart">
        </div>
        
        <h2>Lista de Productos</h2>
        
        <form method="GET" action="productos.php">
            <label for="filtro">Buscar producto (por descripción o código):</label>
            <input type="text" id="filtro" name="filtro" value="<?php echo htmlspecialchars($filtro); ?>">
            <input type="submit" value="Buscar">
        </form>
        
        <table>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Precio Venta</th>
                <th>Precio Oferta</th>
                <th>En Oferta</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                // Si hay productos, mostrarlos en la tabla
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['codigo'] . "</td>";
                    echo "<td>" . $row['descripcion'] . "</td>";
                    echo "<td>" . $row['precio_venta'] . "</td>";
                    echo "<td>" . $row['precio_oferta'] . "</td>";
                    echo "<td>" . ($row['oferta'] == 'S' ? 'Sí' : 'No') . "</td>";
                    echo "</tr>";
                }
            } else {
                // Si no hay productos, mostrar un mensaje
                echo "<tr><td colspan='5' class='no-results'>No se encontraron productos</td></tr>";
            }
            ?>
        </table>
    </div>

<?php
$conn->close();
?>
</body>
</html>
