<?php
session_start();
require_once("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $pass = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $user = $res->fetch_assoc();
        if (password_verify($pass, $user["contraseña"])) {
            $_SESSION["user"] = $user;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}
?>

<form method="POST">
    <input type="email" name="email" required placeholder="Correo"><br>
    <input type="password" name="password" required placeholder="Contraseña"><br>
    <button type="submit">Ingresar</button>
</form>
