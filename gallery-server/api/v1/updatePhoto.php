<?php

require __DIR__ . '/../../models/Photo.php';

// Check if a file was uploaded
$image_path = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // Define the upload directory
    $uploadDir = __DIR__ . '/../../uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // Create the directory if it doesn't exist
    }

    // Generate a unique file name to avoid conflicts
    $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
    $uploadPath = $uploadDir . $fileName;

    // Move the uploaded file to the upload directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
        $image_path = 'uploads/' . $fileName; // Relative path for the database
    } else {
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to move uploaded file'
        ]);
        exit();
    }
}

// Get other form data
$photo_id = $_POST['photo_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$tags = $_POST['tags'];

// Update the photo
Photo::update($photo_id, $title, $description, $tags, $image_path);

echo json_encode([
    'status' => 'success',
    'message' => 'Photo updated successfully'
]);
