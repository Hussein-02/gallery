<?php

require __DIR__ . '../../models/Photo.php';

$user_id = $_GET['user_id'];

$photos = Photo::all($user_id);

echo json_encode([
    'status' => 'success',
    'photos' => $photos
]);
