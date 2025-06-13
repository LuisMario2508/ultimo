<?php
   $username = "root";
   $password = "";
   $servername = "localhost";
   $database = "kzhl";

   $conexion = new mysqli( $servername,$username, $password, $database);
   if ($conexion->connect_error) {
       die("Conexion Fallida: " . $conexion->connect_error);
   }
//estas lineas van a analizar si el formulario ya ha sido enviado
   if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $id_categoria = $_POST["categoria"];
    $sql = "INSERT INTO productos (nombre, precio, id_categoria) VALUES ('$nombre', '$precio', '$id_categoria')";
    if ($conexion->query($sql)===TRUE){
        echo "<p style='color: green';>Producto agregado correctamente</p>";
    }else{
        echo "<p style='color: red';>Error:" . $conexion->error . "</p>;";
    }
   }
   //obtener categorias para sacar info de la basede datos para dropdown con la info que se solicita, eso es lo que nos hace falta en la pagina anterior.
   $sql_categorias = "SELECT * FROM categorias"; //categorias es una tabla que hare despues
   $resul_categorias = $conexion->query ($sql_categorias);
?>

<html>
    <head>
        <title>Pagina alterna de prueba</title>
    </head>
    <body>
    <link href="https://fonts.cdnfonts.com/css/apes-on-parade" rel="stylesheet"> 

    <style>
        .container1{
                    margin: 0 auto;
                    justify-content: center;
                    align-items: center;
                    width: 50%;
                    background-color:rgba(13, 142, 178, 0.58);
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.2);
                    color: black;
                }
        h1{
                    font-family:'Apes On Parade', sans-serif;
                    text-align: center;
                    color: #0d8eb2;
                    margin-bottom: 15px;  
                } 
                h2{
                    font-family:'Apes On Parade', sans-serif;
                    text-align: center;
                    color: white;
                    margin-bottom: 15px; 
                }
                input[type= "text"] {
                    padding: 8px;
                    margin-bottom: 10px;
                    border: none;
                    border-radius: 5px;
                    font-size: 16px;
                    background-color: white;
                    color: black;
                }
                input [type="submit"]{
                    padding: 10px;
                    background-color: skyblue;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: background 0.3s;
                }
                input[type="submit"]: hover {
                    background-color: white;
                }
                
                table{
                            width:100%;
                            border-collapse: collapse;
                            margin-top: 50px;
                            border-radius: 50px;
                        }
                        th, td{
                            padding: 10px;
                            text-align:left;
                            border-bottom: 1px solid #ddd;
                        }
                        tr:nth-child(even){
                            background-color: white;
                            color: black;
                        }
                        tr:nth-child(odd){
                            background-color: #ffe4ec;
                            color: black;
                        }
                        th{
                            background-color: pink; <!-- ese es el color de antes 84c047-->
                            color: white;
                        }
    </style>

        <h1> Registrar productos</h1>
        <div class="container1">
        <form method="POST">
            <label>Nombre del producto: </label>
            <input type="text" name="nombre" required><br><br>
            <label>Precio: </label>
            <input type="number" name="precio" required><br><br>
            <label>Categoria: </label>
            <select name="categoria" required>
                <option value="">Seleccionar una categoria</option>
                <?php
                if($resul_categorias->num_rows > 0){
                    while($row = $resul_categorias-> fetch_assoc()){
                        echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
                    }
                }
                ?>
            </select><br><br>
            <input type="submit" value="Agregar producto">
        </form>
            </div>

        <h2>Lista de Productos</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Categoria</th>
            </tr>
            <?php
            $sql_productos = "SELECT productos.nombre, productos.precio, categorias.nombre AS categoria FROM productos JOIN categorias ON productos.id_categoria = categorias.id";
            $result_productos = $conexion->query($sql_productos);
            if($result_productos->num_rows>0){
                while($row = $result_productos->fetch_assoc()){
                    echo "<tr>
                    <th>{$row['nombre']}</th>
                    <th>{$row['precio']}</th>
                    <th>{$row['categoria']}</th>
                    </tr>";
                } 
            }else{
                echo "<tr><td>No hay productos resgistrados</td></tr>";
            }
            ?>
        </table>
    </body>
</html>