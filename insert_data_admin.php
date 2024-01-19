<?php
require_once "dbh.inc.php";

// Assuming your table name is "admin"
$tableName = "admin";

// Function to get the lowest available Admin_ID from the database
function getLowestAvailableAdminID() {
    global $pdo, $tableName;

    $query = "SELECT Admin_ID FROM $tableName ORDER BY Admin_ID ASC";
    $result = $pdo->query($query);

    // Check if the query was successful
    if ($result !== false) {
        $existingIDs = $result->fetchAll(PDO::FETCH_COLUMN);
        
        // Find the lowest available ID
        for ($i = 0; $i <= count($existingIDs); $i++) {
            if (!in_array($i, $existingIDs)) {
                return $i;
            }
        }
    }

    // Default to 0 if there is an issue with the query or no existing IDs
    return 0;
}

$adminId = isset($_POST['Admin_ID']) ? $_POST['Admin_ID'] : getLowestAvailableAdminID();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assuming your form includes fields for Admin_ID, Username, and Password
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    $columnsQuery = "DESCRIBE $tableName";
    $columnsResult = $pdo->query($columnsQuery);
    $columns = $columnsResult->fetchAll(PDO::FETCH_ASSOC);

    $insertQuery = "INSERT INTO $tableName (";
    $values = "VALUES (";
    foreach ($columns as $column) {
        $insertQuery .= $column['Field'] . ', ';
        $values .= ':' . $column['Field'] . ', ';
    }
    $insertQuery = rtrim($insertQuery, ', ') . ") ";
    $values = rtrim($values, ', ') . ")";
    $finalQuery = $insertQuery . $values;

    $stmt = $pdo->prepare($finalQuery);

    // Assuming Admin_ID, Username, and Password are fields in your form
    $stmt->bindValue(":Admin_ID", $adminId);
    $stmt->bindValue(":Username", $username);
    $stmt->bindValue(":Password", $password);

    if ($stmt->execute()) {
        echo 'Data inserted successfully.';
        
        // Reset form fields and update $adminId to the lowest available ID
        $adminId = getLowestAvailableAdminID();
        $username = "";
        $password = "";
    } else {
        echo 'Error inserting data.';
    }
}

// Function to fetch all data from the admin table
function getAllAdminData() {
    global $pdo, $tableName;

    $query = "SELECT * FROM $tableName";
    $result = $pdo->query($query);

    // Check if the query was successful
    if ($result !== false) {
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Return an empty array if there is an issue with the query
    return [];
}

// Fetch all admin data
$adminData = getAllAdminData();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rnNE5OEXFK4GgFOK3KPFOOwfsPZqspcSnPCle/hRTt9QpgAIsI4XARiJBi2uZmlr" crossorigin="anonymous">
    <title>Admin Registration</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('Poza2.jpg');
            background-size: cover;
            background-position: center;
            text-align: center;
            margin: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: relative;
        }

        body::before {
            content: "";
            background: rgba(0, 0, 0, 0.0);
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
            width: 25%;
        }

        .hello-button,
        .logout-button {
            background-color: #ffcc00;
            color: #0d0000;
            padding: 15px 25px;
            border-radius: 25px;
            cursor: pointer;
            margin-top: 20px;
            border: 3px solid #000;
            outline: none;
            font-weight: bold;
            font-size: 18px;
            font-family: 'Courier New', Courier, monospace;
            position: absolute;
        }

        .hello-button {
            left: 10px;
        }

        .logout-button {
            right: 10px;
        }



        table {
            background-color: white;
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .form-container {
        width: 400px;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        margin-top: 150px; /* Increase margin to move the form down */
        margin-left: auto;
        margin-right: auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add box shadow */
    }

    .form-container h2 {
        color: #333; /* Heading color */
        margin-bottom: 20px;
    }

    .form-container label {
        font-weight: bold;
        color: #555; /* Label color */
    }

    .form-container input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .form-container button {
        width: 100%;
        padding: 12px;
        background-color: #ffcc00;
        color: #0d0000;
        border: 1px solid #000;
        border-radius: 25px;
        cursor: pointer;
        font-weight: bold;
        font-size: 18px;
        font-family: 'Courier New', Courier, monospace;
        transition: background-color 0.3s ease; /* Add smooth transition */
    }

    .form-container button:hover {
        background-color: #e5b800; /* Change background color on hover */
    }

    table {
        background-color: white;
        border-collapse: collapse;
        width: 100%;
        /* Remove margin from the top to avoid free spaces */
        margin-top: 0;
    }

    .container h2 {
        background-color: white; /* Add white background */
        padding: 10px; /* Add padding for spacing */
        border-radius: 10px; /* Add border radius for rounded corners */
        /* Change the leght of the table to 80% and center it */
        width: 20%;
        /*center the table*/
        margin-left: auto;
        margin-right: auto;
    }

    .nav {
        list-style-type: none;
        display: flex;
        justify-content: space-between;
        margin: 0;
        padding: 0;
    }

    .nav-item {
        margin-right: 10px; /* Adjust margin between buttons as needed */
    }


    .insert-data-button button {
        background-color: #ffcc00;
        color: #0d0000;
        padding: 12px;
        border: 3px solid #000;
        border-radius: 50px;
        cursor: pointer;
        font-weight: bold;
        font-size: 30px;
        font-family: 'Courier New', Courier, monospace;
        transition: background-color 0.3s ease;
    }

    .hello-button button {
        background-color: #ffcc00;
        color: #0d0000;
        padding: 12px;
        border: 1px solid #000;
        border-radius: 50px;
        cursor: pointer;
        font-weight: bold;
        font-size: 18px;
        font-family: 'Courier New', Courier, monospace;
        transition: background-color 0.3s ease;
    }

    .insert-data-button button:hover {
        background-color: #e5b800;
    }


    </style>
</head>

<body>

    <h1 class="company-name">RapidDispatch</h1>

    <ul class="nav">
    <li class="nav-item">
        <button class="hello-button" onclick="goToHome()"><?php echo htmlspecialchars($username); ?></button>
    </li>
    <li class="nav-item">
        <a class="nav-link insert-data-button" href="insert_data.php">
            <button class="btn btn-primary">
                <span>&larr; </span>
            </button>
        </a>
    </li>
</ul>


    <div class="logout-container">
        <button class="logout-button" onclick="logout()">Logout</button>
    </div>

    

    <div class="container form-container">
        <h2 class="text-center mb-4">Insert Admin Registration</h2>
        <form action="insert_data_admin.php" method="post">
            <div class="mb-3">
                <label for="adminId" class="form-label">Admin ID</label>
                <input type="text" class="form-control" id="adminId" name="Admin_ID" value="<?php echo $adminId; ?>" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="Username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Admin Table</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Admin ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($adminData as $admin) : ?>
                    <tr>
                        <td><?php echo $admin['Admin_ID']; ?></td>
                        <td><?php echo $admin['Username']; ?></td>
                        <td><?php echo $admin['Password']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-QkN5eZEZckJ72r00BuAnzDxAe34QDzWVFeGnAWeqmuL2N3ch0DL0uXUfjxclK/i6" crossorigin="anonymous"></script>

    <script>
        fetch('get_username.php')
    .then(response => response.json())
    .then(data => {
        console.log(data); // Add this line to inspect the structure of the response
        document.querySelector('.hello-button').textContent = `${data.username}`;
    })
    .catch(error => {
        console.error('Error fetching username:', error);
    });
        function logout() {
            window.location.href = 'index.php';
        }

        function goToHome() {
            window.location.href = 'home.php';
        }
    </script>

</body>

</html>
