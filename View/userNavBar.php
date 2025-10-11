<header>
  <div id="navbar">
    <div>
      <a href="home.php" id="nav_link"><img src="Resources/shortlogo.png" alt="Main Logo" id="Nav_Logo" /></a>
    </div>
    <div id="navbar_TD"><a href="drive.php" id="nav_link">Drive</a></div>
    <div id="navbar_TD"><a href="ride.php" id="nav_link">Ride</a></div>
    <div id="navbar_TD"><a href="ride.php" id="nav_link">Rentals</a></div>
    <div id="navbar_TD">
      <a href="aboutUs.php" id="nav_link">About Us</a>
    </div>
    <div id="navbar_TD">
    </div>
    <div class="user-menu-wrap" style="width: 80%; text-align: right">
      <button id="userMenuBtn" class="icon-btn" aria-haspopup="true" aria-expanded="false">
        <img src="Resources/usericon.png" alt="User Icon" style="width: 50px; height: 50px" />
      </button>

      <div id="userMenu" class="menu-panel" role="dialog" aria-label="Account menu">
        <div class="menu-header">
          <div class="avatar">
            <img src="" alt="User picture" style="width: 52px; height: 52px" />
          </div>
          <div>
            <div class="name"><?php echo $_COOKIE['user_name'] ?></div>
            <div class="sub">User</div>
          </div>
        </div>

        <div class="menu-grid">
          <a href="#" class="tile">Wallet</a>
          <a href="#" class="tile">Activity</a>
        </div>

        <ul class="menu-list">
          <li><a href="userProfile.php">Manage account</a></li>
          <li><a href="ride.php">Ride</a></li>
          <li><a href="drive.php">Drive &amp; deliver</a></li>
        </ul>

        <a href="../Model/logout.php" class="signout">Sign out</a>
      </div>
  </div>
  </nav>
  <script src="userMenu.js"></script>
</header>