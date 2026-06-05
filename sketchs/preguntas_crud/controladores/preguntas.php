<?php
include("../utils/conexion.php");

if (isset($_GET['delete']) && isset($_GET['id'])) {
    $sql = "UPDATE preguntas SET estado = 2 WHERE id = ?";
    doQuery($sql, [$_GET['id']]);
}
else if ($_POST['id'] == 0) {
    $sql = "INSERT INTO preguntas (enunciado, correcta, falsa1, falsa2, falsa3) VALUES (?, ?, ?, ?, ?)";
    doQuery($sql, [$_POST['enunciado'], $_POST['correcta'], $_POST['falsa1'], $_POST['falsa2'], $_POST['falsa3']]);
}
else {
    $sql = "UPDATE preguntas SET enunciado = ?, correcta = ?, falsa1 = ?, falsa2 = ?, falsa3 = ? WHERE id = ?";
    doQuery($sql, [$_POST['enunciado'], $_POST['correcta'], $_POST['falsa1'], $_POST['falsa2'], $_POST['falsa3'], $_POST['id']]);
}

header("Location: ../vistas/preguntas.php");
exit();
?>