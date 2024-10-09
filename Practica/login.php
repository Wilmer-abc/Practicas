<?php
include('conexion.php');

$error = ""; // Variable para almacenar el error, si ocurre
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo = $_POST['codigo'];
    $password = $_POST['password'];

    // Consultar en la base de datos si el cliente existe
    $sql = "SELECT * FROM bp_clientes WHERE codigo = '$codigo' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Redirigir a la página de productos si el cliente es válido
        header("Location: productos.php");
        exit();
    } else {
        $error = "Código o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - WallMart</title>
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
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-right: 10px;
            font-weight: bold;
            color: #444;
            margin-bottom: 10px;
        }

        input[type="text"], input[type="password"] {
            padding: 10px;
            width: 300px;
            border: 2px solid #ccc;
            border-radius: 5px;
            outline: none;
            transition: border 0.3s ease;
            margin-bottom: 20px;
        }

        input[type="text"]:focus, input[type="password"]:focus {
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

        .error {
            color: red;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Contenedor para el logo -->
        <div class="logo-container">
            <img src="images/walmart-logo.png" alt="Logo de WallMart">
        </div>

        <h2>Iniciar Sesión</h2>

        <form method="POST" action="">
            <label for="codigo">Código de Cliente:</label>
            <input type="text" id="codigo" name="codigo" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Iniciar Sesión">
        </form>

        <?php
        if ($error != "") {
            echo "<div class='error'>$error</div>";
        }
        ?>
    </div>
</body>
</html>
