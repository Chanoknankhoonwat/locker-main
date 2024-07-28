<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
  </head>
  <body class="bg-light">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  
<?php
include 'database.php';
//$selection = $_POST['selection']
//$selectionID = $_POST['selectionID']
//$employeeID = $_POST["employeeID"]

if( $conn ) {
    function rowcount($sql,$stmt,$type){
        $rowcount =0;
        if($type === 'buddy'){
            $type = 'status_buddy';
        }
        elseif($type === 'shirt'){
            $type = 'status_shirt';
        }
        elseif($type === 'out'){
            $type = 'status_out';
        }
        
        while ($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)) {
         $rowcount+=$row[$type];
        }
        echo $rowcount .'<br>';
    }
    $sql = "SELECT * FROM buddy_locker WHERE UsStatus = 'ว่าง'
        ";
    $stmt = sqlsrv_query($conn, $sql);
    echo 'บัดดี้ว่างทั้งหมด';
    rowcount($sql,$stmt,'buddy');

    $sql = "SELECT * FROM buddy_locker WHERE UsStatus = 'ว่าง' AND build_id = 1
    ";
        $stmt = sqlsrv_query($conn, $sql);
        echo 'บัดดี้Aว่างทั้งหมด';
        rowcount($sql,$stmt,'buddy');
    
    $sql = "SELECT * FROM buddy_locker WHERE UsStatus = 'ว่าง' AND build_id = 2
    ";
        $stmt = sqlsrv_query($conn, $sql);
        echo 'บัดดี้Bว่างทั้งหมด';
        rowcount($sql,$stmt,'buddy');

    $sql = "SELECT * FROM locker_out WHERE UsStatus = 'ว่าง'
        ";
        $stmt = sqlsrv_query($conn, $sql);
        echo 'ภายนอกว่างทั้งหมด';
        rowcount($sql,$stmt,'out');

    $sql = "SELECT * FROM locker_out WHERE UsStatus = 'ว่าง' AND build_id = 1
    ";
        $stmt = sqlsrv_query($conn, $sql);
        echo 'ภายนอกAว่างทั้งหมด';
        rowcount($sql,$stmt,'out');
    
    $sql = "SELECT * FROM locker_out WHERE UsStatus = 'ว่าง' AND build_id = 2
    ";
        $stmt = sqlsrv_query($conn, $sql);
        echo 'ภายนอกBว่างทั้งหมด';
        rowcount($sql,$stmt,'out');

    $sql = "SELECT * FROM locker_shirt WHERE UsStatus = 'ว่าง'
        ";
        $stmt = sqlsrv_query($conn, $sql);
        echo 'ตู้ว่างทั้งหมด';
        rowcount($sql,$stmt,'shirt');

    $sql = "SELECT * FROM locker_shirt WHERE UsStatus = 'ว่าง' AND build_id = 1
    ";
        $stmt = sqlsrv_query($conn, $sql);
        echo 'ตู้Aว่างทั้งหมด';
        rowcount($sql,$stmt,'shirt');
    
    $sql = "SELECT * FROM locker_shirt WHERE UsStatus = 'ว่าง' AND build_id = 2
    ";
        $stmt = sqlsrv_query($conn, $sql);
        echo 'ตู้Bว่างทั้งหมด';
        rowcount($sql,$stmt,'shirt');

    
    $sql = "SELECT * FROM locker_shirt WHERE UsStatus = 'ว่าง' AND build_id = 4
    ";
        $stmt = sqlsrv_query($conn, $sql);
        echo 'ตู้Dว่างทั้งหมด';
        rowcount($sql,$stmt,'shirt');

    $sql = "SELECT * FROM locker_shirt WHERE UsStatus = 'ว่าง' AND build_id = 5
        ";
        $stmt = sqlsrv_query($conn, $sql);
        echo 'ตู้Eว่างทั้งหมด';
        rowcount($sql,$stmt,'shirt');

    $sql = "SELECT * FROM locker_shirt WHERE UsStatus = 'ว่าง' AND build_id = 6
    ";
        $stmt = sqlsrv_query($conn, $sql);
        echo 'ตู้Fว่างทั้งหมด';
        rowcount($sql,$stmt,'shirt');
    // ปิดการเชื่อมต่อ
    sqlsrv_close($conn);
} else {
    echo "การเชื่อมต่อไม่สำเร็จ";
}
?></body>
</html>