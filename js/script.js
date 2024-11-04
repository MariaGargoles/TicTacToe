const cells = document.querySelectorAll(".gamecell");
const message = document.getElementById("message");
let currentPlayer = "X";
let board = Array(9).fill(null);
let gameActive = true;

cells.forEach((cell, index) => {
  cell.addEventListener("click", () => handleClick(index));
});

function handleClick(index) {
  if (board[index] || !gameActive) return;
  board[index] = currentPlayer;
  cells[index].textContent = currentPlayer;
  checkWinner();

  // Cambia al siguiente jugador
  currentPlayer = currentPlayer === "X" ? "O" : "X";
}

// Verificacion ganador
function checkWinner() {
  const winningConditions = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6],
  ];

  let roundWon = false;

  for (let i = 0; i < winningConditions.length; i++) {
    const [a, b, c] = winningConditions[i];
    if (board[a] && board[a] === board[b] && board[a] === board[c]) {
      roundWon = true;
      break;
    }
  }

  if (roundWon) {
    message.textContent = `¡Jugador ${currentPlayer} ha ganado!`;
    updateScore(currentPlayer);
    gameActive = false;
    return;
  }

  //Draw
  if (!board.includes(null)) {
    message.textContent = "¡Es un empate!";
    gameActive = false;
  }
}

// actualizar el puntaje
function updateScore(winner) {
  fetch("update_score.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ winner }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Error al actualizar el puntaje");
      }
      return response.json();
    })
    .then((data) => {
      console.log("Datos actualizados:", data);

      document.querySelector(
        ".GameInfo p:nth-child(1)"
      ).textContent = `Jugador X: ${data.playerX_wins}`;
      document.querySelector(
        ".GameInfo p:nth-child(2)"
      ).textContent = `Jugador O: ${data.playerO_wins}`;
    })
    .catch((error) => {
      console.error("Error al actualizar el puntaje:", error);
      message.textContent = "Error al actualizar";
    });
}

// reiniciar el juego
function resetGame() {
  board.fill(null);
  gameActive = true;
  currentPlayer = "X";
  message.textContent = "";
  cells.forEach((cell) => (cell.textContent = ""));
}
