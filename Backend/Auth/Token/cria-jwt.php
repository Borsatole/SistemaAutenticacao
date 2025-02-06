<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// include_once('registra-http-only.php');

require '../vendor/autoload.php'; // Se estiver usando Composer

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function criaToken()
{

    // Chave secreta para assinar o token (NUNCA exponha isso publicamente)
    $chaveSecreta = "z3X!p@v9&LuGm8T#b7KdQ2Y^cWjN6R4s";

    // Dados do usuário para inserir no token
    $payload = [
        "iss" => "https://seusite.com",  // Emissor do token
        "aud" => "https://seusite.com",  // Destinatário do token
        "iat" => time(),                 // Timestamp de emissão
        "exp" => time() + (60 * 60),      // Expira em 1 hora
        "user_id" => 123,                 // ID do usuário autenticado
        "email" => "usuario@email.com"     // Email do usuário
    ];

    // Gerando o token JWT
    $token = JWT::encode($payload, $chaveSecreta, 'HS256');
    // $decoded = JWT::decode($token, new Key($chaveSecreta, 'HS256'));
    // registrahttponlycookie('test');
    return $token;

}



