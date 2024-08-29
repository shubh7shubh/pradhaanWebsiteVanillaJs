<?php

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the JSON data from the request body
    $jsonData = file_get_contents("php://input");
    
    // Decode the JSON data
    $requestData = json_decode($jsonData);

    // Check if the JSON data contains the HTML content and file name
    if (isset($requestData->htmlContent) && isset($requestData->fileName)) {
        // Get the HTML content and file name
        $htmlContent = $requestData->htmlContent;
        $fileName = $requestData->fileName;

        // Set the file path where the certificate file will be saved
        $filePath = "certificate/$fileName"; // Adjust the folder path as needed

        // Save the HTML content to the file
        $fileSaved = file_put_contents($filePath, $htmlContent);

        // Check if the file was saved successfully
        if ($fileSaved !== false) {
            // Send a success response
            http_response_code(200);
            echo "Certificate file saved successfully: $fileName";
        } else {
            // Send an error response
            http_response_code(500);
            echo "Failed to save certificate file.";
        }
    } else {
        // Send a bad request response
        http_response_code(400);
        echo "Invalid request data.";
    }
} else {
    // Send a method not allowed response
    http_response_code(405);
    echo "Method not allowed.";
}

?>
