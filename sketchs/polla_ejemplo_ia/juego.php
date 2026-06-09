<?php
// Datos quemados de partidos del mundial 2026
$partidos = [
    // Grupo A
    ['id' => 1, 'etapa' => 'grupos', 'equipo1' => 'Argentina', 'flag1' => '🇦🇷', 'equipo2' => 'Paraguay', 'flag2' => '🇵🇾', 'fecha' => '2026-06-15', 'hora' => '14:00', 'goles1_apostado' => 2, 'goles2_apostado' => 1, 'goles1_real' => 2, 'goles2_real' => 1, 'conocidos' => true],
    ['id' => 2, 'etapa' => 'grupos', 'equipo1' => 'Francia', 'flag1' => '🇫🇷', 'equipo2' => 'Italia', 'flag2' => '🇮🇹', 'fecha' => '2026-06-15', 'hora' => '16:30', 'goles1_apostado' => null, 'goles2_apostado' => null, 'goles1_real' => null, 'goles2_real' => null, 'conocidos' => true],
    ['id' => 3, 'etapa' => 'grupos', 'equipo1' => 'Alemania', 'flag1' => '🇩🇪', 'equipo2' => 'México', 'flag2' => '🇲🇽', 'fecha' => '2026-06-16', 'hora' => '10:00', 'goles1_apostado' => 1, 'goles2_apostado' => 2, 'goles1_real' => null, 'goles2_real' => null, 'conocidos' => true],
    ['id' => 4, 'etapa' => 'grupos', 'equipo1' => 'Brasil', 'flag1' => '🇧🇷', 'equipo2' => 'Canadá', 'flag2' => '🇨🇦', 'fecha' => '2026-06-16', 'hora' => '13:00', 'goles1_apostado' => 3, 'goles2_apostado' => 0, 'goles1_real' => null, 'goles2_real' => null, 'conocidos' => true],
    ['id' => 5, 'etapa' => 'grupos', 'equipo1' => 'España', 'flag1' => '🇪🇸', 'equipo2' => 'Portugal', 'flag2' => '🇵🇹', 'fecha' => '2026-07-01', 'hora' => '15:00', 'goles1_apostado' => null, 'goles2_apostado' => null, 'goles1_real' => null, 'goles2_real' => null, 'conocidos' => true],
    ['id' => 6, 'etapa' => 'grupos', 'equipo1' => 'Holanda', 'flag1' => '🇳🇱', 'equipo2' => 'Bélgica', 'flag2' => '🇧🇪', 'fecha' => '2026-07-01', 'hora' => '17:30', 'goles1_apostado' => null, 'goles2_apostado' => null, 'goles1_real' => null, 'goles2_real' => null, 'conocidos' => true],
    
    // Dieciseisavos
    ['id' => 7, 'etapa' => 'dieciseisavos', 'equipo1' => 'Argentina', 'flag1' => '🇦🇷', 'equipo2' => 'Francia', 'flag2' => '🇫🇷', 'fecha' => '2026-07-08', 'hora' => '14:00', 'goles1_apostado' => null, 'goles2_apostado' => null, 'goles1_real' => null, 'goles2_real' => null, 'conocidos' => true],
    ['id' => 8, 'etapa' => 'dieciseisavos', 'equipo1' => 'Alemania', 'flag1' => '🇩🇪', 'equipo2' => 'Brasil', 'flag2' => '🇧🇷', 'fecha' => '2026-07-08', 'hora' => '16:30', 'goles1_apostado' => null, 'goles2_apostado' => null, 'goles1_real' => null, 'goles2_real' => null, 'conocidos' => true],
    ['id' => 9, 'etapa' => 'dieciseisavos', 'equipo1' => 'España', 'flag1' => '🇪🇸', 'equipo2' => 'Holanda', 'flag2' => '🇳🇱', 'fecha' => '2026-07-09', 'hora' => '14:00', 'goles1_apostado' => null, 'goles2_apostado' => null, 'goles1_real' => null, 'goles2_real' => null, 'conocidos' => true],
    
    // Octavos
    ['id' => 10, 'etapa' => 'octavos', 'equipo1' => null, 'flag1' => '❓', 'equipo2' => null, 'flag2' => '❓', 'fecha' => '2026-07-15', 'hora' => '14:00', 'goles1_apostado' => null, 'goles2_apostado' => null, 'goles1_real' => null, 'goles2_real' => null, 'conocidos' => false],
    ['id' => 11, 'etapa' => 'octavos', 'equipo1' => null, 'flag1' => '❓', 'equipo2' => null, 'flag2' => '❓', 'fecha' => '2026-07-16', 'hora' => '14:00', 'goles1_apostado' => null, 'goles2_apostado' => null, 'goles1_real' => null, 'goles2_real' => null, 'conocidos' => false],
    
    // Cuartos
    ['id' => 12, 'etapa' => 'cuartos', 'equipo1' => null, 'flag1' => '❓', 'equipo2' => null, 'flag2' => '❓', 'fecha' => '2026-07-22', 'hora' => '14:00', 'goles1_apostado' => null, 'goles2_apostado' => null, 'goles1_real' => null, 'goles2_real' => null, 'conocidos' => false],
    ['id' => 13, 'etapa' => 'cuartos', 'equipo1' => null, 'flag1' => '❓', 'equipo2' => null, 'flag2' => '❓', 'fecha' => '2026-07-22', 'hora' => '16:30', 'goles1_apostado' => null, 'goles2_apostado' => null, 'goles1_real' => null, 'goles2_real' => null, 'conocidos' => false],
    
    // Semifinales
    ['id' => 14, 'etapa' => 'semifinal', 'equipo1' => null, 'flag1' => '❓', 'equipo2' => null, 'flag2' => '❓', 'fecha' => '2026-07-28', 'hora' => '14:00', 'goles1_apostado' => null, 'goles2_apostado' => null, 'goles1_real' => null, 'goles2_real' => null, 'conocidos' => false],
    ['id' => 15, 'etapa' => 'semifinal', 'equipo1' => null, 'flag1' => '❓', 'equipo2' => null, 'flag2' => '❓', 'fecha' => '2026-07-29', 'hora' => '14:00', 'goles1_apostado' => null, 'goles2_apostado' => null, 'goles1_real' => null, 'goles2_real' => null, 'conocidos' => false],
    
    // Tercer lugar
    ['id' => 16, 'etapa' => 'tercer', 'equipo1' => null, 'flag1' => '❓', 'equipo2' => null, 'flag2' => '❓', 'fecha' => '2026-08-01', 'hora' => '14:00', 'goles1_apostado' => null, 'goles2_apostado' => null, 'goles1_real' => null, 'goles2_real' => null, 'conocidos' => false],
    
    // Final
    ['id' => 17, 'etapa' => 'final', 'equipo1' => null, 'flag1' => '❓', 'equipo2' => null, 'flag2' => '❓', 'fecha' => '2026-08-02', 'hora' => '17:00', 'goles1_apostado' => null, 'goles2_apostado' => null, 'goles1_real' => null, 'goles2_real' => null, 'conocidos' => false],
];

