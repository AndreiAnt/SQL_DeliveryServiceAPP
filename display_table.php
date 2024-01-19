<?php
session_start();

if (isset($_SESSION['user_id'])) {
    // Check if the 'table' parameter is set in the URL
    if (isset($_GET['table'])) {
        $tableName = $_GET['table'];

        // Include the database connection file
        require_once "dbh.inc.php";

        try {
            // Prepare and execute a query to get all rows from the specified table
            $query = "SELECT * FROM $tableName";
            $stmt = $pdo->query($query);

            // Check if there are any rows in the result set
            if ($stmt->rowCount() > 0) {
                // Fetch and display the table headers
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                echo '<table class="table-display">';
                echo '<tr>';
                foreach ($row as $columnName => $value) {
                    echo '<th>' . htmlspecialchars($columnName) . '</th>';
                }
                echo '</tr>';

                // Rewind the statement to fetch all rows
                $stmt->execute();

                // Fetch and display all rows
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr>';
                    foreach ($row as $value) {
                        echo '<td>' . htmlspecialchars($value) . '</td>';
                    }
                    echo '</tr>';
                }

                echo '</table>';
            } else {
                // No rows found in the table
                echo '<p>No data found in the table.</p>';
            }
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }
    } else {
        // 'table' parameter is not set
        echo '<p>Error: Table parameter is missing.</p>';
    }
} else {
    // User is not logged in
    echo '<p>Error: User is not logged in.</p>';
}
?>
