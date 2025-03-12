<?php

require __DIR__ . '../../models/Photo.php';

$uploadDir = __DIR__ . '../../uploads/';

$data = json_decode(file_get_contents('php://input'), true);

//to generate a name for the image
$fileName = uniqid() . '_' . basename($_FILES['image']['name']);
$uploadPath = $uploadDir . $fileName;

if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {

    $user_id = $data['user_id'];
    $title = $data['title'];
    $description = $data['description'];
    $tags = $data['tags'];
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
        'message' => 'Failed to move uploaded file'
    ]);
}