// Obtener etapa seleccionada
$etapa_filtro = isset($_GET['etapa']) ? $_GET['etapa'] : 'grupos';

// Filtrar partidos
$partidos_filtrados = array_filter($partidos, function($p) use ($etapa_filtro) {
    return $p['etapa'] === $etapa_filtro;
});

// Función para obtener etiqueta HTML
function getTag($etapa) {
    $tags = [
        'grupos' => 'Grupos',
        'dieciseisavos' => 'Dieciseisavos',
        'octavos' => 'Octavos',
        'cuartos' => 'Cuartos',
        'semifinal' => 'Semifinal',
        'tercer' => 'Tercer Lugar',
        'final' => 'Final'
    ];
    return $tags[$etapa] ?? $etapa;
}

// Función para verificar si un partido ya pasó
function partidos_pasado($fecha, $hora) {
    $ahora = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
    $fecha_partido = DateTime::createFromFormat('Y-m-d H:i', $fecha . ' ' . $hora, new DateTimeZone('America/Argentina/Buenos_Aires'));
    return $ahora > $fecha_partido;
}

// Función para saber si puede apostarse
function puede_apostarse($partido) {
    if (!$partido['conocidos']) {
        return false; // Equipos aún no definidos
    }
    if ($partido['goles1_apostado'] !== null) {
        return false; // Ya hay un intento
    }
    if (partidos_pasado($partido['fecha'], $partido['hora'])) {
        return false; // Ya pasó la fecha
    }
    return true;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polla Mundial 2026 - Juego</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <header>
        <div class="header-content">
            <div>
                <div class="logo">🏆 POLLA MUNDIAL 2026</div>
                <div class="logo-subtitle">sistema de predicción</div>
            </div>
            <div style="font-size: 18px; color: #d4af37;">⚽</div>
        </div>
    </header>

    <div class="container">
        <h1 class="page-title">Realizar Predicciónes</h1>

        <div class="controls controlmax">
            <label for="filtro-etapa">Filtrar por etapa:</label>
            <select id="filtro-etapa" onchange="location.href='juego.php?etapa=' + this.value;">
                <option value="grupos" <?= $etapa_filtro === 'grupos' ? 'selected' : '' ?>>Grupos</option>
                <option value="dieciseisavos" <?= $etapa_filtro === 'dieciseisavos' ? 'selected' : '' ?>>Dieciseisavos</option>
                <option value="octavos" <?= $etapa_filtro === 'octavos' ? 'selected' : '' ?>>Octavos</option>
                <option value="cuartos" <?= $etapa_filtro === 'cuartos' ? 'selected' : '' ?>>Cuartos</option>
                <option value="semifinal" <?= $etapa_filtro === 'semifinal' ? 'selected' : '' ?>>Semifinal</option>
                <option value="tercer" <?= $etapa_filtro === 'tercer' ? 'selected' : '' ?>>Tercer Lugar</option>
                <option value="final" <?= $etapa_filtro === 'final' ? 'selected' : '' ?>>Final</option>
            </select>
        </div>

        <?php if (empty($partidos_filtrados)): ?>
            <div class="no-data">No hay partidos en esta etapa</div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Etapa</th>
                        <th>Equipos</th>
                        <th>Fecha y Hora</th>
                        <th>Tu Adivinación</th>
                        <th>Resultado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($partidos_filtrados as $partido): ?>
                        <tr>
                            <td>
                                <span class="tag tag-<?= $partido['etapa'] ?>">
                                    <?= getTag($partido['etapa']) ?>
                                </span>
                            </td>
                            <td>
                                <div class="team-name">
                                    <span class="flag"><?= $partido['flag1'] ?></span>
                                    <strong><?= $partido['equipo1'] ?? 'Por definir' ?></strong>
                                    <span style="color: #888; margin: 0 8px;">vs</span>
                                    <strong><?= $partido['equipo2'] ?? 'Por definir' ?></strong>
                                    <span class="flag"><?= $partido['flag2'] ?></span>
                                </div>
                            </td>
                            <td>
                                <div class="datetime-info <?= partidos_pasado($partido['fecha'], $partido['hora']) ? 'datetime-passed' : 'datetime-soon' ?>">
                                    📅 <?= date('d/m/Y', strtotime($partido['fecha'])) ?><br>
                                    🕐 <?= $partido['hora'] ?>
                                </div>
                            </td>
                            <td>
                                <?php if ($partido['goles1_apostado'] !== null): ?>
                                    <div class="resultado-item resultado-apostado">
                                        <?= $partido['goles1_apostado'] ?> - <?= $partido['goles2_apostado'] ?>
                                    </div>
                                <?php else: ?>
                                    <span style="color: #888;">Sin adivinación</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($partido['goles1_real'] !== null): ?>
                                    <div class="resultado-item resultado-real">
                                        <?= $partido['goles1_real'] ?> - <?= $partido['goles2_real'] ?>
                                    </div>
                                <?php else: ?>
                                    <span style="color: #888;">Pendiente</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                    $puede_apostar = puede_apostarse($partido);
                                    $razon_deshabilitado = '';
                                    
                                    if (!$partido['conocidos']) {
                                        $razon_deshabilitado = 'Equipos sin definir';
                                    } elseif ($partido['goles1_apostado'] !== null) {
                                        $razon_deshabilitado = 'Ya apostaste';
                                    } elseif (partidos_pasado($partido['fecha'], $partido['hora'])) {
                                        $razon_deshabilitado = 'Partido cerrado';
                                    }
                                ?>
                                <button class="btn btn-primary" 
                                    <?= !$puede_apostar ? 'disabled title="' . $razon_deshabilitado . '"' : '' ?>>
                                    Apostar
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <div style="text-align: center;">
            <a href="puntos.php" class="btn btn-secondary btn-nav">Ver Clasificación</a>
        </div>
    </div>
</body>
</html>

