<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Output the username as JSON
    echo json_encode(['username' => $_SESSION['user_id']]);
} else {
    // Output an empty string if the user is not logged in
    echo json_encode(['username' => '']);
}
?>
