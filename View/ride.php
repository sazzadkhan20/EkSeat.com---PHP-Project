<?php include_once 'nevigationBar.html'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ride Book</title>
</head>
<body>
    <main>
         <table style="padding: 80px 20px 20px 50px;">
        <tr>
            <td style="width: 250px;">
                <h2>Enjoy your ride with EkSeat.com</h2>
                <form action="">
                    <select name="pickup_location" id="pickup_location" class="input-box">
                        <option value="" disabled selected>Select Pickup Location</option>
                        <option value="location1">Location 1</option>
                        <option value="location2">Location 2</option>
                        <option value="location3">Location 3</option>
                    </select>
                    <br>
                    <select name="dropoff_location" id="dropoff_location" class="input-box">
                        <option value="" disabled selected>Select Drop-off Location</option>
                        <option value="locationA">Location A</option>
                        <option value="locationB">Location B</option>
                        <option value="locationC">Location C</option>   
                    </select>
                    <br>
                    <button class="btn">Search Ride</button>
                </form>
            </td>
            <td style="padding-left: 50px;">
                <iframe
                    width="1048"
                    height="600"
                    style="border:0"
                    loading="lazy"
                    allowfullscreen
                    referrerpolicy="no-referrer-when-downgrade"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.812502707225!2d90.42276131536516!3d23.81418198456199!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7b0b8a9a3c7%3A0x1c8e2b0b9e5b8b8b!2sJamuna%20Future%20Park!5e0!3m2!1sen!2sus!4v1633029141234!5m2!1sen!2sus">
                </iframe>
            </td>
        </tr>
       </table>
    </main>
    <?php include 'footer.html'; ?>
</body>
</html>


                