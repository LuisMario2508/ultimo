<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$database = "tigres";

$conexion = new mysqli($servername, $username, $password, $database);
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jugador = $_POST["jugador"];
    $campeonatos = $_POST["campeonatos"];
    $posicion = $_POST["posicion"];
    $edad = $_POST["edad"];
    $dorsal = $_POST["dorsal"];

    $stmt = $conexion->prepare("INSERT INTO tigres (jugadores, campeonatos, posicion, edad, dorsal) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $jugador, $campeonatos, $posicion, $edad, $dorsal);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Jugadores</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #002469, #f9c20b);
            font-family: 'Orbitron', sans-serif;
            margin: 0;
            padding: 0;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        header {
            width: 100%;
            background-color: #f9c20b;
            color: #002469;
            padding: 20px;
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            position: relative;
        }
        .inicio-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #002469;
            color: #f9c20b;
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.3s;
        }
        .inicio-btn:hover {
            background-color: #001640;
        }
        .container {
            background: rgba(0, 36, 105, 0.9);
            padding: 30px;
            margin-top: 30px;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            font-size: 1.1rem;
        }
        input, select {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border-radius: 8px;
            border: none;
            font-size: 1rem;
        }
        input[type="submit"] {
            background-color: #f9c20b;
            color: #002469;
            font-weight: bold;
            margin-top: 20px;
            cursor: pointer;
            transition: background 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #ffd700;
        }
        table {
            margin-top: 40px;
            width: 90%;
            max-width: 700px;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #f9c20b;
        }
        th {
            background-color: #f9c20b;
            color: #002469;
        }
        tr:nth-child(even) {
            background-color: rgba(255,255,255,0.1);
        }
        tr:hover {
            background-color: rgba(255,255,255,0.2);
        }
    </style>
</head>
<body>

<header>
    <a href="index.html" class="inicio-btn"> Inicio</a>
    TIGRES UANL - Registro de Jugadores
</header>
<div class="container">
    <form method="POST">
        <label>Nombre del jugador:</label>
        <input type="text" name="jugador" required placeholder="">
        <label>Campeonatos ganados:</label>
        <input type="text" name="campeonatos" required placeholder="">
        <label>Posición:</label>
        <input type="text" name="posicion" required placeholder="">
        <label>Edad:</label>
        <input type="text" name="edad" required placeholder="">
        <label>Dorsal:</label>
        <input type="text" name="dorsal" required placeholder="">
        <input type="submit" value="Registrar Jugador">
    </form>
</div>
<table>
    <tr>
        <th>Jugador</th>
        <th>Campeonatos</th>
        <th>Posición</th>
        <th>Edad</th>
        <th>Dorsal</th>
    </tr>
    <?php
    $sql = "SELECT * FROM tigres";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        while ($fila = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$fila['jugadores']}</td>
                    <td>{$fila['campeonatos']}</td>
                    <td>{$fila['posicion']}</td>
                    <td>{$fila['edad']}</td>
                    <td>{$fila['dorsal']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No hay jugadores registrados</td></tr>";
    }

    $conexion->close();
    ?>
</table>

</body>
</html>
