<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('Poza1.jpg');
            background-size: cover;
            background-position: center;
            text-align: center;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
        }

        body::before {
            content: "";
            background: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: -1;
        }

        h1.company-name {
    font-family: 'Quicksand', sans-serif;
    font-size: 3em;
    color: #ffffff;
    margin-bottom: 20px;
    text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);
    position: absolute;
    top: 5%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 15px;
    border-radius: 30%;
    background-color: rgba(0, 0, 0, 0.2);
    z-index: 1;
    width: 25%; /* Adjust the width as needed */
}

        h2 {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            font-size: 24px;
            color: #000;
            text-shadow: 2px 2px 2px rgba(255, 255, 255, 0.5);
            padding: 15px;
            border-radius: 50px;
            border: 3px solid #000;
            background-color: #ffcc00;
            position: absolute;
            top: 10px;
            left: 10px;
        }

        #username {
            font-family: 'Courier New', Courier, monospace;
        }

        .button {
            background-color: #3498db;
            color: #fff;
            padding: 20px;
            border-radius: 10%;
            cursor: pointer;
            margin-top: 20px;
            border: 3px solid #000;
            outline: none;
            font-weight: bold;
            font-size: 18px;
        }

        .button-container {
            position: absolute;
            left: 10px;
            bottom: 10px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        select {
            padding: 20px;
            margin-top: 20px;
            border-radius: 10%;
            cursor: pointer;
            border: 3px solid #3498db;
            outline: none;
            font-weight: bold;
            font-size: 18px;
            color: #000;
            background-color: #fff;
        }

        .table-display {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        .table-display th, .table-display td {
            padding: 10px;
            border: 3px solid #ddd;
        }

        .logout-container {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .logout-button {
    background-color: #ffcc00; /* Change this to your desired background color */
    color: #202200; /* Change this to your desired text color */
    padding: 20px;
    border-radius: 10%;
    cursor: pointer;
    margin-top: 20px;
    border: 3px solid #000;
    outline: none;
    font-weight: bold;
    font-size: 18px;
}
    </style>
<body>
    <?php
    session_start();
    // Check if the user is not logged in, redirect to login page
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }

    require_once "dbh.inc.php";

    // Fetch table names for dropdown
    $tablesQuery = "SHOW TABLES";
    $tablesResult = $pdo->query($tablesQuery);
    $tableNames = $tablesResult->fetchAll(PDO::FETCH_COLUMN);
    ?>

<h1 class="company-name">RapidDispatch</h1>

<div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
        <h2>Hello <span id="username"></span></h2>
        
        <div class="logout-container">
            <button class="logout-button" onclick="logout()">Logout</button>
        </div>
    </div>

    <!-- Add a dropdown list for table selection -->
    <label for="tableSelect"></label>
    <select id="tableSelect" onchange="displaySelectedTable()">
        <option value="" selected disabled>Select a table</option>
        <?php foreach ($tableNames as $tableName) : ?>
            <option value="<?php echo $tableName; ?>"><?php echo $tableName; ?></option>
        <?php endforeach; ?>
    </select>

    <!-- Container to display the selected table -->
    <div id="tableContainer"></div>

    <div class="button-container">
        <!-- Buttons for Database, Insert, Edit, and Delete -->
        <button class="button" onclick="goToDatabase()">Database</button>
        <button class="button" onclick="goToInsertForm()">Insert</button>
        <button class="button" onclick="goToUpdateForm()">Update</button>
        <button class="button" onclick="goToDeleteForm()">Delete</button>
        <button class="button" onclick="goToSearch()">Search</button>
    </div>

    <script>
        // Fetch the username from the session using JavaScript
        fetch('get_username.php')
            .then(response => response.json()) // Parse the response as JSON
            .then(data => {
                // Update the username span with the retrieved username
                document.getElementById('username').textContent = data.username;
            })
            .catch(error => {
                console.error('Error fetching username:', error);
            });

        // Function to navigate to the specified URL
        function goToDatabase() {
            window.location.href = 'http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=firma_curierat&table=admin';
        }
        function goToInsertForm() {
        window.location.href = 'insert_data.php';
        }

        function goToUpdateForm() {
            window.location.href = 'update_data.php';
        }

        function goToDeleteForm() {
            window.location.href = 'delete_data.php';
        }

        function goToSearch() {
            window.location.href = 'search_data.php';
        }

        let currentSelectedTable = null;

        // Function to display the selected table
        function displaySelectedTable() {
            const selectedTable = document.getElementById('tableSelect').value;
            const tableContainer = document.getElementById('tableContainer');

            // Check if the same table is selected again
            if (selectedTable === currentSelectedTable) {
                // If so, force the collapse
                tableContainer.style.display = 'none';
                currentSelectedTable = null; // Reset the current selected table
            } else {
                // Fetch the table content and display it
                fetch(`display_table.php?table=${selectedTable}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.text();
                    })
                    .then(data => {
                        // Display the table content in the tableContainer
                        tableContainer.innerHTML = data;
                        tableContainer.style.display = 'block'; // Show the table
                        currentSelectedTable = selectedTable; // Update the current selected table
                        console.log('Table displayed:', selectedTable);
                    })
                    .catch(error => {
                        console.error('Error fetching or displaying table content:', error);
                        alert('Error fetching or displaying table content. Please try again.');
                        tableContainer.style.display = 'none'; // Hide the table on error
                        currentSelectedTable = null; // Reset the current selected table on error
                    });
            }
            
        }

       


        document.body.addEventListener('click', function (event) {
            const tableContainer = document.getElementById('tableContainer');
            const tableSelect = document.getElementById('tableSelect');

            // Check if the clicked element is not inside the tableContainer or the tableSelect
            if (!tableContainer.contains(event.target) && !tableSelect.contains(event.target)) {
                tableContainer.style.display = 'none'; // Collapse the table
            }
        });

        function logout() {
            window.location.href = 'index.php';
        }
    </script>

</body>

</html>