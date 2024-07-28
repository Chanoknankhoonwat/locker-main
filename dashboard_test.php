<?php
include 'database.php';
$sql = "SELECT COUNT(*) AS employees FROM employee ";
$stmt = sqlsrv_query($conn, $sql);
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
echo " พนักงาน".$row['employees'];

$sql = "SELECT COUNT(*) AS have_locker FROM employee WHERE idcard IN (SELECT EmployeeID FROM AccessLog WHERE StatusEm = 'active')";
$stmt = sqlsrv_query($conn, $sql);
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
echo "มี".$row['have_locker'];

$sql = "SELECT COUNT(*) AS have_not_locker FROM employee WHERE idcard NOT IN (SELECT EmployeeID FROM AccessLog WHERE StatusEm = 'active')";
$stmt = sqlsrv_query($conn, $sql);
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
echo "ไม่มี ".$row['have_not_locker'];



$sql = "SELECT COUNT(*) AS all_audit FROM format_audit  ";
$stmt = sqlsrv_query($conn, $sql);
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
echo "<br> all_audit ".$row['all_audit'];

$sql = "SELECT COUNT(*) AS complete FROM format_audit WHERE staudit = 'complete' ";
$stmt = sqlsrv_query($conn, $sql);
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
echo " complete : ".$row['complete'];

$sql = "SELECT COUNT(*) AS audit_ok FROM format_audit WHERE staudit = 'ok' ";
$stmt = sqlsrv_query($conn, $sql);
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
echo " admin_ok: ".$row['audit_ok'];

$sql = "SELECT COUNT(*) AS process FROM format_audit WHERE staudit = 'process' ";
$stmt = sqlsrv_query($conn, $sql);
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
echo " process: ".$row['process'];

?>