 <?php include_once 'userNavBar.html';?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>EkSeat.com</title>
</head>
<body>
    <main>
       <table id="rideTable">
            <tr>
                <td id="Location_Navigation" style="padding: 50px 100px;">
                    <h2>Set Your Location</h2>
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
                    <label for="Vehicle_Type">Select Vehicle Type:</label>
                  
                    <br>
                    
                    <button class="btn">Search Ride</button>
                </td>
                <td id="Map_Display">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434509949!2d144.9537353153165!3d-37.81627997975157!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11f5b5%3A0x5045675218ceed30!2sMelbourne%20CBD%2C%20Victoria%2C%20Australia!5e0!3m2!1sen!2sus!4v1616161616161!5m2!1sen!2sus  " frameborder="0" height="450px" width="800px"></iframe>
                </td>
            </tr>
        </table>      
    </main>
    
    
    <?php include 'footer.html'; ?>
</body>
</html>