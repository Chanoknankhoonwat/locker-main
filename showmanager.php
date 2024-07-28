<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <style>
        body{overflow: hidden;}
    </style>
</head>
<body class="bg-light">
    <div class="row">
        <?php
            include 'database.php';

            if ($conn === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            // Query เพื่อดึงข้อมูลวันที่ที่ไม่ซ้ำกัน
            $sql = "SELECT DISTINCT CONVERT(date, startdate) AS UniqueDates FROM AuditData WHERE enddate IS NOT NULL";

            // ส่งคำสั่ง Query ไปยังฐานข้อมูล
            $result = sqlsrv_query($conn, $sql);

            if ($result === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            // แสดงรายการของวันที่ที่ไม่ซ้ำกัน
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                echo '<div class="col border"><center>
                <a href="exportmanager.php?selectedDate='.$row['UniqueDates']->format('Y-m-d').'">'.$row['UniqueDates']->format('Y-m-d') . '</a>
                </center></div>'; // แสดงผลลัพธ์ในรูปแบบ 'Y-m-d'
            }

            // ปิดการเชื่อมต่อฐานข้อมูล
            sqlsrv_free_stmt($result);
            sqlsrv_close($conn);
        ?>
    </div>
</body>
</html>