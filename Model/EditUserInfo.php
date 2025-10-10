<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "ekseat_com"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user ID from the URL
$user_id = $_GET['id'];

// Fetch user data from the database
$sql = "SELECT * FROM userinfo WHERE uNID = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// If user data is not found
if (!$user) {
    echo "User not found!";
    exit();
}

// Process the form submission if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uNID = $_POST['uNID'];
    $uName = $_POST['uName'];
    $uPhone = $_POST['uPhone'];
    $uEmail = $_POST['uEmail'];
    $uPassword = $_POST['uPassword'];
    
    // Update user data in the database
    $update_sql = "UPDATE users SET uNID='$uNID', uName='$uName', uPhone='$uPhone', uEmail='$uEmail', uPassword='$uPassword' WHERE uID=$user_id";
    
    if ($conn->query($update_sql) === TRUE) {
        echo "User information updated successfully!";
        header('Location: view_users.php'); // Redirect back to the user list page
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Information</title>
    
    <style>
        /* General page styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        /* Form container styling */
        .form-container {
            width: 50%;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Heading style */
        h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 30px;
        }

        /* Table form styling */
        .edit-table {
            width: 100%;
            border-collapse: collapse;
        }

        .edit-table td {
            padding: 10px;
            font-size: 16px;
        }

        .edit-table td label {
            font-weight: bold;
            color: #333;
        }

        .edit-table td input {
            width: 90%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        /* Focus effect on input fields */
        .edit-table td input:focus {
            border-color: #4CAF50;
            outline: none;
        }

        /* Submit button style */
        .submit-row {
            text-align: center;
        }

        .submit-row input {
            background-color: #201261ff;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-right: 10px;
        }

        .submit-row input:hover {
            background-color: #45a049;
        }

        /* Cancel button style */
        .cancel-row {
            text-align: center;
            margin-top: 10px;
        }
        .cancel-row input {
            background-color: #201261ff;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .cancel-row input:hover {
            background-color: #e53935;
        }
        .cancel-row input:enabled:hover {
            background-color: #1ae02bff;
        }
        #cancelBtn:hover {
            background-color: #e02e1aff;
        }
        /* Disabled button style */
        .submit-row input:disabled, .cancel-row input:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

    </style>

</head>
<body>
    <div class="form-container">
        <h2>Edit User Information</h2>
        <form action="edit_user.php?id=<?php echo $user_id; ?>" method="post" id="editForm">
            <table class="edit-table">
                <tr class="cancel-row">
                    <td colspan="2" class="cancel-row">
                        <input type="button" value="Edit" id="editBtn" onclick="enableEdit()">
                        <input type="button" value="Cancel" id="cancelBtn" onclick="cancelEdit()" disabled>
                    </td>
                </tr>
                <tr>
                    <td><label for="uNID">NID Number:</label></td>
                    <td><input type="text" id="uNID" name="uNID" value="<?php echo $user['uNID']; ?>" required disabled></td>
                </tr>
                <tr>
                    <td><label for="uName">Name:</label></td>
                    <td><input type="text" id="uName" name="uName" value="<?php echo $user['uName']; ?>" required disabled></td>
                </tr>
                <tr>
                    <td><label for="uPhone">Phone Number:</label></td>
                    <td><input type="text" id="uPhone" name="uPhone" value="<?php echo $user['uPhone']; ?>" required disabled></td>
                </tr>
                <tr>
                    <td><label for="uEmail">Email Address:</label></td>
                    <td><input type="email" id="uEmail" name="uEmail" value="<?php echo $user['uEmail']; ?>" required disabled></td>
                </tr>
                <tr>
                    <td><label for="uPassword">Password:</label></td>
                    <td><input type="password" id="uPassword" name="uPassword" value="<?php echo $user['uPassword']; ?>" required disabled></td>
                </tr>
                <tr>
                    <td colspan="2" class="submit-row">
                        <input type="submit" value="Update User" id="updateBtn" disabled>
                    </td>
                </tr>
                
            </table>
        </form>
    </div>

    <script>
        // Initial values stored for comparison
        const initialValues = {
            uNID: "<?php echo $user['uNID']; ?>",
            uName: "<?php echo $user['uName']; ?>",
            uPhone: "<?php echo $user['uPhone']; ?>",
            uEmail: "<?php echo $user['uEmail']; ?>",
            uPassword: "<?php echo $user['uPassword']; ?>"
        };

        // Function to enable form fields for editing
        function enableEdit() {
            var inputs = document.querySelectorAll("input");
            inputs.forEach(function(input) {
                input.disabled = false; // Enable input fields
            });
            document.getElementById("updateBtn").disabled = false; // Enable update button
            document.getElementById("cancelBtn").disabled = false; // Enable cancel button
            document.getElementById("editBtn").disabled = true; // Disable edit button
        }

        // Function to disable form fields when cancel button is clicked
        function cancelEdit() {
            var inputs = document.querySelectorAll("input");
            inputs.forEach(function(input) {
                input.disabled = true; // Disable input fields
            });
            document.getElementById("updateBtn").disabled = true; // Disable update button
            document.getElementById("cancelBtn").disabled = true; // Disable cancel button
            document.getElementById("editBtn").disabled = false; // Enable edit button

            // Reset values to initial values
            document.getElementById("uNID").value = initialValues.uNID;
            document.getElementById("uName").value = initialValues.uName;
            document.getElementById("uPhone").value = initialValues.uPhone;
            document.getElementById("uEmail").value = initialValues.uEmail;
            document.getElementById("uPassword").value = initialValues.uPassword;
        }

        // Check if any changes were made and enable the update button
        document.querySelectorAll("input").forEach(function(input) {
            input.addEventListener("input", function() {
                // Compare the current value with the initial value
                if (input.value !== initialValues[input.name]) {
                    document.getElementById("updateBtn").disabled = false; // Enable update button if any changes are made
                } else {
                    document.getElementById("updateBtn").disabled = true; // Disable update button if no changes
                }
            });
        });
    </script>

</body>
</html>

<?php
// Close the connection
$conn->close();
?>
