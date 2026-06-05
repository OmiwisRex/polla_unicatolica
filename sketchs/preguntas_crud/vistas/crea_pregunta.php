<?php
include("../utils/conexion.php");
$is_editar = isset($_GET['id']);

$pregunta['id'] = 0;
$pregunta['enunciado'] = "";
$pregunta['correcta'] = "";
$pregunta['falsa1'] = "";
$pregunta['falsa2'] = "";
$pregunta['falsa3'] = "";

if ($is_editar) {
    $sql = "SELECT * FROM preguntas WHERE id = ?";
    $res = doQuery($sql, [$_GET['id']]);
    if (count($res[1]) == 1) {
        $pregunta = $res[1][0];
    }
    else {
        $is_editar = False;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas Unicatólica</title>
    <title>
        <?php echo $is_editar ? "Nueva pregunta" : "Editar pregunta"; ?>
    </title>
    <link rel="stylesheet" href="../estilos/interno.css">
</head>

<body>

    <header class="header">
        <div class="header-titulo">
            <?php echo $is_editar ? "Editar " : "Crear "; ?>pregunta
        </div>

        <div class="header-centro">
            escriba una pregunta de opción múltiple
        </div>

        <div class="header-derecha">
            <a href="preguntas.php" class="btn-volver">Volver</a>
        </div>
    </header>

    <div class="contenedor-formulario">
        <div class="card-formulario">

            <h2><?php echo $is_editar ? "Editar pregunta" : "Nueva pregunta"; ?></h2>

            <form action="../controladores/preguntas.php" method="POST">

                <input type="hidden" name="id" value="<?php echo $pregunta['id']; ?>">

                <div class="grupo-form">
                    <label>Enunciado</label>
                    <textarea name="enunciado" required><?php echo $pregunta['enunciado']; ?></textarea>
                </div>

                <div class="grupo-form">
                    <label>Respuesta Correcta</label>
                    <textarea name="correcta" required><?php echo $pregunta['correcta']; ?></textarea>
                </div>

                <div class="grupo-form">
                    <label>Respuesta Falsa 1</label>
                    <textarea name="falsa1" required><?php echo $pregunta['falsa1']; ?></textarea>
                </div>

                <div class="grupo-form">
                    <label>Respuesta Falsa 2</label>
                    <textarea name="falsa2" required><?php echo $pregunta['falsa2']; ?></textarea>
                </div>

                <div class="grupo-form">
                    <label>Respuesta Falsa 3</label>
                    <textarea name="falsa3" required><?php echo $pregunta['falsa3']; ?></textarea>
                </div>

                <div class="acciones-form">
                    <a href="preguntas.php" class="btn-volver">Volver</a>

                    <button type="submit" class="btn-guardar">
                        <?php echo $is_editar ? "Guardar Cambios" : "Crear pregunta"; ?>
                    </button>
                </div>

            </form>

        </div>
    </div>

</body>
</html>