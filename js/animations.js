document.addEventListener("DOMContentLoaded", () => {
    const startGameButton = document.querySelector('.start-game');

    startGameButton.addEventListener('click', () => {
        startGameButton.classList.add('clicked');
        startGameButton.style.transform = 'scale(0.95)';
        startGameButton.style.transition = 'transform 0.1s ease';

        setTimeout(() => {
            window.location.href = 'pages/game.php';
        }, 300);
    });
});
