<?php
function checkAuthCookie() {
    $isLoggedIn = false;
    
    // Check if auth cookie exists
    if (isset($_COOKIE['user_login']) && isset($_COOKIE['login_time'])) {
        $login_time = $_COOKIE['login_time'];
        $current_time = time();
        $timeout = 24 * 60 * 60; // 24 hours timeout (change as needed)
        
        // Check if session has expired
        if (($current_time - $login_time) > $timeout) {
            // Session expired - clear cookies
            setcookie("user_login", "", time() - 3600, "/");
            setcookie("login_time", "", time() - 3600, "/");
            setcookie("user_name", "", time() - 3600, "/");
            setcookie("user_phone","", time() - 3600, "/");
            setcookie("user_nid","", time() - 3600, "/");
            setcookie("user_address","", time() - 3600, "/");
            setcookie("user_totalTransaction","", time() - 3600, "/");
            setcookie("user_registerDate","", time() - 3600, "/");
            setcookie("user_points","", time() - 3600, "/");
            $isLoggedIn = false;
        } else {
            $isLoggedIn = true;
        }
    } else {
        $isLoggedIn = false;
    }
    
    return $isLoggedIn;
}

function getUserFromCookie() {
    if (isset($_COOKIE['user_name'])) {
        return $_COOKIE['user_name'];
    }
    return null;
}

function checkAuthCookieForDriver() {
    $isLoggedIn = false;
    
    // Check if auth cookie exists
    if (isset($_COOKIE['driver_email']) && isset($_COOKIE['login_time'])) {
        $login_time = $_COOKIE['login_time'];
        $current_time = time();
        $timeout =  24 * 60 * 60; // 24 hours timeout (change as needed)
        
        // Check if session has expired
        if (($current_time - $login_time) > $timeout) {
            // Session expired - clear cookies
            setcookie("driver_email", "", time() - 3600, "/");
            setcookie("login_time", "", time() - 3600, "/");
            setcookie("driver_name", "", time() - 3600, "/");
            setcookie("driver_id", "", time() - 3600, "/");
            setcookie("driver_nid", "", time() - 3600, "/");
            setcookie("driver_phone", "", time() - 3600, "/");
            setcookie("driver_password", "", time() - 3600, "/");
            setcookie("driver_address", "", time() - 3600, "/");
            setcookie("driver_vechileType", "", time() - 3600, "/");
            setcookie("driver_transactionAmount", "", time() - 3600, "/");
            setcookie("driver_registerDate", "", time() - 3600, "/");
            setcookie("driver_points", "", time() - 3600, "/");
            $isLoggedIn = false;
        } else {
            $isLoggedIn = true;
        }
    } else {
        $isLoggedIn = false;
    }
    
    return $isLoggedIn;
}

?>