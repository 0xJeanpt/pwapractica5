<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}

$rol = $_SESSION["user"]["rol_id"];

switch ($rol) {
    case 1:
        header("Location: ../roles/admin.php");
        break;
    case 2:
        header("Location: ../roles/gerente.php");
        break;
    case 3:
        header("Location: ../roles/miembro.php");
        break;
    default:
        echo "Rol desconocido.";
        session_destroy();
}
