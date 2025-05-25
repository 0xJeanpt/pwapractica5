<?php
session_start();
if ($_SESSION["user"]["rol_id"] != 3) { echo "Acceso denegado"; exit(); }
require_once("../config/db.php");
$id_miembro = $_SESSION["user"]["id"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $estado = $_POST["estado"];
    $id_tarea = $_POST["tarea_id"];
    $stmt = $conn->prepare("UPDATE tareas SET estado=? WHERE id=? AND usuario_id=?");
    $stmt->bind_param("sii", $estado, $id_tarea, $id_miembro);
    $stmt->execute();
}
$res = $conn->query("SELECT * FROM tareas WHERE usuario_id = $id_miembro");
while ($t = $res->fetch_assoc()) {
    echo $t["titulo"] . " - Estado: " . $t["estado"] . "<br>";
}
?>
<form method="POST">
  <input name="tarea_id" placeholder="ID Tarea">
  <select name="estado">
    <option>Pendiente</option>
    <option>En proceso</option>
    <option>Completado</option>
  </select>
  <button type="submit">Actualizar Estado</button>
</form>

<?php