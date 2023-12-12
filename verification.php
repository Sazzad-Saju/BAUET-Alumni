<?php
session_start();

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "alumni";

$connection = mysqli_connect($servername, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = isset($_GET['email']) ? urldecode($_GET['email']) : (isset($_SESSION['email']) ? $_SESSION['email'] : null);
$verify = isset($_GET['verify']) ? $_GET['verify'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $code = $_POST['code'];
    // Retrieve email from URL parameters

    // Validate user credentials
    $query = "SELECT * FROM students WHERE email = '$email' AND verification = '$code'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        $updateQuery = "UPDATE students SET verify = 1 WHERE email = '$email' AND verification = '$code'";
        $updateResult = mysqli_query($connection, $updateQuery);
        // Redirect to login page
        header('Location: login.php'.'?verify=1');
        exit;
    }else{
        header('Location: verification.php?email=' . urlencode($email) . '&verify=0');
        exit;
    }
}

mysqli_close($connection);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="login.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="hf.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    />
    <link type="image/png" sizes="16x16" rel="icon" href="images/favicon.png">
    <title>Verification</title>
</head>
<body>
<?php
include 'nav.php';
?>

    <div class="container">
        <h2>Verification</h2>
        <?php echo 'Verification code has been sent to '. $email; ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="text" id="code" name="code" placeholder="Enter your code" required min="6" max="6" /><br />
            <input type="submit" value="Submit" class="submit-button" />
            <?php
                if (isset($verify) && $verify == 0) {
                    echo "<p class='error-message'>Invalid code.</p>";
                }
            ?>
          </form>
    </div>
    <?php
include 'footter.php';
?>
</body>
</html>

