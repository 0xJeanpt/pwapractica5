<?php
session_start();
if ($_SESSION["user"]["rol_id"] != 2) { echo "Acceso denegado"; exit(); }
require_once("../config/db.php");
$id_gerente = $_SESSION["user"]["id"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $desc = $_POST["descripcion"];
    $usuario_id = $_POST["usuario_id"];
    $stmt = $conn->prepare("INSERT INTO tareas (titulo, descripcion, usuario_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $titulo, $desc, $usuario_id);
    $stmt->execute();
}
?>
<form method="POST">
  <input name="titulo" required placeholder="Título">
  <textarea name="descripcion" placeholder="Descripción"></textarea>
  <input name="usuario_id" required placeholder="ID Miembro">
  <button type="submit">Crear Tarea</button>
</form>

<?php