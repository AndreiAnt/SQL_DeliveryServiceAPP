<?php
require_once('dbh.inc.php'); // Include your database connection file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check which button is clicked
    if (isset($_POST['updateNume'])) {
        // Update Nume
        $curieriID = $_POST['curieriID'];
        $newNume = $_POST['newNume'];

        $sql = "UPDATE curieri SET Nume = :newNume WHERE Curieri_ID = :curieriID";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':curieriID', $curieriID, PDO::PARAM_INT);
        $stmt->bindParam(':newNume', $newNume, PDO::PARAM_STR);
        


        if ($stmt->execute()) {
            echo "";
        } else {
            echo "Error updating Nume";
        }
    }

    if (isset($_POST['updatePrenume'])) {
        // Update Prenume
        $curieriID = $_POST['curieriID'];
        $newPrenume = $_POST['newPrenume'];

        $sql = "UPDATE curieri SET Prenume = :newPrenume WHERE Curieri_ID = :curieriID";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':curieriID', $curieriID, PDO::PARAM_INT);
        $stmt->bindParam(':newPrenume', $newPrenume, PDO::PARAM_STR);
        

        if ($stmt->execute()) {
            echo "";
        } else {
            echo "Error updating Prenume";
        }
    }

    if (isset($_POST['updateVarsta'])) {
        // Update Varsta
        $curieriID = $_POST['curieriID'];
        $newVarsta = $_POST['newVarsta'];

        $sql = "UPDATE curieri SET Varsta = :newVarsta WHERE Curieri_ID = :curieriID";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':curieriID', $curieriID, PDO::PARAM_INT);
        $stmt->bindParam(':newVarsta', $newVarsta, PDO::PARAM_INT);
        

        if ($stmt->execute()) {
            echo "";
        } else {
            echo "Error updating Varsta";
        }
    }

    if (isset($_POST['updateCNP'])) {
        // Update CNP
        $curieriID = $_POST['curieriID'];
        $newCNP = $_POST['newCNP'];

        $sql = "UPDATE curieri SET CNP = :newCNP WHERE Curieri_ID = :curieriID";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':curieriID', $curieriID, PDO::PARAM_INT);
        $stmt->bindParam(':newCNP', $newCNP, PDO::PARAM_INT);
        

        if ($stmt->execute()) {
            echo "";
        } else {
            echo "Error updating CNP";
        }
    }

    if (isset($_POST['updateNumar_Permis'])) {
        // Update Numar_Permis
        $curieriID = $_POST['curieriID'];
        $newNumar_Permis = $_POST['newNumar_Permis'];

        $sql = "UPDATE curieri SET Numar_Permis = :newNumar_Permis WHERE Curieri_ID = :curieriID";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':curieriID', $curieriID, PDO::PARAM_INT);
        $stmt->bindParam(':newNumar_Permis', $newNumar_Permis, PDO::PARAM_INT);
        

        if ($stmt->execute()) {
            echo "";
        } else {
            echo "Error updating Numar_Permis";
        }
    }

    

    // Add similar blocks for other fields (Varsta, CNP, Numar_Permis) as needed...

}

// Fetch data from the 'curieri' table
$sql = "SELECT * FROM curieri";
$stmt = $pdo->query($sql);
$curieri = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Curieri</title>
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
    <h2 class="text-center mb-4"> Update Curieri Table</h2>
    <table border="1">
        <tr>
            <th>Curieri ID</th>
            <th>Nume</th>
            <th>Prenume</th>
            <th>Varsta</th>
            <th>CNP</th>
            <th>Numar_Permis</th>
            <!-- Add more headers for other fields if needed... -->
        </tr>
        <?php foreach ($curieri as $curier): ?>
            <tr>
                <td><?= $curier['Curieri_ID'] ?></td>
                <td><?= $curier['Nume'] ?></td>
                <td><?= $curier['Prenume'] ?></td>
                <td><?= $curier['Varsta'] ?></td>
                <td><?= $curier['CNP'] ?></td>
                <td><?= $curier['Numar_Permis'] ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="curieriID" value="<?= $curier['Curieri_ID'] ?>">
                        <input type="text" name="newNume" placeholder="New Nume">
                        <button type="submit" name="updateNume">Update</button>
                    </form>
                </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="curieriID" value="<?= $curier['Curieri_ID'] ?>">
                        <input type="text" name="newPrenume" placeholder="New Prenume">
                        <button type="submit" name="updatePrenume">Update</button>
                    </form>
                </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="curieriID" value="<?= $curier['Curieri_ID'] ?>">
                        <input type="text" name="newVarsta" placeholder="New Varsta">
                        <button type="submit" name="updateVarsta">Update</button>
                    </form>
                </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="curieriID" value="<?= $curier['Curieri_ID'] ?>">
                        <input type="text" name="newCNP" placeholder="New CNP">
                        <button type="submit" name="updateCNP">Update</button>
                    </form>
                </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="curieriID" value="<?= $curier['Curieri_ID'] ?>">
                        <input type="text" name="newNumar_Permis" placeholder="New Numar_Permis">
                        <button type="submit" name="updateNumar_Permis">Update</button>
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
