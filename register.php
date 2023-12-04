<?php
if (!file_exists('users.json')) {
    file_put_contents('users.json', json_encode([]));
}

$user_credentials = json_decode(file_get_contents('users.json'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['new_username']) && isset($data['new_password']))     {
        $new_username = $data['new_username'];
        $new_password = $data['new_password'];

        if (!is_array($user_credentials)) {
            $user_credentials = [];
        }

        if (!array_key_exists($new_username, $user_credentials)) {
            $user_credentials[$new_username] = $new_password;
            file_put_contents('users.json', json_encode($user_credentials));
            echo json_encode(['message' => 'Registro bem-sucedido!']);
        } else {
            echo json_encode(['message' => 'Erro: Nome de usuário já registrado.']);
        }
    } else {
        echo json_encode(['message' => 'Erro: Nome de usuário ou senha ausente.']);
    }
}
?>
