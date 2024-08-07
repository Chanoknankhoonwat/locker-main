<?php
$serverName = ""; // ชื่อเซิร์ฟเวอร์ของคุณ
$connectionOptions = array(
    "Database" => "", // ชื่อฐานข้อมูล
    "Uid" => "", // ชื่อผู้ใช้ฐานข้อมูล
    "PWD" => "", // รหัสผ่านฐานข้อมูล
    "CharacterSet" => "UTF-8"
);

// เชื่อมต่อกับฐานข้อมูล MSSQL
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>
