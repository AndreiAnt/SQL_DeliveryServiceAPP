<?php
require_once "dbh.inc.php"; // Include your database connection file

if (isset($_GET['table'])) {
    $tableName = $_GET['table'];

    try {
        // Fetch the columns of the specified table
        $columnsQuery = "DESCRIBE $tableName";
        $columnsResult = $pdo->query($columnsQuery);
        
        if ($columnsResult === false) {
            // Log the query error
            $errorInfo = $pdo->errorInfo();
            error_log("Query error in describe_table.php: " . implode(" ", $errorInfo));

            // Handle the query error
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['error' => 'Internal Server Error']);
            exit();
        }

        $columns = $columnsResult->fetchAll(PDO::FETCH_ASSOC);

        // Return the columns as JSON
        header('Content-Type: application/json');
        echo json_encode(['columns' => $columns]);
    } catch (PDOException $e) {
        // Log the error
        error_log("Error in describe_table.php: " . $e->getMessage());

        // Handle database errors
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Internal Server Error']);
    }
} else {
    // Handle the case where 'table' parameter is not set
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'Bad Request: "table" parameter is missing.']);
}
?>
