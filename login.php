<?php
session_start();

// Check if the user is already logged in, redirect to the dashboard

// if (isset($_SESSION['user_id'])) {
//     header("Location: dashboard.php");
//     exit();
// }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform login logic here
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Connect to the database (replace with your database credentials)
    $conn = new mysqli("localhost", "root", "strongMehohoHi@200m2", "washingcar");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to check if the username and password match
    $sql = "SELECT id, username, car_name, password FROM washing_car_owners WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, set session variables and redirect to dashboard
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['car_name'] = $row['car_name'];

            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Username"required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <div class="trafic">
            <button type="submit">Login</button>
            <a href="map.php">Home</a>
            <a href="register.php">Register</a>
        </div>

    </form>
</body>
</html>
