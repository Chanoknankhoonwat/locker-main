<?php
include 'database.php';

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

if(isset($_GET["file_id"])) {
    $sql = "SELECT file_path FROM uploaded_files WHERE id = ?";
    $params = array($_GET['file_id']);
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $filePath = $row['file_path'];

    echo "<a href='$filePath' download>Download File</a>";
}

sqlsrv_close($conn);
?>
