<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Methods: DELETE, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

require __DIR__ . '/../../models/Photo.php';

$data = json_decode(file_get_contents('php://input'), true);

$photo_id = $data['photo_id'];

Photo::delete($photo_id);

echo json_encode([
    'status' => 'success',
    'message' => 'Photo deleted successfully'
]);
