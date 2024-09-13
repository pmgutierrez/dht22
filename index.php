<?php

  
    $servername = "localhost";
    $username = "root"; // Cambia esto  si tu usuario es diferente
    $password = "qwerty123"; // Cambia esto si tienes una contraseña para MySQL
    $dbname = "sensores";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Crear tabla si no existe
    $sql = "CREATE TABLE IF NOT EXISTS lecturas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        temperatura FLOAT NOT NULL,
        humedad FLOAT NOT NULL,
        fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    if ($conn->query($sql) === FALSE) {
        echo "Error creando tabla: " . $conn->error;
    }
//*************************************************************************************************
    // Obtener datos de la solicitud (ajusta los nombres de los parámetros según corresponda)
    $temperatura = isset($_GET['Temp']) ? $_GET['Temp'] : 0;
    $humedad = isset($_GET['Hum']) ? $_GET['Hum'] : 0;

    // Insertar datos en la tabla
    $sql = "INSERT INTO lecturas (temperatura, humedad) VALUES ($temperatura, $humedad)";
    if ($conn->query($sql) === FALSE) {
        echo "Error insertando datos: " . $conn->error;
    }


    // Consultar los datos para mostrarlos (puedes ajustar la consulta según tus necesidades)
    $sql = "SELECT temperatura, humedad FROM lecturas ORDER BY id DESC LIMIT 5";
    // $sql = "SELECT * FROM lecturas";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mostrar los datos
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"]. " - Temp: " . $row["temperatura"]. " - Hum: " . $row["humedad"]. " - Fecha: " . $row["fecha"]. "<br>";

            $temperatura3 = $row["temperatura"];
            $humedad3 = $row["humedad"];
        }    
    } else {
        echo "0 resultados";
    }

        // Cerrar conexión
        $conn->close();


//<!doctype html>
echo "<html lang='es'>";
echo "  <head>";
echo "      <meta charset='utf-8' />";
echo "      <meta http-equiv='refresh' content='10' />";
echo "      <meta name='viewport' content='width=device-width, initial-scale=1' />";
echo "      <title>Servicio Meteorologico</title>";
echo "  </head>";
echo "  <style>";
echo "    h1 {";    
echo "       color: antiquewhite;";
echo "       background-color: dodgerblue;";
echo "       text-align: center;";
echo "       font-family: sans-serif;";
echo "       width: 600px;";
echo "       margin-left: 10px;";
echo "       padding:5px;";
echo "       border-radius: 15px;";
echo "        }";
echo "    div{";
echo "      color: white;";
echo "      background-color: darkred;";
echo "      font-family: monospace;";
echo "      width: 450px;";
echo "      text-align: center;";
echo "      font-size: 12px;";
echo "      margin-left: 50px;";
echo "      padding: 5px;";
echo "      border-radius: 15px;";
echo "      }";
echo "  </style>";
echo "<body>";
echo "    <header>";
echo "        <h1>BIENVENIDOS AL SERVIDOR LOCAL</h1>";    
echo "    </header>";
echo "    <section>";
echo "        <div>";
echo "            <h3>Temperatura: $temperatura3 °C</h3>";
echo "            <h3>Humedad: $humedad3 %</h3>        ";
echo "        </div>";
echo "     </section>";
echo "</body>";
echo "</html>";

?>