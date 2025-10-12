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
                        uregisterDate DATE DEFAULT (CURDATE()),
                        uPoints INT DEFAULT 1000";
    $cqdriverinfotable = "dNID VARCHAR(20) PRIMARY KEY,
                        dName VARCHAR(100) NOT NULL,
                        dPhone VARCHAR(15) NOT NULL,
                        dEmail VARCHAR(100) UNIQUE,
                        dPassword VARCHAR(255) NOT NULL,
                        dAddress TEXT NOT NULL,
                        dVehicleType VARCHAR(20) NOT NULL,
                        dTransactionAmount DECIMAL(10,2) DEFAULT 0.00,
                        dImage LONGBLOB NULL,
                        dregisterDate DATE DEFAULT (CURRENT_DATE),
                        dPoints INT DEFAULT 3000";
    $cqridebookinghistorytable = "transactionID VARCHAR(255) PRIMARY KEY,
                                    uEmail VARCHAR(100) NOT NULL,
                                    dNID VARCHAR(30) NULL,
                                    vehicleType VARCHAR(20) NOT NULL,
                                    pickupLocation VARCHAR(100) NOT NULL,
                                    destination VARCHAR(100) NOT NULL,
                                    rent FLOAT NOT NULL,
                                    distance FLOAT NOT NULL,
                                    serviceType VARCHAR(20) NOT NULL,
                                    rideDate VARCHAR(100) NOT NULL";
    $iquserinfotable = "insert into userinfo(uNID,uName,uPhone,uEmail,uPassword)
    values(?,?,?,?,?)";
    $iqdriverinfotable = "INSERT INTO driverinfo(dNID, dName, dPhone, dEmail, dPassword, dAddress, dVehicleType) 
    VALUES(?, ?, ?, ?, ?, ?, ?)";
    $iqridebookinghistorytable = "INSERT INTO ridebookinghistory(transactionID, uEmail, vehicleType, pickupLocation, destination, rent, distance,serviceType, rideDate) 
    VALUES(?, ?, ?, ?, ?, ?, ?,?, ?)";
    $adquserinfotable = "SELECT * FROM userinfo WHERE uEmail = ? LIMIT 1";
    $adqdriverinfotable = "SELECT * FROM driverinfo WHERE dEmail = ? LIMIT 1";
    $adqridebookinghistorytable = "SELECT * FROM ridebookinghistory WHERE uEmail = ? ORDER BY rideDate DESC";
    $uquserinfotable = "UPDATE userinfo SET uPassword = ? WHERE uEmail = ?";
    $uquserinfotableforpoints = "UPDATE userinfo SET uPoints = ? WHERE uEmail = ?";
    $uqdriverinfotable = "UPDATE driverinfo SET dPassword = ? WHERE dEmail = ?";
    $uqdriverinfotableforpoints = "UPDATE driverinfo SET dPoints = ? WHERE dEmail = ?";
?>