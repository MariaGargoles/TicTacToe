<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['winner'])) {
        $winner = $data['winner'];

        // Actualiza el puntaje 
        if ($winner === "X") {
            $_SESSION['playerX_wins'] += 1;
        } elseif ($winner === "O") {
            $_SESSION['playerO_wins'] += 1;
        }


        echo json_encode([
            'playerX_wins' => $_SESSION['playerX_wins'],
            'playerO_wins' => $_SESSION['playerO_wins']
        ]);
        exit();
    }
}


http_response_code(400);
echo json_encode(['error' => 'Invalid request']);
