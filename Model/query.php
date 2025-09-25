<?php
    $dbname = "ekseat_com";
    $cquserinfotable = "uNID VARCHAR(15) PRIMARY KEY, uName VARCHAR(30) NOT NULL, 
            uPhone VARCHAR(15) NOT NULL, uEmail VARCHAR(30) NOT NULL UNIQUE, 
            uPassword VARCHAR(20) NOT NULL";
    $iquserinfotable = "insert into userinfo(uNID,uName,uPhone,uEmail,uPassword) 
    values(?,?,?,?,?)";
    $adquserinfotable = "SELECT * FROM userinfo WHERE uEmail = ? LIMIT 1";
?>