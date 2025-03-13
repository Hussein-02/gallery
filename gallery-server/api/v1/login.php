<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

require __DIR__ . '/../../models/User.php';

$key = "12345";

function base64url_encode($data)
{
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function generate_jwt($payload, $key)
{
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
    $header_encoded = base64url_encode($header);

    $payload_encoded = base64url_encode(json_encode($payload));

    $signature = hash_hmac('sha256', "$header_encoded.$payload_encoded", $key, true);
    $signature_encoded = base64url_encode($signature);

    return "$header_encoded.$payload_encoded.$signature_encoded";
}

header("Content-Type: application/json");

$json = file_get_contents("php://input");
$data = json_decode($json, true);

$email = $data['email'];
$password = $data['password'];

$user = User::findByEmail($email);

if ($user) {
    if (hash('sha256', $password) === $user['password']) {
        $form = [
            "id" => $user['id'],
            "email" => $user['email'],
            "exp" => time() + 60 * 60
        ];

        $token = generate_jwt($form, $key);

        echo json_encode([
            "success" => true,
            "token" => $token,
            "user" => [
                "id" => $user['id'],
                "full_name" => $user['full_name'],
                "email" => $user['email']
            ]
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Incorrect password"]);
        exit;
    }
} else {
    echo json_encode(["success" => false, "message" => "Email not found"]);
    exit;
}
