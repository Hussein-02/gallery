<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

require __DIR__ . '/../../models/Photo.php';

$user_id = $_GET['user_id'];

$photos = Photo::all($user_id);

echo json_encode([
    'status' => 'success',
    'photos' => $photos
]);
