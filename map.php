<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/map.css">
    <style>
        #Services .contenair div{

        transition: transform 0.3s ease;/* Smooth transition effect*/
        cursor: pointer;
        }
        #Services .contenair div:hover {
            transform: rotate(-8deg) scale(0.9);
            background-color:#333;
            color:white;
        }
    </style>

</head>
<body>

    <nav>
        <h1>CleanFast</h1>
        <ul>
            <li><a href="map.php">Home</a></li>
            <li><a href="washingCarsList.php">Take Appointment</a></li>
            <li><a href="#AboutUs">About Us</a></li>
            <li><a href="#Services">Services</a></li>
            <li><a href="#contact">Contact Us</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>
    </nav>
    <section class="landing">
       <h2>HAPPY TO SEE YOU HERE</h2>
       <h2 id="second">CLICK HERE TO START YOUR JOURNY</h2>
       <a href="washingCarsList.php" target="_blank">Wash Now</a>


    </section>
    <section id="AboutUs">
        <div class="contenaire">
            <h2>About Us</h2>
            <p>Welcome to CleanFast, where excellence in car washing meets exceptional service. With a passion for providing top-notch automotive care, we have been proudly serving our community since 2024. Our team of dedicated professionals is committed to delivering an unparalleled car washing experience, ensuring that your vehicle not only looks its best but also receives the care it deserves.
                At CleanFast, we prioritize quality and customer satisfaction. Our state-of-the-art facilities are equipped with the latest technology to deliver efficient and environmentally friendly car washing services. Whether you're a regular customer or visiting us for the first time, our friendly staff is here to make sure you leave with a sparkling clean vehicle and a smile on your face.
                As a locally-owned and operated business, we take pride in being an integral part of the community. Our commitment goes beyond washing cars; we strive to create a positive impact by supporting local initiatives and fostering a sense of community. Thank you for choosing CleanFast – your trusted partner in car care.
            </p>
        </div>
    </section>
    <section id="Services">
        <div class="contenaire">
            <h2>Services</h2>
            <div class="contenair">
                <div>
                    <h3>Express Wash</h3>
                    <p>Our express wash is ideal for busy individuals seeking a quick yet effective clean. In just a short amount of time, we'll have your car looking refreshed and ready to hit the road.</p>
                </div>
                <div>
                    <h3>Deluxe Detailing</h3>
                    <p>For those who crave a deeper level of care, our deluxe detailing service is a comprehensive solution. Our skilled technicians will meticulously clean both the interior and exterior, leaving your car in pristine condition.</p>
                </div>
                <div>
                    <h3>Environmentally Friendly Options</h3>
                    <p>At CleanFast, we prioritize sustainability. Choose our eco-friendly wash options, and experience a spotless car while minimizing environmental impact.</p>
                </div>
                <div>
                    <h3>Membership Programs</h3>
                    <p>Enjoy the benefits of our exclusive membership programs, designed to provide cost savings and additional perks for our loyal customers. Join the CleanFast family and experience the ultimate in car care.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="contact">
        <h2>Contact Us</h2>
        <div>
            <form action="mail.php" method="POST">
                <!-- <label for="name">Name:</label> -->
                <input type="text" name="name" id="name" placeholder="Name">
                <!-- <label for="email">Email:</label> -->
                <input type="email" name="email" id="email" placeholder="Email">
                <!-- <label for="subject">Subject:</label> -->
                <input type="text" name="subject" id="subject" placeholder="subject">
                <!-- <label for="message">Message</label> -->
                <textarea name="message" cols="30" rows="10" placeholder="Message"></textarea>
                <input type="submit" value="Send" class="buttonD">
            </form>
            <img src="css/5138237.jpg" alt="">
        </div>
    </section>
    <footer>
        <ul>
        <li><a href="map.php">Home</a></li>
            <li><a href="washingCarsList.php">Take Appointment</a></li>
            <li><a href="#About_Us">About Us</a></li>
            <li><a href="#Services">Services</a></li>
            <li><a href="#contact">Contact Us</a></li>
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
</body>
</html>

