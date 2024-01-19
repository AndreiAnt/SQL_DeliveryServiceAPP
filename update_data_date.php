<?php
require_once('dbh.inc.php'); // Include your database connection file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check which button is clicked
    if (isset($_POST['updateTelefon'])) {
        // Update Telefon
        $datePersoanaID = $_POST['datePersoanaID'];
        $newTelefon = $_POST['newTelefon'];

        $sql = "UPDATE date SET Telefon = :newTelefon WHERE Date_Persoana_ID = :datePersoanaID";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':datePersoanaID', $datePersoanaID, PDO::PARAM_INT);
        $stmt->bindParam(':newTelefon', $newTelefon, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "";
        } else {
            echo "Error updating Telefon";
        }
    }

    if (isset($_POST['updateCUI'])) {
        // Update CUI
        $datePersoanaID = $_POST['datePersoanaID'];
        $newCUI = $_POST['newCUI'];

        $sql = "UPDATE date SET CUI = :newCUI WHERE Date_Persoana_ID = :datePersoanaID";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':datePersoanaID', $datePersoanaID, PDO::PARAM_INT);
        $stmt->bindParam(':newCUI', $newCUI, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "";
        } else {
            echo "Error updating CUI";
        }
    }

    if (isset($_POST['updateCNP'])) {
        // Update CNP
        $datePersoanaID = $_POST['datePersoanaID'];
        $newCNP = $_POST['newCNP'];

        $sql = "UPDATE date SET CNP = :newCNP WHERE Date_Persoana_ID = :datePersoanaID";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':datePersoanaID', $datePersoanaID, PDO::PARAM_INT);
        $stmt->bindParam(':newCNP', $newCNP, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "";
        } else {
            echo "Error updating CNP";
        }
    }

    if (isset($_POST['updateAdresa'])) {
        // Update Adresa
        $datePersoanaID = $_POST['datePersoanaID'];
        $newAdresa = $_POST['newAdresa'];

        $sql = "UPDATE date SET Adresa = :newAdresa WHERE Date_Persoana_ID = :datePersoanaID";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':datePersoanaID', $datePersoanaID, PDO::PARAM_INT);
        $stmt->bindParam(':newAdresa', $newAdresa, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "";
        } else {
            echo "Error updating Adresa";
        }
    }

    if (isset($_POST['updateContBancar'])) {
        // Update Cont_Bancar
        $datePersoanaID = $_POST['datePersoanaID'];
        $newContBancar = $_POST['newContBancar'];

        $sql = "UPDATE date SET Cont_Bancar = :newContBancar WHERE Date_Persoana_ID = :datePersoanaID";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':datePersoanaID', $datePersoanaID, PDO::PARAM_INT);
        $stmt->bindParam(':newContBancar', $newContBancar, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "";
        } else {
            echo "Error updating Cont_Bancar";
        }
    }

    if (isset($_POST['updateCodClient'])) {
        // Update Cod_Client
        $datePersoanaID = $_POST['datePersoanaID'];
        $newCodClient = $_POST['newCodClient'];

        $sql = "UPDATE date SET Cod_Client = :newCodClient WHERE Date_Persoana_ID = :datePersoanaID";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':datePersoanaID', $datePersoanaID, PDO::PARAM_INT);
        $stmt->bindParam(':newCodClient', $newCodClient, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "";
        } else {
            echo "Error updating Cod_Client";
        }
    }

    if (isset($_POST['updateEmail'])) {
        // Update Email
        $datePersoanaID = $_POST['datePersoanaID'];
        $newEmail = $_POST['newEmail'];

        $sql = "UPDATE date SET Email = :newEmail WHERE Date_Persoana_ID = :datePersoanaID";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':datePersoanaID', $datePersoanaID, PDO::PARAM_INT);
        $stmt->bindParam(':newEmail', $newEmail, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "";
        } else {
            echo "Error updating Email";
        }
    }

    if (isset($_POST['updateNumePersoanaContact'])) {
        // Update Nume_Persoana_Contact
        $datePersoanaID = $_POST['datePersoanaID'];
        $newNumePersoanaContact = $_POST['newNumePersoanaContact'];

        $sql = "UPDATE date SET Nume_Persoana_Contact = :newNumePersoanaContact WHERE Date_Persoana_ID = :datePersoanaID";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':datePersoanaID', $datePersoanaID, PDO::PARAM_INT);
        $stmt->bindParam(':newNumePersoanaContact', $newNumePersoanaContact, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "";
        } else {
            echo "Error updating Nume_Persoana_Contact";
        }
    }

    if (isset($_POST['updateTelefonPersoanaContact'])) {
        // Update Telefon_Persoana_Contact
        $datePersoanaID = $_POST['datePersoanaID'];
        $newTelefonPersoanaContact = $_POST['newTelefonPersoanaContact'];

        $sql = "UPDATE date SET Telefon_Persoana_Contact = :newTelefonPersoanaContact WHERE Date_Persoana_ID = :datePersoanaID";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':datePersoanaID', $datePersoanaID, PDO::PARAM_INT);
        $stmt->bindParam(':newTelefonPersoanaContact', $newTelefonPersoanaContact, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "";
        } else {
            echo "Error updating Telefon_Persoana_Contact";
        }
    }

    // Add similar blocks for other fields (CNP, Adresa, Cont_Bancar, Cod_Client, Email, Nume_Persoana_Contact, Telefon_Persoana_Contact) as needed...

}

