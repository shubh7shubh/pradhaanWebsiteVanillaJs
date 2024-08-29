<?php
// Check if the image data is received
if(isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
    // Directory where images will be saved
    $uploadDir = 'files/certificatefile/';

    // Create directory if it doesn't exist
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Get the original file name
    $imageName = $_FILES['image']['name'];

    // Path to save the image
    $uploadPath = $uploadDir . $imageName;

    // Move the uploaded file to the specified destination
    if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
        // Extract filename without extension
        $filenameWithoutExtension = pathinfo($imageName, PATHINFO_FILENAME);

        // Return success response with the path to the uploaded image
        echo json_encode(array('status' => 'success', 'message' => 'Image uploaded successfully.', 'file_name' => $filenameWithoutExtension, 'file_path' => $uploadPath));
    } else {
        // Return error response if file upload failed
        echo json_encode(array('status' => 'error', 'message' => 'Failed to upload image.'));
    }
} else {
    // Return error response if image data is not received
    echo json_encode(array('status' => 'error', 'message' => 'No image data received.'));
}
?>
