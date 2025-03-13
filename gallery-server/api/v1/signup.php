<?php

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

$json = file_get_contents("php://input");
$data = json_decode($json, true);

if (!$data || !isset($data['full_name']) || !isset($data['email']) || !isset($data['password'])) {
    echo json_encode(["success" => false, "message" => "Invalid input: fullname, email, and password are required"]);
    exit;
}

$fullname = $data['full_name'];
$email = $data['email'];
$password = $data['password'];

$existingUser = User::findByEmail($email);
if ($existingUser) {
    echo json_encode(["success" => false, "message" => "Email already registered"]);
    exit;
}

User::create($fullname, $email, $password);
User::save();

$token_payload = [
    "fullname" => User::$fullname,
    "email" => User::$email,
    "exp" => time() + 60 * 60
];

$token = generate_jwt($token_payload, $key);

echo json_encode(["success" => true, "message" => "User registered successfully", "token" => $token, "user" => [
    "fullname" => User::$fullname,
    "email" => User::$email
]]);
