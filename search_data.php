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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirect Based on Selection</title>

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
    <h1 class="company-name">Search Data</h1>

    <ul class="nav">
    <li class="nav-item">
        <button class="hello-button" onclick="goToHome()"><?php echo htmlspecialchars($username); ?></button>
    </li>
    <li class="nav-item">
        <a class="nav-link insert-data-button" href="home.php">
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

    <div>
        <form action="search_data.php" method="post">
            <label for="selection">Choose an option:</label>
            <select id="selection" name="selection" class="dropdown-button">
                <option value="interogari_simple">Interogari Simple</option>
                <option value="interogari_complexe">Interogari Complexe</option>

                
                <!-- Add more options if needed -->
            </select>
            <button type="submit" class="submit-button">Submit</button>
        </form>
    </div>

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


