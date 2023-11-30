<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Retrieve the washing car name from the session
if (!isset($_SESSION['car_name'])) {
    echo "Invalid request. Please log in.";
    exit();
}

$washingCarName = $_SESSION['car_name'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_appointment"])) {
    $appointmentIdToDelete = $_POST["delete_appointment"];
}else{
    $appointmentIdToDelete = null;
}



// Connect to the database (replace with your database credentials)
$conn = new mysqli("localhost", "root", "strongMehohoHi@200m2", "washingcar");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    // Delete the appointment with the specified ID
    $sqlDeleteAppointment = "DELETE FROM appointments WHERE id = '$appointmentIdToDelete'";
    if ($conn->query($sqlDeleteAppointment) === TRUE) {
        // Appointment deleted successfully
    } else {
        // Error deleting appointment
        echo "Error deleting appointment: " . $conn->error;
    }

// Query to retrieve appointments for the specific washing car
$sqlAppointments = "SELECT * FROM appointments WHERE washing_car_name = '$washingCarName'";
$resultAppointments = $conn->query($sqlAppointments);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Dashboard</title>
    <style>
        .buttonSpecil {
            /* Your existing button styles here */
            background-color:  #007bff;;
            color: white;
            padding: 10px 20px;
            border: none;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>

</head>
<body>
    <nav>
        <h1>CleanFast</h1>
        <ul>
            <li><a href="map.php">Home</a></li>
            <li><a href="login.php">Logout</a></li>
        </ul>
    </nav>
    <h2>Appointments Dashboard for <?php echo $washingCarName; ?></h2>

    <?php if ($resultAppointments->num_rows > 0) : ?>
        <table border="1">
            <tr>
                <th>Appointment ID</th>
                <th>Washing Car Name</th>
                <th>Appointment Date</th>
                <th>Status</th>
                <th>Action</th>
                <th>Delete</th>
            </tr>
            <?php while ($rowAppointment = $resultAppointments->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $rowAppointment['id']; ?></td>
                    <td><?php echo $rowAppointment['washing_car_name']; ?></td>
                    <td><?php echo $rowAppointment['appointment_datetime']; ?></td>
                    <td><?php echo $rowAppointment['status']; ?></td>
                    <td><button  class="buttonSpecil sendMessageButton" onclick="sendMessage('<?php echo $rowAppointment['client_phone']; ?>')">Send Message</button></td>
                    <td>
                    <!-- Add a form with a hidden input to submit the appointment ID to delete -->
                        <form method="post">
                            <input type="hidden" name="delete_appointment" value="<?php echo $rowAppointment['id']; ?>">
                            <button type="submit" class="buttonSpecil" onclick="return confirm('Are you sure you want to delete this appointment?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else : ?>
        <p>No appointments found for <?php echo $washingCarName; ?>.</p>
    <?php endif; ?>

    <footer>
        <ul>
            <li><a href="map.php">Home</a></li>
            <li><a href="login.php">Logout</a></li>
        </ul>
        <div>
            <address>ENSA FES,Numero 38774</address>
        </div>
        <div class="socialMedia">
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-brands fa-twitter"></i>
            <i class="fa-brands fa-youtube"></i>
            <i class="fa-brands fa-tiktok"></i>
        </div>
    </footer>

    <script>

        function sendMessage(phoneNumber) {
            // Replace the placeholder link with the actual WhatsApp API link
            var message = encodeURIComponent("Your car is ready. You can come and pick it up.");
            var whatsappLink = 'https://api.whatsapp.com/send?phone=' + phoneNumber + '&text=' + message;
            
            // Open the WhatsApp API link in a new window
            window.open(whatsappLink, '_blank');
        }
    </script>
</body>
</html>
