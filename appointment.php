<?php
session_start();

// Initialize the message variable
$message = "";

// Check if the washing car name is provided in the URL
if (!isset($_GET['name'])) {
    echo "Invalid request. Please select a washing car.";
    exit();
}

$washingCarName = urldecode($_GET['name']);

// Connect to the database (replace with your database credentials)
$conn = new mysqli("localhost", "root", "strongMehohoHi@200m2", "washingcar");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data
    $selectedDateTime = $_POST["appointment_datetime"];
    $clientPhoneNumber = $_POST["client_phone"]; // New line to get client phone number

    // Check if the appointment already exists for the specified date and washing car
    $sqlCheckAvailability = "SELECT * FROM appointments WHERE washing_car_name = '$washingCarName' AND appointment_datetime = '$selectedDateTime'";
    $resultCheckAvailability = $conn->query($sqlCheckAvailability);

    if ($resultCheckAvailability->num_rows > 0) {
        // Appointment already taken
        $message = "Sorry, the appointment for $washingCarName on $selectedDateTime is already taken. Please choose another date or washing car.";
    } else {
        // Insert a new record into the appointments table with client phone number
        $sqlInsertAppointment = "INSERT INTO appointments (washing_car_name, appointment_datetime, status, client_phone) VALUES ('$washingCarName', '$selectedDateTime', 'taken', '$clientPhoneNumber')";

        if ($conn->query($sqlInsertAppointment) === TRUE) {
            $message = "Appointment scheduled successfully!";
        } else {
            $message = "Error: " . $sqlInsertAppointment . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/appointment.css">
    <title>Appointment</title>
    <style>
        input[type="datetime-local"]::-webkit-calendar-picker-indicator {
            filter: invert(1); /* Invert the color to make it white */
        }
    </style>
</head>
<body>
    <h2>Appointment for <?php echo $washingCarName; ?></h2>
    
    <!-- Display the message -->
    <?php if (!empty($message)) : ?>
        <p style="color:white;font-weight:bold;background-color:brown;"><?php echo $message; ?></p>
    <?php endif; ?>

    <!-- Appointment form -->
    <form method="post">
        <label for="appointment_datetime">Select Appointment Date and Time:</label>
        <input type="datetime-local" id="appointment_datetime" name="appointment_datetime" required>
        
        <!-- New input field for client phone number -->
        <label for="client_phone">Enter Your Phone Number:</label>
        <input type="text" id="client_phone" name="client_phone" required>
        
        <div class="traffic">
            <input type="submit" class="buttonSpecil" value="Schedule Appointment">
            <a href="map.php">Home</a>
            <a href="washingCarsList.php">Go Back</a>
        </div>
    </form>
</body>
</html>
