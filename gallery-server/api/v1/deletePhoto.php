<?php

require __DIR__ . '/../../models/Photo.php';

$data = json_decode(file_get_contents('php://input'), true);

$photo_id = $data['photo_id'];

Photo::delete($photo_id);

echo json_encode([
    'status' => 'success',
    'message' => 'Photo deleted successfully'
]);
