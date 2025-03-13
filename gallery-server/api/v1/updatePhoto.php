<?php

require __DIR__ . '/../../models/Photo.php';


$data = json_decode(file_get_contents('php://input'), true);

$photo_id = $data['photo_id'];
$title = $data['title'];
$description = $data['description'];
$tags = $data['tags'];
$base64_image = $data['image'] ?? null;

$image_path = null;
if ($base64_image) {
    $image_data = base64_decode($base64_image);
    if ($image_data === false) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid Base64 image'
        ]);
        exit();
    }

    $uploadDir = __DIR__ . '/../../uploads/';

    $fileName = uniqid() . '.jpg';
    $uploadPath = $uploadDir . $fileName;

    //save the decoded image to the upload directory
    if (file_put_contents($uploadPath, $image_data)) {
        $image_path = 'uploads/' . $fileName;
    } else {
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to save image'
        ]);
        exit();
    }
}

Photo::update($photo_id, $title, $description, $tags, $image_path);

echo json_encode([
    'status' => 'success',
    'message' => 'Photo updated successfully'
]);
