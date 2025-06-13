<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <link href="https://fonts.cdnfonts.com/css/break-love" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/jomolhari-2" rel="stylesheet">
    <title>Salazar Abner</title>
    <style>
        h1 {
            text-align: center;
            color: #ff79c6;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 50px;
            border-radius: 5px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: skyblue;
            color: black;
        }
        tr:nth-child(odd) {
            background-color: white;
            color: black;
        }
        th {
            background-color: #ff3eff;
            color: white;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center; /* Fixed typo here */
            width: 50%;
            background-color: #282a36;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: white;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-size: 16px;
            margin-bottom: 5px;
        }
        input[type="text"] {
            padding: 8px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #3ae374;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-light" style="background-color: rgb(191, 196, 201);">
        <div class="container">
            <a class="navbar-brand" href="" style="color: rgb(0, 15, 150);">Inicio</a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="nav navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black;">
                            Unidad 1
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="batonso/Abner.html">practica uno</a>
                            <a class="dropdown-item" href="/Abner02.html">practica dos</a>
                            <a class="dropdown-item" href="/Abner03.html">practica tres</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black;">
                            Unidad 2
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/Abner01.html">practica cuatro</a>
                            <a class="dropdown-item" href="/Abner02.html">practica cinco</a>
                            <a class="dropdown-item" href="/Abner03.html">practica seis</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black;">
                            Unidad 3
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/Abner01.html">practica siete</a>
                            <a class="dropdown-item" href="/Abner02.html">practica ocho</a>
                            <a class="dropdown-item" href="/Abner03.html">practica nueve</a>
                            <a class="dropdown-item" href="/Abner03.html">practica diez</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="jumbotron" style="background-color: rgb(210, 221, 231);">
        <h1 class="display-4">4-A De Programacion TM.</h1>
        <div class="container">
            <h1>Meter Datos</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="formulario">
                <label for="Id">Id:</label>
                <input type="text" id="Id" name="Id" required><br>
                <label for="Apellido">Apeliido:</label>
                <input type="text" id="Apeliido" name="Apellido" required><br>
                <label for="Nombre">Nombre:</label>
                <input type="text" id="Poder" name="Poder" required><br>
                <label for="Poder">Poder:</label>
                <input type="text" id="Descripcion" name="Descripcion" required><br>
                <input type="submit" value="Agregar Registro">
            </form>
            <?php
            $username = "root";
            $password = "";
            $servername = "localhost";
            $database = "sapos";

            $conexion = new mysqli($servername, $username, $password, $database);
            if ($conexion->connect_error) {
                die("Conexión Fallida: " . $conexion->connect_error);
            }

            function insertarPersonajes($conexion) {
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $Nombre = $conexion->real_escape_string($_POST["Nombre"]);
                    $Alias = $conexion->real_escape_string($_POST["Alias"]);
                    $FechaDeCreacion = $conexion->real_escape_string($_POST["FechaDeCreacion"]);
                    $Descripcion = $conexion->real_escape_string($_POST["Descripcion"]);

                    $sql = "INSERT INTO Personajes (Nombre, Alias, FechaDeCreacion, Descripcion) VALUES ('$Nombre', '$Alias', '$FechaDeCreacion', '$Descripcion')";
                    if ($conexion->query($sql) === TRUE) {
                        echo "<p class='success'>Nuevo personaje agregado.</p>";
                        header("Location: " . $_SERVER['PHP_SELF']);
                        exit();
                    } else {
                        echo "<p class='error'>Error al agregar al personaje: " . $conexion->error . "</p>";
                    }
                }
            }

            insertarPersonajes($conexion);

            $sql = "SELECT * FROM Personajes ORDER BY id DESC";
            $resultado = $conexion->query($sql);
            if ($resultado->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>id</th><th>Nombre</th><th>Alias</th><th>Fecha de Creación</th><th>Descripción</th></tr>";
                while ($row = $resultado->fetch_assoc()) {
                    echo "<tr><td>" . $row["id"] . "</td><td>" . $row["Nombre"] . "</td><td>" . $row["Alias"] . "</td><td>" . $row["FechaDeCreacion"] . "</td><td>" . $row["Descripcion"] . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "No se encontraron registros.";
            }
            $conexion->close();
            ?>
        </div>
    </div>
</body>
</html>