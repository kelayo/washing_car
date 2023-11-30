<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Display</title>
    <link rel="stylesheet" href="css/washingCarList.css">
</head>
<body>
    <nav>
        <h1>CleanFast</h1>
        <ul>
            <li><a href="map.php">Home</a></li>
            <li><a href="washingCarsList.php">Take Appointment</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>
    </nav>
    <h1 style="text-align:center;margin:20px">Pick One</h1>

    <!-- Filter form -->
    <form method="get" style="text-align:center">
        <input style="border-radius: 15px;border:1px solid black" type="number" id="minReviews" name="minReviews" value="" min="0" placeholder="Minimum ReviewsNumber">
        <input style="border-radius: 15px;border:1px solid black" type="number" id="minRate" name="minRate" value="" min="0" max="5" step="0.1" placeholder="Minimum Rate">

        <input type="submit" value="Filter" id="filter">
    </form>

    <?php
        // Connect to the MySQL database
        $conn = new mysqli("localhost", "root", "strongMehohoHi@200m2", "washingcar");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Default values
        $minReviews = isset($_GET['minReviews']) ? $_GET['minReviews'] : 0;
        $minRate = isset($_GET['minRate']) ? $_GET['minRate'] : 0;

        // Query to select top-rated data from the table with filtering
        $sql = "SELECT * FROM googl1 WHERE ReviewsNumber >= $minReviews AND Rate >= $minRate ORDER BY Rate DESC";
        $result = $conn->query($sql);

        // Check if there are rows in the result
        if ($result->num_rows > 0) {
            
            while ($row = $result->fetch_assoc()) {
                
                // Output HTML for each row
                echo "<div class='card'>";
                // Wrap the href in an anchor element with target="_blank"
                echo "<p><b>Name: </b>" . $row["Name"] . "</p>";
                echo "<button onclick='showMore(\"moreInfo{$row['Name']}\")'>Show More</button>";
                echo "<div class='more-info' style='display:none' id='moreInfo{$row['Name']}'>";
                echo "<p><b>Rate: </b>" . $row["Rate"] . "</p>";
                echo "<p><b>Reviews Number:</b> " . $row["ReviewsNumber"] . "</p>";
                echo "<p><b>Location: </b>" . $row["Location"] . "</p>";
                echo "<p><b>PhoneNumber:</b> " . $row["PhoneNumber"] . "</p>";
                echo "<p><a href='{$row["href"]}' target='_blank'>GO TO WASH</a></p>";
                echo "<p><a href='appointment.php?name=" . urlencode($row['Name']) . "'>Take Appointment</a></p>";
                echo "</div>";
                echo "</div>";
                
            }

        } else {
            echo "0 results";
        }

        // Close the database connection
        $conn->close();
    ?>

    <script>
        function showMore(elementId) {
            var moreInfoElement = document.getElementById(elementId);
            if (moreInfoElement.style.display === "none") {
                moreInfoElement.style.display = "block";
            } else {
                moreInfoElement.style.display = "none";
            }
        }
    </script>

</body>
</html>

