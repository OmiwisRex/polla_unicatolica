<?php
include("../utils/conexion.php");

$sql = "SELECT * FROM preguntas WHERE estado = 1";
$res = doQuery($sql)[1];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas Unicatólica</title>
    <link rel="stylesheet" href="../estilos/interno.css">
</head>

<body>

    <header class="header">
        <div class="header-titulo">
            Preguntas Unicatólica
        </div>

        <div class="header-centro">
            aquí se ven todas las preguntas
        </div>

        <div class="header-derecha">
            <?php echo count($res) . " preguntas"; ?>
        </div>
    </header>

    <div class="contenedor-principal">

        <main class="contenido">

            <div class="barra-superior">
                <a href="crea_pregunta.php" class="btn-crear">Nueva</a>
            </div>

            <table class="tabla">
                <thead>
                    <tr>
                        <th>Enunciado y Respuesta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    <?php for ($i = 0; $i < count($res); $i++) {
                        $pregunta = $res[$i];
                        echo "<tr>";
                            echo "<td><b>". $pregunta["enunciado"]. "</b><br>". $pregunta["correcta"] ."</td>";
                            echo "<td>";
                                echo "<a href='crea_pregunta.php?id=" .
                                    $pregunta["id"] . "' class='btn-editar'>Editar</a>";
                                echo "<label>...</label>";
                                echo "<a href='../controladores/preguntas.php?id=" . $pregunta["id"] . "&delete=1' class='btn-eliminar' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta pregunta?\");'>Eliminar</a>";
                            echo "</td>";
                        echo "</tr>";
                    }
                    ?>

                </tbody>

            </table>

        </main>

    </div>

</body>
</html>