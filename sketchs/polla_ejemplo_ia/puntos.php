<?php
// Datos quemados de jugadores
$jugadores = [
    ['id' => 1, 'nombre' => 'Carlos Mendez', 'puntos' => 1850],
    ['id' => 2, 'nombre' => 'Ana García', 'puntos' => 1720],
    ['id' => 3, 'nombre' => 'Roberto Silva', 'puntos' => 1695],
    ['id' => 4, 'nombre' => 'Laura Fernández', 'puntos' => 1580],
    ['id' => 5, 'nombre' => 'Juan Pérez', 'puntos' => 1520],
    ['id' => 6, 'nombre' => 'María López', 'puntos' => 1450],
    ['id' => 7, 'nombre' => 'Diego Rodríguez', 'puntos' => 1380],
    ['id' => 8, 'nombre' => 'Sofía Martínez', 'puntos' => 1290],
    ['id' => 9, 'nombre' => 'Luis González', 'puntos' => 1210],
    ['id' => 10, 'nombre' => 'Valentina Torres', 'puntos' => 1095],
];

// Ordenar por puntos de mayor a menor
usort($jugadores, function($a, $b) {
    return $b['puntos'] - $a['puntos'];
});

// Seleccionar un jugador al azar como "actual" (logueado)
$jugador_actual_id = rand(1, count($jugadores));

// Determinar quién es el jugador actual en la lista ordenada
$posicion_actual = null;
foreach ($jugadores as $index => $jugador) {
    if ($jugador['id'] === $jugador_actual_id) {
        $posicion_actual = $index;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polla Mundial 2026 - Clasificación</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <header>
        <div class="header-content">
            <div>
                <div class="logo">🏆 POLLA MUNDIAL 2026</div>
                <div class="logo-subtitle">sistema de predicciónes</div>
            </div>
            <div style="font-size: 18px; color: #d4af37;">⚽</div>
        </div>
    </header>

    <div class="container">
        <h1 class="page-title">Clasificación de Jugadores</h1>

        <table>
            <thead>
                <tr>
                    <th>Puesto</th>
                    <th>Nombre del Jugador</th>
                    <th>Puntos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jugadores as $index => $jugador): 
                    $puesto = $index + 1;
                    $es_jugador_actual = ($jugador['id'] === $jugador_actual_id);
                    $clase_fila = $es_jugador_actual ? 'row-highlighted' : '';
                ?>
                    <tr class="<?= $clase_fila ?>">
                        <td>
                            <div class="ranking-position <?= $puesto <= 3 ? 'top-three' : '' ?> position-<?= $puesto ?>">
                                <?php if ($puesto === 1): ?>
                                    🥇
                                <?php elseif ($puesto === 2): ?>
                                    🥈
                                <?php elseif ($puesto === 3): ?>
                                    🥉
                                <?php else: ?>
                                    <?= $puesto ?>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            <strong style="<?= $es_jugador_actual ? 'color: #d4af37; text-shadow: 0 0 8px rgba(212, 175, 55, 0.5);' : '' ?>">
                                <?= $jugador['nombre'] ?>
                                <?php if ($es_jugador_actual): ?>
                                    <span style="color: #888; font-weight: normal;"> (Tú)</span>
                                <?php endif; ?>
                            </strong>
                        </td>
                        <td>
                            <div class="player-points">
                                <?= number_format($jugador['puntos'], 0, ',', '.') ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div style="text-align: center;">
            <a href="juego.php" class="btn btn-secondary btn-nav">Volver a Apostar</a>
        </div>
    </div>

    <script>
        // Script para mostrar en consola el jugador actual (demo)
        console.log('Jugador actual: <?= $jugadores[$posicion_actual]["nombre"] ?>');
        console.log('Puesto: <?= $posicion_actual + 1 ?>');
        console.log('Puntos: <?= $jugadores[$posicion_actual]["puntos"] ?>');
    </script>
</body>
</html>
