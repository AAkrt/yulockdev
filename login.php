<?php
$user_credentials = json_decode(file_get_contents('users.json'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $username = $data['username'];
    $password = $data['password'];

    if ($username && $password) {
        $stored_password = $user_credentials[$username] ?? null;
        if ($stored_password && $stored_password === $password) {
            echo json_encode(['message' => 'Login bem-sucedido!']);
        } else {
            echo json_encode(['message' => 'Credenciais inválidas.']);
        }
    } else {
        echo json_encode(['message' => 'Erro: Nome de usuário ou senha ausente.']);
    }
}
?>
