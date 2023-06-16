<!DOCTYPE html>
<html>
<head>
<title>Consulta de Usuarios</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "curso";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
      die("Error al conectar a la base de datos: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM usuarios";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      echo "<h2>Datos de los Usuarios Registrados:</h2>";
      echo "<table>";
      echo "<tr><th>Nombre</th><th>Primer Apellido</th><th>Segundo Apellido</th><th>Email</th><th>Login</th><th>Password</th></tr>";
      while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["nombre"] . "</td>";
          echo "<td>" . $row["apellido1"] . "</td>";
          echo "<td>" . $row["apellido2"] . "</td>";
          echo "<td>" . $row["email"] . "</td>";
          echo "<td>" . $row["login"] . "</td>";
          echo "<td>*****</td>"; 
          echo "</tr>";
      }
      echo "</table>";
  } else {
      echo "No se encontraron datos de usuarios registrados.";
  }

  $conn->close();
  ?>
</body>
</html>
