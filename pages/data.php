<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link rel="stylesheet" href="../css/data.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
</head>

<body>
    <div id="particles-js"></div>

    <div class="game-container">
        <?php
        // Archivo para almacenar las estadisticas
        $statsFile = 'stats.txt';

        $userChoicesCount = [
            'Piedra' => 0,
            'Papel' => 0,
            'Tijera' => 0,
            'Lagarto' => 0,
            'Spock' => 0
        ];

        $iaChoicesCount = $userChoicesCount;
        $totalGames = 0;

        $images = [
            'Piedra' => '../img/piedra.png',
            'Papel' => '../img/papel.png',
            'Tijera' => '../img/tijera.png',
            'Lagarto' => '../img/lagarto.png',
            'Spock' => '../img/spock.png',
        ];

        // Verificar si el archivo existe
        if (file_exists($statsFile)) {
            // Leer y decodificar las estadísticas guardadas
            $stats = json_decode(file_get_contents($statsFile), true);
            if ($stats) {
                // Si existen datos, actualizar los contandores con los valores guardados
                $userChoicesCount = $stats['userChoicesCount'];
                $iaChoicesCount = $stats['iaChoicesCount'];
                $totalGames = $stats['totalGames'];
            }
        }

        // Verificar si se clica en "Borrar historial"
        if (isset($_POST['clear_stats'])) {
            // Vaciar las estadísticas y reiniciar los valores
            $userChoicesCount = [
                'Piedra' => 0,
                'Papel' => 0,
                'Tijera' => 0,
                'Lagarto' => 0,
                'Spock' => 0
            ];
            $iaChoicesCount = $userChoicesCount;
            $totalGames = 0;

            // Guardar las estadísticas en el archivo
            $clearedStats = [
                'userChoicesCount' => $userChoicesCount,
                'iaChoicesCount' => $iaChoicesCount,
                'totalGames' => $totalGames
            ];

            file_put_contents($statsFile, json_encode($clearedStats));
            header('location: game.php');
        }

        // Comprobar si se ha recibido el formulario oculto del game.php con los datos
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recoger los datos del formulario
            $userChoice = $_POST['userChoice'] ?? '';
            $iaChoice = $_POST['iaChoice'] ?? '';
            $result = $_POST['result'] ?? '';

            // Actualizar el contador de elecciones del usuario
            if ($userChoice !== '' && isset($userChoicesCount[$userChoice])) {
                $userChoicesCount[$userChoice]++;
            }

            // Actualizar el contador de elecciones de la IA
            if ($iaChoice !== '' && isset($iaChoicesCount[$iaChoice])) {
                $iaChoicesCount[$iaChoice]++;
            }

            $totalGames++;

            // Preparar los datos actualizados para guardarlos en el archivo
            $updatedStats = [
                'userChoicesCount' => $userChoicesCount,
                'iaChoicesCount' => $iaChoicesCount,
                'totalGames' => $totalGames
            ];

            // Guardar las estadísticas en el archivo
            file_put_contents($statsFile, json_encode($updatedStats));

            // Funcion para calcular el porcentaje
            function calculatePercentage($count, $total)
            {
                return $total > 0 ? round(($count / $total) * 100, 2) : 0;
            }

            ?>
            <div class="result">
                <h1>Resultados del Juego</h1>
                <!-- Mostrar la eleccion del usuario -->
                <div class="choice">
                    <p>Elección del usuario:</p>
                    <img src="<?= isset($images[$userChoice]) ? $images[$userChoice] : '' ?>"
                        alt="<?= htmlspecialchars($userChoice) ?>" class="icon-game">
                    <p><?= htmlspecialchars($userChoice) ?></p>
                </div>

                <!-- Mostrar la eleccion de la IA -->
                <div class="choice">
                    <p>Elección de la IA:</p>
                    <img src="<?= isset($images[$iaChoice]) ? $images[$iaChoice] : '' ?>"
                        alt="<?= htmlspecialchars($iaChoice) ?>" class="icon-game">
                    <p><?= htmlspecialchars($iaChoice) ?></p>
                </div>

                <!-- Mostrar el resultado del juego -->
                <div class="result-message">
                    <p><?= htmlspecialchars($result) ?></p>
                </div>
            </div>

            <button class="back-button" onclick="window.location.href='game.php'">Volver a jugar</button>
            <button class="index-button" onclick="window.location.href='../index.html'">Inicio</button>

            <div class="stats-container">
                <h2>Estadísticas del Usuario</h2>
                <div class="stats">
                    <?php foreach ($userChoicesCount as $choice => $count): ?>
                        <?php $percentage = $totalGames > 0 ? round(($count / $totalGames) * 100, 2) : 0; ?>
                        <div class="stats-info">
                            <p><?= $percentage ?>% de las jugadas han sido <?= $choice ?>
                                <img src="<?= $images[$choice] ?>" alt="<?= htmlspecialchars($choice) ?>" class="icon-game">
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <h2>Estadísticas de la IA</h2>
                <div class="stats">
                    <div class="stats-info">
                    <?php foreach ($iaChoicesCount as $choice => $count): ?>
                        <?php $percentage = $totalGames > 0 ? round(($count / $totalGames) * 100, 2) : 0; ?>
                            <p><?= $percentage ?>% de las jugadas han sido <?= $choice ?>
                                <img src="<?= $images[$choice] ?>" alt="<?= htmlspecialchars($choice) ?>" class="icon-game">
                            </p>
                    <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <form method="POST">
                <button type="submit" name="clear_stats" class="clear-button">
                    Borrar historial
                </button>
            </form>
            <?php
        }
        ?>
    </div>

    <script defer src="../js/animations.js"></script>
    <script defer src="../js/particles-config.js"></script>
</body>

</html>