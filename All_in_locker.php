<?php
include 'database.php';
session_start();
$admin = $_SESSION['admin'];
if(isset($_POST['idcard'])){
    $idcard = $_POST['idcard'];
    if(isset($_POST['buddy'])||isset($_POST['out'])){
        if(isset($_POST['buddy'])){
            $locker = $_POST['buddy'];
        }
        if(isset($_POST['out'])){
            $locker = $_POST['out'];
        }
        $sql = "SELECT status_buddy FROM buddy_locker WHERE buddy_number = ?";
        $params = array($locker);
        $stmt = sqlsrv_query($conn, $sql, $params );

        $sql6 = "SELECT status_out FROM locker_out WHERE out_number = ?";
        $params6 = array($locker);
        $stmt6 = sqlsrv_query($conn, $sql6, $params6 );
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $status = $row['status_buddy']-1;
        }
        while ($row = sqlsrv_fetch_array($stmt6, SQLSRV_FETCH_ASSOC)) {
            $statusO = $row['status_out']-1;
        }
        if ($status > 0) {
            $statusL = 'ว่าง';
            
        }
        elseif ($status === 0) {
            $statusL = 'เต็ม';
        
        }
        $sql2 = "UPDATE buddy_locker SET status_buddy = ?,UsStatus = ? WHERE buddy_number = ?";
        $params2 = array($status,$statusL,$locker);
        $stmt2 = sqlsrv_query($conn, $sql2, $params2 );
    
        $sql3 = "INSERT INTO AccessLog (EntryDate,EmployeeID,LockerNumber,TypeLocker,StatusEm,userin) VALUES (GETDATE(), ?,?,'buddy','active',?)";
        $params3 = array($idcard,$locker,$admin);
        $stmt3 = sqlsrv_query($conn, $sql3, $params3 );

        $sql4 = "UPDATE locker_out SET status_out = ?,UsStatus = ? WHERE out_number = ?";
        $params4 = array($statusO,$statusL, $locker);
        $stmt4= sqlsrv_query($conn, $sql4, $params4 );
    
        $sql5 = "INSERT INTO AccessLog (EntryDate,EmployeeID,LockerNumber,TypeLocker,StatusEm,userin) VALUES (GETDATE(), ?,?,'out','active',?)";
        $params5 = array($idcard,$locker,$admin);
        $stmt5 = sqlsrv_query($conn, $sql5, $params5);
    }
    if(isset($_POST['shirt'])){
        $locker = $_POST['shirt'];
        $sql = "SELECT status_shirt FROM locker_shirt WHERE shirt_number = ?";
        $params = array($locker);
        $stmt = sqlsrv_query($conn, $sql, $params );
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $status = $row['status_shirt']-1;
        }
        if ($status > 0) {
            $statusL = 'ว่าง';
            
        }
        elseif ($status === 0) {
            $statusL = 'เต็ม';
        
        }
        
        $sql2 = "UPDATE locker_shirt SET status_shirt = ?,UsStatus = ? WHERE shirt_number = ?";
        $params2 = array($status,$statusL, $locker);
            $stmt2 = sqlsrv_query($conn, $sql2, $params2 );

        $sql3 = "INSERT INTO AccessLog (EntryDate,EmployeeID,LockerNumber,TypeLocker,StatusEm,userin) VALUES (GETDATE(), ?,?,'shirt','active',?)";
        $params3 = array($idcard,$locker,$admin);
        $stmt3 = sqlsrv_query($conn, $sql3, $params3 );

    }
}