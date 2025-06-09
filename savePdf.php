<?php
error_reporting(0);
header('Content-Type: application/json');
ob_start();

$response = ['success' => false, 'error' => 'Unknown error'];

if (isset($_FILES['pdf']) && isset($_POST['folder'])) {
    $folder = $_POST['folder'];
    if (!is_dir($folder)) {
        if (!mkdir($folder, 0777, true)) {
            $response = ['success' => false, 'error' => 'Failed to create folder'];
            ob_clean();
            echo json_encode($response);
            exit;
        }
    }
    $target = rtrim($folder, '/\\') . '/' . basename($_FILES['pdf']['name']);
    if (move_uploaded_file($_FILES['pdf']['tmp_name'], $target)) {
        $response = ['success' => true];
    } else {
        $response = ['success' => false, 'error' => 'Failed to save file'];
    }
} else {
    $response = ['success' => false, 'error' => 'Invalid request'];
}

ob_clean();
echo json_encode($response);
exit;

