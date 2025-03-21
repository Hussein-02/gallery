<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: *');
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

require __DIR__ . '/../../models/Photo.php';

$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'];
$title = $data['title'];
$description = $data['description'];
$tags = $data['tags'];

//get base64image and turn it into a normal image
$base64_image = $data['image_path'];
$base64_image = preg_replace('#^data:image/\w+;base64,#i', '', $base64_image);
$image_data = base64_decode($base64_image);

$uploadDir = __DIR__ . '/../../public/uploads/';

//to generate a name for the image
$fileName = uniqid() . '.jpg';
$uploadPath = $uploadDir . $fileName;

if (file_put_contents($uploadPath, $image_data)) {

    $image_path = 'http://localhost/gallery/gallery-server/public/uploads/' . $fileName;
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
