<?php

    require_once 'query.php';
    require_once 'queryExecution.php';

    $user_email = $_COOKIE['user_login'];

    // Fetch user data
    $user_result = emailVerify($adquserinfotable,$user_email);
    $user = $user_result->fetch_assoc();

    // Fetch ride history
    $rides_result = emailVerify($adqridebookinghistorytable,$user_email);
    $ride_history = [];
    $total_rides = 0;
    $total_spent = 0.0;
    $total_distance = 0.0;
    $total_points = $user['uPoints'];
    $has_rides = false;

    while($row = $rides_result->fetch_assoc()) {
        $ride_history[] = $row;
        $total_rides++;
        $total_distance += $row['distance'];
        $total_spent += $row['rent'];
        $has_rides = true;
    }
?>