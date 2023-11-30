<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform registration logic here
    $username = $_POST["username"];
    $selectedCarName = $_POST["car_name"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    // Connect to the database (replace with your database credentials)
    $conn = new mysqli("localhost", "root", "strongMehohoHi@200m2", "washingcar");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the car name is already taken
    $sqlCheckCarName = "SELECT * FROM washing_car_owners WHERE car_name = '$selectedCarName'";
    $resultCheckCarName = $conn->query($sqlCheckCarName);

    // Check if the username is already taken
    $sqlCheckUsername = "SELECT * FROM washing_car_owners WHERE username = '$username'";
    $resultCheckUsername = $conn->query($sqlCheckUsername);

    if ($resultCheckCarName->num_rows > 0) {
        echo "<p style='color:white;font-weight:bold;background-color:brown'>This washing car place already has an account. Please choose another car name.</p>";
    } elseif ($resultCheckUsername->num_rows > 0) {
        echo "<p style='color:white;font-weight:bold;background-color:brown'>This username is already taken. Please choose another username.</p>";
    } else {
        // Insert user data into the database
        $sql = "INSERT INTO washing_car_owners (username, car_name, password) VALUES ('$username', '$selectedCarName', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
            header("Location: login.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}

// Fetch washing car names and owners for the dropdown list
$carList = [];
$conn = new mysqli("localhost", "root", "strongMehohoHi@200m2", "washingcar");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT DISTINCT Name FROM googl1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $carList[] = $row["Name"];
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <title>Registration</title>
</head>
<body>
    <h2>Register</h2>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Username" required><br>

        <select name="car_name" required>
            <?php foreach ($carList as $name) : ?>
                <option value="<?= $name ?>"><?= $name ?></option>
            <?php endforeach; ?>
        </select><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <div class="trafic">
            <button type="submit">Register</button>
            <a href="map.php">Home</a>
            <a href="login.php">Login</a>
        </div>
    </form>
</body>
</html>
