<?php

require_once "dbh.inc.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selectedOption = isset($_POST['selection']) ? $_POST['selection'] : '';

    switch ($selectedOption) {
        case 'interogari_simple':
            header('Location: search_data_interogari_simple.php');
            exit();
        case 'interogari_complexe':
            header('Location: search_data_interogari_complexe.php');
            exit();
        // Add more cases for additional options if needed
    }
}
?>

<?php
header('Content-Type: text/html; charset=utf-8');

function fetchCurieriIDs($pdo) {
    $sql = "SELECT Curieri.Curieri_ID FROM Curieri";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

$dsn = "mysql:host=localhost;dbname=firma_curierat";
$dbusername = "root";
$dbpassword = "";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$rezultate = [];  // Initialize $rezultate to an empty array
$idCurierOptions = [];
$raportSelectat = '';  // Initialize $raportSelectat


$sqlDateRange = "SELECT MIN(Factura.Data_Emiterii) AS minDate, MAX(Factura.Data_Emiterii) AS maxDate FROM Factura";
$stmtDateRange = $pdo->prepare($sqlDateRange);
$stmtDateRange->execute();
$dateRange = $stmtDateRange->fetch(PDO::FETCH_ASSOC);

$minDate = $dateRange['minDate'];
$maxDate = $dateRange['maxDate'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['raport'])) {
    $raportSelectat = $_POST['raport'];

    switch ($raportSelectat) {
        case '1':// Afisarea tuturor livrarilor cu detaliile despre pachet și expeditor:
            
            $sql = "SELECT Livrare.AWB_ID, Pachet.Locatie_Plecare, Pachet.Locatie_Sosire, Date.Adresa AS Adresa_Expeditor
                    FROM Livrare
                    JOIN Pachet ON Livrare.Pachet_ID = Pachet.Pachet_ID
                    JOIN Date ON Livrare.Expeditor_ID = Date.Date_Persoana_ID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $rezultate = $stmt->fetchAll(PDO::FETCH_ASSOC);
            break;

        case '2':// Listarea detaliilor despre curieri și livrările asociate lor:
            
            $sql = "SELECT Curieri.Nume, Curieri.Prenume, Livrare.AWB_ID, Livrare.Tip
                    FROM Curieri
                    JOIN Livrare_Curier ON Curieri.Curieri_ID = Livrare_Curier.Curieri_ID
                    JOIN Livrare ON Livrare_Curier.AWB_ID = Livrare.AWB_ID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $rezultate = $stmt->fetchAll(PDO::FETCH_ASSOC);
            break;
        
        case '3':// Afisarea facturilor cu detaliile despre AWB-urile asociate și destinatari:
            
            $sql = "SELECT Factura.Factura_ID, Livrare.AWB_ID, Date.Nume_Persoana_Contact AS Nume_Destinatar
                    FROM Factura
                    JOIN Livrare ON Factura.AWB_ID = Livrare.AWB_ID
                    JOIN Date ON Livrare.Destinatar_ID = Date.Date_Persoana_ID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $rezultate = $stmt->fetchAll(PDO::FETCH_ASSOC);
            break;

        case '4':// Listarea AWB-urilor, metodelor de livrare și detaliilor despre pachetele asociate acestora:
            
            $sql = "SELECT Livrare.AWB_ID, Metoda.Denumire AS Metoda_Livrare, Pachet.Dimensiune_Lenght, Pachet.Dimensiune_Width, Pachet.Dimensiune_Height
                    FROM Livrare
                    JOIN Metoda ON Livrare.Metoda_ID = Metoda.Metoda_ID
                    JOIN Pachet ON Livrare.Pachet_ID = Pachet.Pachet_ID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $rezultate = $stmt->fetchAll(PDO::FETCH_ASSOC);
            break;
        
        case '5':// Afisarea detaliilor despre livrările expediate de un anumit curier, inclusiv informații despre pachetele asociate:
            
            // Fetch available Curieri IDs for the dropdown
            $idCurierOptions = fetchCurieriIDs($pdo);

            // Check if the form for entering $idCurier is submitted
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idCurier'])) {
                $idCurier = $_POST['idCurier'];
                $sql = "SELECT Livrare.AWB_ID, Pachet.Locatie_Plecare, Pachet.Locatie_Sosire, Pachet.Greutate
                        FROM Livrare
                        JOIN Livrare_Curier ON Livrare.AWB_ID = Livrare_Curier.AWB_ID
                        JOIN Pachet ON Livrare.Pachet_ID = Pachet.Pachet_ID
                        WHERE Livrare_Curier.Curieri_ID = :idCurier";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':idCurier', $idCurier, PDO::PARAM_INT);
                $stmt->execute();
                $rezultate = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            break;

            case '6':// Listarea facturilor emise la o anumita data, cu detaliile despre AWB-urile și destinatarii asociati:
                
            
                // Fetch available dates from the database
                $sqlAvailableDates = "SELECT DISTINCT DATE(Factura.Data_Emiterii) AS availableDate FROM Factura";
                $stmtAvailableDates = $pdo->prepare($sqlAvailableDates);
                $stmtAvailableDates->execute();
                $availableDates = $stmtAvailableDates->fetchAll(PDO::FETCH_COLUMN);
            
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selectedDate'])) {
                    $selectedDate = $_POST['selectedDate'];
            
                    $sql = "SELECT Factura.Factura_ID, Livrare.AWB_ID, Date.Nume_Persoana_Contact AS Nume_Destinatar, Factura.Data_Emiterii
                            FROM Factura
                            JOIN Livrare ON Factura.AWB_ID = Livrare.AWB_ID
                            JOIN Date ON Livrare.Destinatar_ID = Date.Date_Persoana_ID
                            WHERE DATE(Factura.Data_Emiterii) = :selectedDate";
            
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':selectedDate', $selectedDate, PDO::PARAM_STR);
                    $stmt->execute();
                    $rezultate = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                break;

                case '7':// Afisarea loactiilor de plecare si de sosire a pachetelor, ordonate dupa metoda de livrare:
                    $sql = "SELECT Livrare.AWB_ID, Pachet.Locatie_Plecare, Pachet.Locatie_Sosire, Metoda.Denumire AS Metoda_Livrare
                            FROM Livrare
                            JOIN Pachet ON Livrare.Pachet_ID = Pachet.Pachet_ID
                            JOIN Metoda ON Livrare.Metoda_ID = Metoda.Metoda_ID";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $rezultate = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    break;
                
                case '8':// Listarea tuturor livrărilor cu detaliile despre adresele expeditorului și destinatarului:
                    $sql = "SELECT Livrare.AWB_ID, Date_Adresa_Expeditor.Adresa AS Adresa_Expeditor, Date_Adresa_Destinatar.Adresa AS Adresa_Destinatar
                            FROM Livrare
                            JOIN Date AS Date_Adresa_Expeditor ON Livrare.Expeditor_ID = Date_Adresa_Expeditor.Date_Persoana_ID
                            JOIN Date AS Date_Adresa_Destinatar ON Livrare.Destinatar_ID = Date_Adresa_Destinatar.Date_Persoana_ID";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $rezultate = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    break;


        default:
            echo "Alegeți un raport.";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raporturi Livrare</title>

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

        .logout-container {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        
        .logout-button {
            padding: 20px;
            margin-top: 20px;
            border-radius: 10%;
            cursor: pointer;
            border: 3px solid #000;
            outline: none;
            font-weight: bold;
            font-size: 18px;
            color: #0d0000; /* Change this to your desired text color */
            background-color: #ffcc00; /* Change this to your desired background color */
        }

        .hello-button {
    background-color: #ffcc00; /* Blue background */
    color: #0d0000; 
    padding: 15px 25px; /* Adjust padding as needed */
    border-radius: 25px; /* Adjust border radius as needed */
    cursor: pointer;
    margin-top: 20px;
    border: 3px solid #000;
    outline: none;
    font-weight: bold; /* Make the text bold */
    font-size: 18px; /* Set the desired font size */
    position: absolute;
    top: 10px;
    left: 10px;
    font-family: 'Courier New', Courier, monospace;
}


        .submit-button {
            padding: 20px;
            margin-top: 20px;
            border-radius: 10%;
            cursor: pointer;
            border: 3px solid #000;
            outline: none;
            font-weight: bold;
            font-size: 18px;
            color: #fff; /* Change this to your desired text color */
            background-color: #3498db; /* Change this to your desired background color */
        }

        select {
            padding: 20px;
            margin-top: 20px;
            border-radius: 10%;
            cursor: pointer;
            border: 3px solid #000;
            outline: none;
            font-weight: bold;
            font-size: 18px;
            color: #fff; /* Change this to your desired text color */
            background-color: #3498db; /* Change this to your desired background color */
        }

        label {
            font-family: 'Quicksand', sans-serif;
            font-size: 18px;
            color: #fff; /* Change this to your desired text color */
            margin-bottom: 10px;
            font-weight: bold; /* Make the label text bold */
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

    .insert-data-button button:hover {
        background-color: #e5b800;
    }
    </style>
</head>
<body>

<h1 class="company-name">Interogari Simple</h1>

    <ul class="nav">
    <li class="nav-item">
        <button class="hello-button" onclick="goToHome()"><?php echo htmlspecialchars($username); ?></button>
    </li>
    <li class="nav-item">
        <a class="nav-link insert-data-button" href="search_data.php">
            <button class="btn btn-primary">
                <span>&larr; </span>
            </button>
        </a>
    </li>
</ul>


        <div class="logout-container">
            <button class="logout-button" onclick="logout()">Logout</button>
        </div>
    </div>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="raportForm">
    <label for="raport">Selectează un raport:</label>
    <select name="raport" id="raport">
    <option value="1" <?php echo ($raportSelectat == '1') ? 'selected' : ''; ?>>1. Afisarea tuturor livrarilor cu detaliile despre pachet și expeditor:</option>
    <option value="2" <?php echo ($raportSelectat == '2') ? 'selected' : ''; ?>>2. Listarea detaliilor despre curieri și livrările asociate lor:</option>
    <option value="3" <?php echo ($raportSelectat == '3') ? 'selected' : ''; ?>>3. Afisarea facturilor cu detaliile despre AWB-urile asociate și destinatari:</option>
    <option value="4" <?php echo ($raportSelectat == '4') ? 'selected' : ''; ?>>4. Listarea AWB-urilor, metodelor de livrare și detaliilor despre pachetele asociate acestora:</option>
    <option value="5" <?php echo ($raportSelectat == '5') ? 'selected' : ''; ?>>5. Afisarea detaliilor despre livrările expediate de un anumit curier, inclusiv informații despre pachetele asociate:</option>
    <option value="6" <?php echo ($raportSelectat == '6') ? 'selected' : ''; ?>>6. Listarea facturilor emise la o anumita data, cu detaliile despre AWB-urile și destinatarii asociati:</option>
    <option value="7" <?php echo ($raportSelectat == '7') ? 'selected' : ''; ?>>7. Afisarea loactiilor de plecare si de sosire a pachetelor, ordonate dupa metoda de livrare:</option>
    <option value="8" <?php echo ($raportSelectat == '8') ? 'selected' : ''; ?>>8. Listarea tuturor livrărilor cu detaliile despre adresele expeditorului și destinatarului</option>

</select>



    <?php if ($raportSelectat == '5') : ?>
    <br>
    <label for="idCurier">Selectați ID-ul curierului:</label>
    <select name="idCurier" id="idCurier" required>
        <?php foreach ($idCurierOptions as $curierID) : ?>
            <option value="<?php echo $curierID; ?>"><?php echo $curierID; ?></option>
        <?php endforeach; ?>
    </select>
    
<?php endif; ?>

<?php if ($raportSelectat == '6') : ?>
    <br>
    <label for="selectedDate">Selectați data:</label>
    <select name="selectedDate" id="selectedDate" required>
        <?php foreach ($availableDates as $date) : ?>
            <option value="<?php echo $date; ?>"><?php echo $date; ?></option>
        <?php endforeach; ?>
    </select>
    
<?php endif; ?>
    <input type="submit" value="Afișează" class = "logout-button">
</form>

<?php if (!empty($rezultate)) : ?>
    
    <table border='1' style="background-color: white;">
        <!-- Display column headers -->
        <tr>
            <?php foreach ($rezultate[0] as $column => $value) : ?>
                <th><?php echo $column; ?></th>
            <?php endforeach; ?>
        </tr>
        <!-- Display data rows -->
        <?php foreach ($rezultate as $row) : ?>
            <tr>
                <?php foreach ($row as $value) : ?>
                    <td><?php echo $value; ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

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
