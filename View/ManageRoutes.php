<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css" />
  <title>Admin Dashboard</title>

  <style>
.content-container {
    display: flex;
    justify-content: space-between;
    margin-left: 200px;
    padding: 20px;
    flex-wrap: wrap;
}

.big-card {
  background-color: #e5e5e5ff;
    color: #000;
    width: 600px;
    height: auto ;
    padding: 10px;
    border-radius: 8px;
    text-align: center;
    margin: 10px 0px 0px 50px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease-in-out;
}
.big-card:hover {
    background: #d4d4d4ff;
}
.big-card h4 {
  display: inline-block;
    font-size: 18px;
    margin-bottom: 10px;
    text-align: left;
}
.big-card a {
  color:black; 
  float: right; 
  margin-top: 10px;
  display:inline-block;
}
.big-card a:hover {
  color: #0633e8ff;
}
h1
{
    text-align:center;
    color: #03034aff;
}
.input_box {
  width: 90%;
  padding: 12px 15px;
  margin: 12px 0;
  border-radius: 8px;
  border: 0.5px solid rgba(48, 65, 99, 1);
  font-size: 14px;
}
.Route_btn {
  width: 80%;
  padding: 12px 0;
  margin-top: 10px;
  background: rgba(48, 65, 99, 1);
  color: white;
  font-size: 16px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
}

  </style>

</head>

<body>
  <head>
    <?php include_once 'admin_NavigationBar.html'; ?>
  </head>
  
  <body>
    <main>
      <!-- Main content goes here -->
        <section class="content-container">
            <div class="big-card">
                <h1>Add new Locations</h1>
                <form action="" method="post">
                    <input type="text" name="start_location" placeholder="Start Location" class="input_box" required />
                    <input type="text" name="end_location" placeholder="End Location" class="input_box" required />
                    <input type="number" name="distance" placeholder="Distance (in km)" class="input_box" required />
                    <button type="submit" class="Route_btn">Add Route</button>
                    
                </form>
            </div>
        </section>
        <section class="content-container">
        <div>
            <h3>Instructions to Add new Locations</h3>
            <ol>
                <li>Fill in the Start Location field with the starting point of the route.</li>
                <li>Fill in the End Location field with the destination point of the route.</li>
                <li>Enter the distance between the two locations in kilometers in the Distance field.</li>
                <li>After filling in all the fields, click the "Add Route" button to save the new route to the system.</li>
                <li>Ensure that all fields are filled out correctly to avoid errors.</li>
            </ol>
        </div>
        </section>

    </main> 
  </body>
</html>