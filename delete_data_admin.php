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

// Function to delete an admin by Admin_ID
function deleteAdmin($adminId) {
    global $pdo, $tableName;

    try {
        $deleteQuery = "DELETE FROM $tableName WHERE Admin_ID = :Admin_ID";
        $deleteStmt = $pdo->prepare($deleteQuery);
        $deleteStmt->bindValue(":Admin_ID", $adminId);

        return $deleteStmt->execute();
    } catch (PDOException $e) {
        // Log or display the error message
        echo 'Error: ' . $e->getMessage();
        return false;
    }
}

// Handle deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteAdmin'])) {
    $deleteAdminId = $_POST['deleteAdmin'];
    deleteAdmin($deleteAdminId);
}

$adminId = isset($_POST['deleteAdmin']) ? $_POST['deleteAdmin'] : getLowestAvailableAdminID();

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
            margin-top: -180px;

        }

        .hello-button{
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
            margin-top: 0px;
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
            /* Change the length of the table to 80% and center it */
            width: 20%;
            /*center the table*/
            margin-left: auto;
            margin-right: auto;
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
            right: 0px; /* Adjust the right property to move it more to the right */
            left: 100px; /* Reset the left property */
            margin-top: 130px;
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

    <div class="hello-button">
        <button onclick="goToHome()"><?php echo htmlspecialchars($username); ?></button>
    </div>

    <a class="insert-data-button" href="delete_data.php">
        <button class="btn btn-primary">
            <span>&larr; </span>
        </button>
    </a>

    <div class="logout-container">
        <button class="logout-button" onclick="logout()">Logout</button>
    </div>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Delete Admin Table</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Admin ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($adminData as $admin) : ?>
                    <tr>
                        <td><?php echo $admin['Admin_ID']; ?></td>
                        <td><?php echo $admin['Username']; ?></td>
                        <td><?php echo $admin['Password']; ?></td>
                        <td>
                            <!-- Add form for deletion with hidden input for Admin_ID -->

                            <form method="post" style="display:inline;">
                                <input type="hidden" name="deleteAdmin" value="<?php echo $admin['Admin_ID']; ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
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
