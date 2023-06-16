<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    header('Content-Type: text/html; charset=UTF-8');
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "curso";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error al conectar a la base de datos: " . $conn->connect_error);
    }

    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("El correo electrónico no es válido. Por favor, vuelve a intentarlo.");
    }

    if (mb_strlen($password) < 4 || mb_strlen($password) > 8) {
        die("La contraseña debe tener entre 4 y 8 caracteres.");
    }

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        die("El correo electrónico ya está registrado. Por favor, utiliza otro correo electrónico.");
    }

    $sql = "INSERT INTO usuarios (nombre, apellido1, apellido2, email, login, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nombre, $apellido1, $apellido2, $email, $login, $password);

    if ($stmt->execute()) {
        echo "Registro completado con éxito.<br>";
        echo '<a href="consulta.php">Consulta</a>'; 
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    ?>
</body>
</html>