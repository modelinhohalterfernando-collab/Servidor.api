<?php
require __DIR__ . '/dados.php';

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$email = $input['email'] ?? null;
$password = $input['password'] ?? null;
$type = $input['type'] ?? null;

$auth = firebaseAuth();

try {
    if ($type === 'cadastro') {
        $user = $auth->createUserWithEmailAndPassword($email, $password);
        echo json_encode([
            'status' => true,
            'mensagem' => 'Cadastro bem-sucedido',
            'uid' => $user->uid,
            'email' => $email
        ]);
    } elseif ($type === 'login') {
        $signInResult = $auth->signInWithEmailAndPassword($email, $password);
        echo json_encode([
            'status' => true,
            'mensagem' => 'Login bem-sucedido',
            'idToken' => $signInResult->idToken(),
            'email' => $email
        ]);
    } else {
        echo json_encode([
            'status' => false,
            'mensagem' => 'Tipo inválido'
        ]);
    }
} catch (\Throwable $e) {
    echo json_encode([
        'status' => false,
        'mensagem' => $e->getMessage()
    ]);
}