// Fetch data from the 'date' table
$sql = "SELECT * FROM date";
$stmt = $pdo->query($sql);
$dates = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Date</title>
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

        .form-container h2 {
        color: #333; /* Heading color */
        margin-bottom: 20px;
    }

        .container h2 {
        background-color: white; /* Add white background */
        padding: 10px; /* Add padding for spacing */
        border-radius: 10px; /* Add border radius for rounded corners */
        width: 20%; /* Change the length of the table to 80% and center it */
        margin-left: auto;
        margin-right: auto;
    }

    
    </style>
</head>
<body>

<h1 class="company-name">RapidDispatch</h1>

    <div class="hello-button">
        <button onclick="goToHome()"><?php echo htmlspecialchars($username); ?></button>
    </div>

    <a class="insert-data-button" href="update_data.php">
        <button class="btn btn-primary">
            <span>&larr; </span>
        </button>
    </a>
    <div class="logout-container">
        <button class="logout-button" onclick="logout()">Logout</button>
    </div>

<div class="container mt-5">    
    <h2 class="text-center mb-4"> Update Date Table</h2>
    <table border="1">
        <tr>
            <th>Date Persoana ID</th>
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
        <?php foreach ($dates as $date): ?>
            <tr>
                <td><?= $date['Date_Persoana_ID'] ?></td>
                <td><?= $date['Telefon'] ?></td>
                <td><?= $date['CUI'] ?></td>
                <td><?= $date['CNP'] ?></td>
                <td><?= $date['Adresa'] ?></td>
                <td><?= $date['Cont_Bancar'] ?></td>
                <td><?= $date['Cod_Client'] ?></td>
                <td><?= $date['Email'] ?></td>
                <td><?= $date['Nume_Persoana_Contact'] ?></td>
                <td><?= $date['Telefon_Persoana_Contact'] ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="datePersoanaID" value="<?= $date['Date_Persoana_ID'] ?>">
                        <input type="text" name="newTelefon" placeholder="New Telefon">
                        <button type="submit" name="updateTelefon">Update</button>
                    </form>
                </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="datePersoanaID" value="<?= $date['Date_Persoana_ID'] ?>">
                        <input type="text" name="newCUI" placeholder="New CUI">
                        <button type="submit" name="updateCUI">Update</button>
                    </form>
                </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="datePersoanaID" value="<?= $date['Date_Persoana_ID'] ?>">
                        <input type="text" name="newCNP" placeholder="New CNP">
                        <button type="submit" name="updateCNP">Update</button>
                    </form>
                </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="datePersoanaID" value="<?= $date['Date_Persoana_ID'] ?>">
                        <input type="text" name="newAdresa" placeholder="New Adresa">
                        <button type="submit" name="updateAdresa">Update</button>
                    </form>
                </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="datePersoanaID" value="<?= $date['Date_Persoana_ID'] ?>">
                        <input type="text" name="newContBancar" placeholder="New Cont_Bancar">
                        <button type="submit" name="updateContBancar">Update</button>
                    </form>
                </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="datePersoanaID" value="<?= $date['Date_Persoana_ID'] ?>">
                        <input type="text" name="newCodClient" placeholder="New Cod_Client">
                        <button type="submit" name="updateCodClient">Update</button>
                    </form>
                </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="datePersoanaID" value="<?= $date['Date_Persoana_ID'] ?>">
                        <input type="text" name="newEmail" placeholder="New Email">
                        <button type="submit" name="updateEmail">Update</button>
                    </form>
                </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="datePersoanaID" value="<?= $date['Date_Persoana_ID'] ?>">
                        <input type="text" name="newNumePersoanaContact" placeholder="New Nume_Persoana_Contact">
                        <button type="submit" name="updateNumePersoanaContact">Update</button>
                    </form>
                </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="datePersoanaID" value="<?= $date['Date_Persoana_ID'] ?>">
                        <input type="text" name="newTelefonPersoanaContact" placeholder="New Telefon_Persoana_Contact">
                        <button type="submit" name="updateTelefonPersoanaContact">Update</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
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
