<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego - Piedra, Papel, Tijera, Spock, Lagarto</title>
    <link rel="stylesheet" href="../css/game.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
</head>
<body>
    <div id="particles-js"></div>
    <div class="container">
        <?php
        // Opciones disponibles para el juego
        $options = ['Piedra', 'Papel', 'Tijera', 'Spock', 'Lagarto'];

        // Reglas del juego
        $rules = [
            'Piedra' => ['Tijera', 'Lagarto'],
            'Papel' => ['Piedra', 'Spock'],
            'Tijera' => ['Papel', 'Lagarto'],
            'Spock' => ['Tijera', 'Piedra'],
            'Lagarto' => ['Papel', 'Spock']
        ];

        // Declaro variables para controlar el funcionamiento del juego
        $mostrar = false; // Indica si se muestra los resultados
        $iaChoice = ''; // Almacenar la elección de la IA
        $result = ''; // Almacenar el resultado del juego

        // Comprobar si se envia correctamente la opcion escogida por el usuario
        if (isset($_REQUEST['optionIcon'])) {
            $userChoice = $_REQUEST['optionIcon']; // ALmacenar la elección del usuario

            // Si no se ha mostrado el resultado, entonces la IA genera una opción al azar
            if (!$mostrar) {
                $iaChoice = $options[array_rand($options)];
            }

            // Determinar el resultado del juego
            if ($userChoice === $iaChoice) {
                // Si son iguales, empate
                $result = "¡Empate! Ambos eligieron $userChoice.";
            } elseif (in_array($iaChoice, $rules[$userChoice])) {
                // Si pierde la IA, ganas
                $result = "¡Ganaste! La IA ha escogido " . $iaChoice;
            } else {
                // Sino gana la IA
                $result = "Perdiste... La IA ha escogido " . $iaChoice;
            }

            // Cambiar estado para mostrar los resultados
            $mostrar = true;
        }

        // Mostrar la interfaz del juego si no se ha mostrado los resultados
        if (!$mostrar) {
            ?>
            <h1 class="game-title">¡Comienza el Juego!</h1>
            <p>- Escoge sabiamente tú decisión -</p>
            <form action="game.php" method="GET" class="game-options">
                <button class="game-icon-option" name="optionIcon" value="Piedra"><img class="icon-game" src="../img/piedra.png" alt="Piedra"/></button>
                <button class="game-icon-option" name="optionIcon" value="Papel"><img class="icon-game" src="../img/papel.png" alt="Papel"/></button>
                <button class="game-icon-option" name="optionIcon" value="Tijera"><img class="icon-game" src="../img/tijera.png" alt="Tijera"/></button>
                <button class="game-icon-option" name="optionIcon" value="Spock"><img class="icon-game" src="../img/spock.png" alt="Spock"/></button>
                <button class="game-icon-option" name="optionIcon" value="Lagarto"><img class="icon-game" src="../img/lagarto.png" alt="Lagarto"/></button>
            </form>
            <?php
        } else {
            // Si se muestra los resultados, crear un formulario tipo 'hidden'
            // para enviar los datos al data.php, tal como enseñaste en clase en la
            // correción del numMagic.php
            ?>
            <form action="data.php" method="POST" class="game-options" id="resultForm">
                <input type="hidden" name="userChoice" value="<?php echo htmlspecialchars($userChoice); ?>">
                <input type="hidden" name="iaChoice" value="<?php echo htmlspecialchars($iaChoice); ?>">
                <input type="hidden" name="result" value="<?php echo htmlspecialchars($result); ?>">
            </form>

            <script>
                // Enviar automáticamente el formulario al mostrar el resultado
                document.getElementById('resultForm').submit();
            </script>
            <?php
        }
        ?>
    </div>

    <script defer src="../js/animations.js"></script>
    <script defer src="../js/particles-config.js"></script>
</body>
</html>
