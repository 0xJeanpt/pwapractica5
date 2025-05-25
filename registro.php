<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
  <link rel="stylesheet" href="../css/estilos.css">
  <script src="../js/validaciones.js" defer></script>
</head>
<body>
  <form method="POST" onsubmit="return validarRegistro()">
    <input type="text" name="nombre" id="nombre" required placeholder="Nombre">
    <input type="email" name="email" id="email" required placeholder="Correo">
    <input type="password" name="password" id="password" required placeholder="Contraseña">
    <select name="rol_id" id="rol_id">
      <option value="1">Administrador</option>
      <option value="2">Gerente</option>
      <option value="3">Miembro</option>
    </select>
    <button type="submit">Registrar</button>
  </form>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("../config/db.php");
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $rol_id = $_POST["rol_id"];

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, contraseña, rol_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $nombre, $email, $password, $rol_id);
    if ($stmt->execute()) {
        echo "<p>Usuario registrado correctamente.</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>

<?php