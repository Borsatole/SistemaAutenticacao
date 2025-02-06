<?php


//Define Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

// Dados para login
$loginReal = "admin@admin.com";
$senhaReal = "admin";

// imports
include_once('../conexao.php');
include('./IP/pega-ip-usuario.php');
include('./IP/verifica-se-ip-esta-bloqueado.php');
include_once('./RateLimit/registra-tentativa-login-errado.php');
include_once('./Token/cria-jwt.php');
// include_once('./Token/registra-http-only.php');

// Algumas validações iniciais

// Verifica se o metodo de envio é POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(['erroMessage' => 'Método não permitido']);
    die();
}

// Verifica se o IP está bloqueado no banco de dados
$VerificaIp = VerificarBloqueioIp();
if ($VerificaIp['bloqueado'] === true) {
    echo json_encode([
        'erroMessage' => 'Você está fazendo muitas tentativas.
        Aguarde ' . $VerificaIp['tempoRestante'] . ' segundos para tentar novamente.'
    ]);
    die();
}

// Captura os dados recebidos pela requisição
$dadosRecebidos = file_get_contents('php://input');

// Verifica se os dados nao estao vazios
if (empty($dadosRecebidos)) {
    echo json_encode(['erroMessage' => 'Voce nao enviou nenhum dado']);
    die();
}

// Decodifica os dados para Json
$dados = json_decode($dadosRecebidos, true);

// Verifica se os campos obrigatórios estão presentes
if (empty($dados['email']) || empty($dados['password'])) {
    echo json_encode(['erroMessage' => 'Preencha todos os campos']);
    die();
}

// Sanitiza os inputs
$email = filter_var($dados['email'], FILTER_SANITIZE_EMAIL);
$password = htmlspecialchars($dados['password']);

if ($email === $loginReal && $password === $senhaReal) {

    setcookie(
        "test_cookie",
        '123',
        time() + 3600,
        "/",
        "localhost", // Ou o domínio do seu site
        false, // HTTP (em desenvolvimento)
        true // HttpOnly para segurança
    );

    echo json_encode([
        'JWT' => criaToken(),
        'successMessage' => 'Logado com sucesso'

    ]);
} else {
    echo json_encode([
        // Se o login ou senha estiverem errados, registra a tentativa de login errado
        'erroMessage' => RegistrarTentativa()

    ]);
}



?>
