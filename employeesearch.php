<?php

// กำหนดค่าเชื่อมต่อกับฐานข้อมูล
include 'database.php';

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// คำสั่ง SQL
$sql = "SELECT 
        t.idcard,
        STUFF((SELECT ', ' + LockerNumber FROM ALL_employee_locker WHERE TypeLocker = 'buddy' AND idcard = t.idcard FOR XML PATH('')), 1, 2, '') AS buddys,
        STUFF((SELECT ', ' + LockerNumber FROM ALL_employee_locker WHERE TypeLocker = 'out' AND idcard = t.idcard FOR XML PATH('')), 1, 2, '') AS outs,
        STUFF((SELECT ', ' + LockerNumber FROM ALL_employee_locker WHERE TypeLocker = 'shirt' AND idcard = t.idcard FOR XML PATH('')), 1, 2, '') AS shirts, 
        t.namethai,
        t.surnamethai,
        t.departmentno,
        t.departmentname,
        t.linename
        FROM (SELECT DISTINCT idcard, namethai, surnamethai, departmentno, departmentname, linename FROM ALL_employee_locker) AS t
        ORDER BY t.idcard ASC

";

// ส่งคำสั่ง SQL
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// เริ่มตาราง HTML
echo "<table border='1'>";
echo "<tr><th>ID Card</th><th>Name Thai</th><th>Surname Thai</th><th>Department No</th><th>Department Name</th><th>Line Name</th><th>Names1</th><th>Names2</th><th>Names3</th></tr>";

// วนลูปแสดงผลลัพธ์
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {


    echo "<tr>";
    echo "<td>{$row['idcard']}</td>";
    echo "<td>{$row['namethai']}</td>";
    echo "<td>{$row['surnamethai']}</td>";
    echo "<td>{$row['departmentno']}</td>";
    echo "<td>{$row['departmentname']}</td>";
    echo "<td>{$row['linename']}</td>";
    echo "<td>{$row['buddys']}</td>";
    echo "<td>{$row['outs']}</td>";
    echo "<td>{$row['shirts']}</td>";

       
    
    echo "</tr>";
}

// ปิดตาราง HTML
echo "</table>";

// ปิดการเชื่อมต่อ
sqlsrv_close($conn);

?>
