<?php
    $dbname = "ekseat_com";
    $cquserinfotable = "uNID VARCHAR(15) PRIMARY KEY,
                        uName VARCHAR(30) NOT NULL,
                        uPhone VARCHAR(15) NOT NULL,
                        uEmail VARCHAR(30) NOT NULL UNIQUE,
                        uPassword VARCHAR(20) NOT NULL,
                        uImage LONGBLOB NULL,
                        uAddress TEXT NULL,
                        uTransactionAmount DECIMAL(10,2) DEFAULT 0.00,
                        uregisterDate DATE DEFAULT (CURDATE())";
    $cqdriverinfotable = "dNID VARCHAR(20) PRIMARY KEY,
                        dName VARCHAR(100) NOT NULL,
                        dPhone VARCHAR(15) NOT NULL,
                        dEmail VARCHAR(100) UNIQUE,
                        dPassword VARCHAR(255) NOT NULL,
                        dAddress TEXT NOT NULL,
                        dVehicleType VARCHAR(20) NOT NULL,
                        dTransactionAmount DECIMAL(10,2) DEFAULT 0.00,
                        dImage LONGBLOB NULL,
                        dregisterDate DATE DEFAULT (CURRENT_DATE)";
    $iquserinfotable = "insert into userinfo(uNID,uName,uPhone,uEmail,uPassword)
    values(?,?,?,?,?)";
    $iqdriverinfotable = "INSERT INTO driverinfo(dNID, dName, dPhone, dEmail, dPassword, dAddress, dVehicleType) 
    VALUES(?, ?, ?, ?, ?, ?, ?)";
    $adquserinfotable = "SELECT * FROM userinfo WHERE uEmail = ? LIMIT 1";
    $adqdriverinfotable = "SELECT * FROM driverinfo WHERE dEmail = ? LIMIT 1";
    $uquserinfotable = "UPDATE userinfo SET uPassword = ? WHERE uEmail = ?";
    $uqdriverinfotable = "UPDATE driverinfo SET dPassword = ? WHERE dEmail = ?";
?>