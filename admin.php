<?php
session_start();
if ($_SESSION["user"]["rol_id"] != 1) { echo "Acceso denegado"; exit(); }
require_once("../config/db.php");
$result = $conn->query("SELECT * FROM usuarios");
while ($row = $result->fetch_assoc()) {
    echo $row["nombre"] . " - " . $row["email"] . " - Rol: " . $row["rol_id"] . "<br>";
}
