 <?php include_once 'nevigationBar.html';?>
 
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
       <table style="padding: 80px 20px 20px 50px;">
        <tr>
            <td style="padding-right: 150px;">
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
            <td style="padding-left: 150px;">
                <?php include 'slideShow.html'; ?>
            </td>
        </tr>
       </table>
        
    </main>
    
    
    <?php include 'footer.html'; ?>
</body>
</html>