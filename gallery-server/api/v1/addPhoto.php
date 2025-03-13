<?php

require __DIR__ . '/../../models/Photo.php';

$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'];
$title = $data['title'];
$description = $data['description'];
$tags = $data['tags'];
$base64_image = $data['image'];

$image_data = base64_decode($base64_image);

$uploadDir = __DIR__ . '../../uploads/';

//to generate a name for the image
$fileName = uniqid() . '.jpg';
$uploadPath = $uploadDir . $fileName;

if (file_put_contents($uploadPath, $image_data)) {

    $image_path = 'uploads/' . $fileName;
    Photo::create($user_id, $title, $description, $tags, $image_path);
    Photo::save();

    echo json_encode([
        'status' => 'success',
        'message' => 'Photo uploaded successfully',
        'image_path' => $image_path
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to save image'
    ]);
}
