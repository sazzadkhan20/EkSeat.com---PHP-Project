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
    width: 1100px;
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

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 5px;
    text-align: left;
    border: 1px solid #ddd;
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
h1{
    text-align:center;
    margin-left: 200px;
    color: #03034aff;
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
      <h1>View and Edit All User Information</h1>
      

      <section class="content-container">
          <div class="big-card">
              <h4>Active Users</h4>
              <?php include_once '../Model/FetchAllUserInfo.php'; ?>
          </div>   
        
      </section>

    </main> 
  </body>
</html>