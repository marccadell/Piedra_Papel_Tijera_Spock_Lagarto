// Items y sus imágenes
const items = [
    { name: 'Piedra', img: 'img/piedra.png' },
    { name: 'Papel', img: 'img/papel.png' },
    { name: 'Tijera', img: 'img/tijera.png' },
    { name: 'Spock', img: 'img/spock.png' },
    { name: 'Lagarto', img: 'img/lagarto.png' }
];

// Reglas del juego
const rules = [
    { winner: 'Piedra', loser1: 'Tijera', action1: 'aplasta a', loser2: 'Lagarto', action2: 'aplasta a', imgWinner: 'img/piedra.png', imgLoser1: 'img/tijera.png', imgLoser2: 'img/lagarto.png' },
    { winner: 'Papel', loser1: 'Piedra', action1: 'cubre a', loser2: 'Spock', action2: 'desautoriza a', imgWinner: 'img/papel.png', imgLoser1: 'img/piedra.png', imgLoser2: 'img/spock.png' },
    { winner: 'Tijera', loser1: 'Papel', action1: 'corta a', loser2: 'Lagarto', action2: 'decapita a', imgWinner: 'img/tijera.png', imgLoser1: 'img/papel.png', imgLoser2: 'img/lagarto.png' },
    { winner: 'Spock', loser1: 'Piedra', action1: 'vaporiza a', loser2: 'Tijera', action2: 'rompe a', imgWinner: 'img/spock.png', imgLoser1: 'img/piedra.png', imgLoser2: 'img/tijera.png' },
    { winner: 'Lagarto', loser1: 'Papel', action1: 'come a', loser2: 'Spock', action2: 'envenena a', imgWinner: 'img/lagarto.png', imgLoser1: 'img/papel.png', imgLoser2: 'img/spock.png' }
];

// Cargar items
const gameItemsContainer = document.getElementById('game-items');
items.forEach(item => {
    const div = document.createElement('div');
    div.classList.add('icon-game-item');
    div.innerHTML = `
        <img src="${item.img}" class="icon-game" alt="${item.name}">
        <p>${item.name}</p>
    `;
    gameItemsContainer.appendChild(div);
});

// Función para cargar las reglas del juego
function renderGameRules() {
    const gameRulesContainer = document.getElementById('game-rules');
    rules.forEach(rule => {
        const li = document.createElement('li');
        li.innerHTML = `
            <img src="${rule.imgWinner}" class="icon-game-rule" alt="${rule.winner}">
            ${rule.action1}
            <img src="${rule.imgLoser1}" class="icon-game-rule" alt="${rule.loser1}">
            y
            ${rule.action2}
            <img src="${rule.imgLoser2}" class="icon-game-rule" alt="${rule.loser2}">
        `;
        gameRulesContainer.appendChild(li);
    });
}

document.addEventListener('DOMContentLoaded', renderGameRules);
