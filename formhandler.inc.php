<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["Username"];
    $password = $_POST["Password"];

    try {
        require_once "dbh.inc.php";

        // Adjust the table name in the SQL query
        $query = "SELECT * FROM admin WHERE Username = ? AND Password = ?";
        $stmt = $pdo->prepare($query);

        $stmt->execute([$username, $password]);
        $user = $stmt->fetch();

        if ($user) {
            // Username and password are correct
            session_start();
            $_SESSION['user_id'] = $username; // Store user ID in session for future use

            // Redirect to the specified URL
            header("Location: home.php");
            die();
        } else {
            // Username or password is incorrect
            $error_message = "Invalid credentials. Please try again.";
            include "index.php"; // Include the index.php file to display the error message
            die();
        }
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
}
?>
