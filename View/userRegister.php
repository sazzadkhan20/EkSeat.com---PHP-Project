<?php include_once 'nevigationBar.html'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>User Registration</title>
</head>
<body>
    <div>
       <center><h3 style="margin-bottom: 50px;">Select User Type</h3></center>
        <button id="userButton"><img src="Resources/userIcon.png" alt="Logo1" class="box-logo" /></button>
        <button id="driverButton"> <img src="Resources/driverIcon.png" alt="Logo1" class="box-logo" /></button>
    </div>

    <div id="user_Registration" style="display:none;">
        <form action="../Model/register.php" id="register_User" method="post" onsubmit="return ValidateUserForm()">
            
            <div id="double_input">
                <input type="text" id="Name" name = "Name" placeholder="Name" class="input-box" required/>
            </div>
            
            <div id="double_input">                
                <input type="number" id="Phone"name = "Phone"  placeholder="Phone" class="input-box" required/>
                <input type="text" id="NID" name = "NID" placeholder="NID" class="input-box" required/>
            </div>

            <div id="double_input">
                <input type="password" id="password" name = "password"  placeholder="Create a password" class="input-box" required/>
                <input type="password" id="confirmPassword" placeholder="Confirm your password" class="input-box" required/>

            </div>
            <div>
                <p id="errorMessage" style="color: red;"></p>
            </div>
           <button type="submit" class="btn">Let's Get Started</button>
            
        </form>

    </div>  
    
    <div id="driver_Registration" style="display:none;">
        <form action="" id="register_Driver" method="post" onsubmit="return validateDriverForm()">
        
            <div id="double_input">
                <input type="text" id="Name2" placeholder="Name" class="input-box" required/>
            </div>
 
            <div id="double_input">
                <input type="text" id="Phone2" placeholder="Phone" class="input-box" required/>
                <input type="number" id="NID2" placeholder="NID" class="input-box" required/>
            </div>

            <div id="double_input">
                <input type="text" id="address" placeholder="Address" class="input-box" required/>
            </div>
                        
            <div id="double_input">
                <select name="vehicle_type" id="vehicle_type" class="input-box" required>
                    <option value="" disabled selected>Select Vehicle Type</option>
                    <option value="car">Car</option>
                    <option value="bike">Bike</option>
                </select>
            </div>
            <div id="double_input">
                <input type="password" id="password2" placeholder="Create a password" class="input-box" required/>
                <input type="password" id="confirmPassword2" placeholder="Confirm your password" class="input-box" required/>
            </div>
            <div>
                <p id="errorMessage2" style="color: red;"></p>
            </div>

            <button type="submit" class="btn">Let's Get Started</button>
        </form>

    </div>    
    <script src="../Controller/registrationFormValidation.js"></script>
</body>
</html>