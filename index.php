<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="overlay"></div>
<div class="container">

<?php
// Initialize the error message variable
$error_message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the form handler to handle the login logic
    require_once "formhandler.inc.php";
}
?>

<div class="container">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="company-container">
            <h1 class="company-name">RapidDispatch</h1>
        </div>

        <label for="username">Username:</label>
        <input type="text" id="username" name="Username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="Password" required>

        <button type="submit">Login</button>

        <!-- Display the error message under the login button -->
        <div class="error-container">
            <?php echo $error_message; ?>
        </div>
    </form>
</div>
</div>
</body>
</html>
