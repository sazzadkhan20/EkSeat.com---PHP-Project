<?php 
    require_once '../Model/checkCookie.php';
    require_once '../Model/fetchAllData.php';

    // Check if user is logged in using cookies
    $isLoggedIn = checkAuthCookieForAdmin();

    // Dynamic navigation bar based on login status
    if (!$isLoggedIn) 
        header("Location: ../View/signIn.php");
    $totalUsers = fetch_data($adquserinfotableforall)->num_rows ? : 0;
    $totalRiders = fetch_data($adqdriverinfotableforall)->num_rows ? : 0;
    $totalBookings = fetch_data($adqridebookinghistorytableforall)->num_rows ? : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css" />
  <title>Admin Dashboard</title>

  <style>
    /* Container for the cards */
.content-container {
    display: flex;
    justify-content: space-between;
    margin-left: 200px;
    padding: 20px;
    flex-wrap: wrap;
}

/* Card styles */
.card {
    color: #fff;
    background-color: #171745ff;
    width: 250px;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    margin: 10px 50px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    transition: opacity 0.3s ease-in-out;
}
.card:hover {
    cursor: pointer;
    opacity: 0.75;
}

/* Title and paragraph */
.card h4 {
    font-size: 18px;
    margin-bottom: 10px;
}

.card p {
    font-size: 14px;
    margin-bottom: 20px;
}
.big-card {
  background-color: #e5e5e5ff;
    color: #000;
    width: 550px;
    height: 300px;
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

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 5px;
    text-align: left;
    border: 1px solid #ddd;
    font-size: 12px;
}

th {
    background-color: rgba(32, 32, 95, 1);
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}


a:hover {
    text-decoration: none;
}

.img-card {
  background-color: #e5e5e5ff;
    color: #000;
    width: 550px;
    padding: 10px;
    height: auto;
    border-radius: 8px;
    text-align: center;
    margin: 10px 0px 0px 50px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease-in-out;
}
.img-card:hover {
    background: #d4d4d4ff;

  }

  </style>

</head>

<body>
  <head>
    <?php include_once 'admin_NavigationBar.php'; ?>
  </head>
  
  <body>
    <main>
      <!-- Main content goes here -->
      <section class="content-container">
          <div class="card" >
              <h1><?php echo $totalUsers; ?></h1>
              <p>Active Users</p>
          </div>
          <div class="card" >
              <h1><?php echo $totalRiders; ?></h1>
              <p>Active Riders</p>
          </div>
          <div class="card">
              <h1><?php echo $totalBookings; ?></h1>
              <p>Completed Rides</p>
          </div>           
      </section>
      
      <section class="content-container">
        <div class="img-card">
              <h4>Current Month Revenue</h4>
              <img src="Resources/adminPageGraph.png" alt="Revenue Graph" style="width:90%; height:auto; ">
          </div>   
          <div class="img-card">
              <h4>Current Month Revenue</h4>
              <img src="Resources/Profit-and-loss-graph.jpg" alt="Revenue Graph" style="width:90%; height:280px; ">
          </div>  
      </section>

      <section class="content-container">
          <div class="big-card">
              <h4>Active Users</h4>
              <a href="ManageUsers.php">📝Manage</a>
              <?php include_once '../Model/FetchAllUserInfo.php'; ?>
          </div>   
      
          <div class="big-card">
              <h4>Active Riders</h4>
              <small>[Currently Showing the User Table]</small>
              <a href="ManageUsers.php">📝Manage</a>
              <?php include_once '../Model/FetchAllRiderInfo.php'; ?>
          </div>   
      </section>

    </main> 
  </body>
</html>