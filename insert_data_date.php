<?php
require_once "dbh.inc.php";

// Assuming your table name is "date"
$tableName = "date";

// Function to get the lowest available Date_Persoana_ID from the database
function getLowestAvailableDateID() {
    global $pdo, $tableName;

    $query = "SELECT Date_Persoana_ID FROM $tableName ORDER BY Date_Persoana_ID ASC";
    $result = $pdo->query($query);

    // Check if the query was successful
    if ($result !== false) {
        $existingIDs = $result->fetchAll(PDO::FETCH_COLUMN);

        // Find the lowest available ID starting from 1
        for ($i = 1; $i <= count($existingIDs) + 1; $i++) {
            if (!in_array($i, $existingIDs)) {
                return $i;
            }
        }
    }

    // Default to 1 if there is an issue with the query or no existing IDs
    return 1;
}

$dateID = isset($_POST['Date_Persoana_ID']) ? $_POST['Date_Persoana_ID'] : getLowestAvailableDateID();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assuming your form includes fields for Date_Persoana_ID, Telefon, CUI, CNP, Adresa, Cont_Bancar, Cod_Client, Email, Nume_Persoana_Contact, and Telefon_Persoana_Contact
    $telefon = $_POST['Telefon'];
    $cui = $_POST['CUI'];
    $cnp = $_POST['CNP'];
    $adresa = $_POST['Adresa'];
    $contBancar = $_POST['Cont_Bancar'];
    $codClient = $_POST['Cod_Client'];
    $email = $_POST['Email'];
    $numePersoanaContact = $_POST['Nume_Persoana_Contact'];
    $telefonPersoanaContact = $_POST['Telefon_Persoana_Contact'];

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

    // Assuming Date_Persoana_ID, Telefon, CUI, CNP, Adresa, Cont_Bancar, Cod_Client, Email, Nume_Persoana_Contact, and Telefon_Persoana_Contact are fields in your form
    $stmt->bindValue(":Date_Persoana_ID", $dateID);
    $stmt->bindValue(":Telefon", $telefon);
    $stmt->bindValue(":CUI", $cui);
    $stmt->bindValue(":CNP", $cnp);
    $stmt->bindValue(":Adresa", $adresa);
    $stmt->bindValue(":Cont_Bancar", $contBancar);
    $stmt->bindValue(":Cod_Client", $codClient);
    $stmt->bindValue(":Email", $email);
    $stmt->bindValue(":Nume_Persoana_Contact", $numePersoanaContact);
    $stmt->bindValue(":Telefon_Persoana_Contact", $telefonPersoanaContact);

    if ($stmt->execute()) {
        echo 'Data inserted successfully.';

        // Reset form fields and update $dateID to the lowest available ID
        $dateID = getLowestAvailableDateID();
        $telefon = "";
        $cui = "";
        $cnp = "";
        $adresa = "";
        $contBancar = "";
        $codClient = "";
        $email = "";
        $numePersoanaContact = "";
        $telefonPersoanaContact = "";
    } else {
        echo 'Error inserting data.';
    }
}

// Function to fetch all data from the date table
function getAllDateData() {
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

// Fetch all date data
$dateData = getAllDateData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rnNE5OEXFK4GgFOK3KPFOOwfsPZqspcSnPCle/hRTt9QpgAIsI4XARiJBi2uZmlr" crossorigin="anonymous">
    <title>Date Registration</title>
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
    <h2 class="text-center mb-4">Insert Date Registration</h2>
    <form action="insert_data_date.php" method="post">
        <div class="mb-3">
            <label for="dateID" class="form-label">Date ID</label>
            <input type="text" class="form-control" id="dateID" name="Date_Persoana_ID" value="<?php echo $dateID; ?>" required>
        </div>
        <div class="mb-3">
            <label for="telefon" class="form-label">Telefon</label>
            <input type="text" class="form-control" id="telefon" name="Telefon" required>
        </div>
        <div class="mb-3">
            <label for="cui" class="form-label">CUI</label>
            <input type="text" class="form-control" id="cui" name="CUI" required>
        </div>
        <div class="mb-3">
            <label for="cnp" class="form-label">CNP</label>
            <input type="text" class="form-control" id="cnp" name="CNP" required>
        </div>
        <div class="mb-3">
            <label for="adresa" class="form-label">Adresa</label>
            <input type="text" class="form-control" id="adresa" name="Adresa" required>
        </div>
        <div class="mb-3">
            <label for="contBancar" class="form-label">Cont Bancar</label>
            <input type="text" class="form-control" id="contBancar" name="Cont_Bancar" required>
        </div>
        <div class="mb-3">
            <label for="codClient" class="form-label">Cod Client</label>
            <input type="text" class="form-control" id="codClient" name="Cod_Client" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="Email" required>
        </div>
        <div class="mb-3">
            <label for="numePersoanaContact" class="form-label">Nume Persoana Contact</label>
            <input type="text" class="form-control" id="numePersoanaContact" name="Nume_Persoana_Contact" required>
        </div>
        <div class="mb-3">
            <label for="telefonPersoanaContact" class="form-label">Telefon Persoana Contact</label>
            <input type="text" class="form-control" id="telefonPersoanaContact" name="Telefon_Persoana_Contact" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>

<div class="container mt-5">
    <h2 class="text-center mb-4">Date Table</h2>
    <table class="table">
    <thead>
            <tr>
                <th>Date ID</th>
                <th>Telefon</th>
                <th>CUI</th>
                <th>CNP</th>
                <th>Adresa</th>
                <th>Cont Bancar</th>
                <th>Cod Client</th>
                <th>Email</th>
                <th>Nume Persoana Contact</th>
                <th>Telefon Persoana Contact</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dateData as $data) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($data['Date_Persoana_ID']); ?></td>
                    <td><?php echo htmlspecialchars($data['Telefon']); ?></td>
                    <td><?php echo htmlspecialchars($data['CUI']); ?></td>
                    <td><?php echo htmlspecialchars($data['CNP']); ?></td>
                    <td><?php echo htmlspecialchars($data['Adresa']); ?></td>
                    <td><?php echo htmlspecialchars($data['Cont_Bancar']); ?></td>
                    <td><?php echo htmlspecialchars($data['Cod_Client']); ?></td>
                    <td><?php echo htmlspecialchars($data['Email']); ?></td>
                    <td><?php echo htmlspecialchars($data['Nume_Persoana_Contact']); ?></td>
                    <td><?php echo htmlspecialchars($data['Telefon_Persoana_Contact']); ?></td>
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
