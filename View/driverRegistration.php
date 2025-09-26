<?php include_once 'nevigationBar.html'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Driver Registration</title>
</head>
<body>
    <section id="driver_Registration">
        <form action="" id="register_Driver" method="post">
            <img src="Resources/driverIcon.jpg" alt="Logo1" class="box-logo" />
            <div id="double_input">
                <input type="text" placeholder="Name" class="input-box" required/>
                <input type="number" placeholder="NID" class="input-box" required/>
            </div>

            <div id="double_input">
                <input type="text" placeholder="email" class="input-box" required/>
                <input type="text" placeholder="Phone" class="input-box" required/>
            </div>

            <div id="double_input">
                <input type="text" placeholder="Address" class="input-box" required/>
            </div>
                        
            <div id="double_input">
                <select name="vehicle_type" id="vehicle_type" class="input-box" required>
                    <option value="" disabled selected>Select Vehicle Type</option>
                    <option value="car">Car</option>
                    <option value="bike">Bike</option>
                </select>
            </div>
            <div id="double_input">
                <input type="password" placeholder="Create a password" class="input-box" required/>
            <input type="password" placeholder="Confirm your password" class="input-box" required/>
            </div>

            <button class="btn"><a href="home.php">Let's Get Started</a></button>
        </form>

    </section>  
    <?php include 'footer.html'; ?>
</body>
</html>