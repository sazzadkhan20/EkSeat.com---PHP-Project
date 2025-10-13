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
    $cqdriverinfotable = "dID VARCHAR(20) PRIMARY KEY,
                        dNID VARCHAR(20) NOT NULL,
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
    $iqdriverinfotable = "INSERT INTO driverinfo(dID,dNID, dName, dPhone, dEmail, dPassword, dAddress, dVehicleType) 
    VALUES(?,?, ?, ?, ?, ?, ?, ?)";
    $iqridebookinghistorytable = "INSERT INTO ridebookinghistory(transactionID, uEmail, vehicleType, pickupLocation, destination, rent, distance,serviceType, rideDate) 
    VALUES(?, ?, ?, ?, ?, ?, ?,?, ?)";
    $adquserinfotable = "SELECT * FROM userinfo WHERE uEmail = ? LIMIT 1";
    $adquserinfotableforall = "SELECT * FROM userinfo";
    $adqdriverinfotable = "SELECT * FROM driverinfo WHERE dEmail = ? LIMIT 1";
    $adqdriverinfotableforall = "SELECT * FROM driverinfo";
    $adqadmininfotable = "SELECT * FROM admininfo WHERE aEmail = ? LIMIT 1";
    $adqadmininfotableforall = "SELECT * FROM admininfo";
    $adqridebookinghistorytable = "SELECT * FROM ridebookinghistory WHERE uEmail = ? ORDER BY rideDate DESC";
    $adqridebookinghistorytableforall = "SELECT * FROM ridebookinghistory";
    $uquserinfotable = "UPDATE userinfo SET uPassword = ? WHERE uEmail = ?";
    $uquserinfotableforname = "UPDATE userinfo SET uName = ? WHERE uEmail = ?";
    $uquserinfotableforemail = "UPDATE userinfo SET uEmail = ? WHERE uEmail = ?";
    $uquserinfotablefornid = "UPDATE userinfo SET uNID = ? WHERE uEmail = ?";
    $uquserinfotableforaddress = "UPDATE userinfo SET uAddress = ? WHERE uEmail = ?";
    $uquserinfotableforphone = "UPDATE userinfo SET uPhone = ? WHERE uEmail = ?";
    $uquserinfotableforimage = "UPDATE userinfo SET uImage = ? WHERE uEmail = ?";
    $uquserinfotableforpoints = "UPDATE userinfo SET uPoints = ? WHERE uEmail = ?";
    $uquserinfotablefortransaction = "UPDATE userinfo SET uTransactionAmount = ? WHERE uEmail = ?";
    $dquserinfotable = "DELETE FROM userinfo WHERE uEmail = ?";
    $dqridebookinghistorytable = "DELETE FROM ridebookinghistory WHERE uEmail = ?";
    $uqdriverinfotable = "UPDATE driverinfo SET dPassword = ? WHERE dEmail = ?";
    $uqdriverinfotableforpoints = "UPDATE driverinfo SET dPoints = ? WHERE dEmail = ?";
    $dqdriverinfotable = "DELETE FROM driverinfo WHERE dEmail = ?";
    $uqdriverinfotableforname = "UPDATE driverinfo SET dName = ? WHERE dEmail = ?";
    $uqdriverinfotableforemail = "UPDATE driverinfo SET dEmail = ? WHERE dEmail = ?";
    $uqdriverinfotablefornid = "UPDATE driverinfo SET dNID = ? WHERE dEmail = ?";
    $uqdriverinfotableforaddress = "UPDATE driverinfo SET dAddress = ? WHERE dEmail = ?";
    $uqdriverinfotableforphone = "UPDATE driverinfo SET dPhone = ? WHERE dEmail = ?";
?>