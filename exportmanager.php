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
    <style>
        .vertical-lr-text {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            text-align: left;
            padding-top: 10px;
        }
        .headtable{
            padding-bottom: 10px;
            vertical-align: center;
        }
    </style>
<?php
include 'database.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $selectedDate = $_GET['selectedDate'];
}
$count = 0;
$cleanDate = date('Y-m-d', strtotime($selectedDate));
//AND CONVERT(date, YourDateColumn) = ?
echo '
<div class="d-flex">
    <div class="w-75 m-3">'.$cleanDate.'</div>
    <div class="w-25 m-2 row">
        <div class="col">
            <a href="showmanager.php"><button class="w-100 btn btn-outline-danger rounded-5" type = "button">ย้อนกลับ</button></a>
        </div>
        <div class="col">
            <a href="t.php"><button class="w-100 btn btn-outline-primary rounded-5" type = "button">ไปปริ้น</button></a>
        </div>
    </div>
</div>';
$sql3 = "SELECT AuditData.*,building.* FROM AuditData 
LEFT JOIN building ON AuditData.build = building.building_id 
WHERE enddate IS NOT NULL AND CONVERT(date, startdate) = '$cleanDate'  "; 

        $stmt3 = sqlsrv_query($conn,$sql3);
        echo"<table class='container-fluid ps-4 pe-4 text-center border pb-1>
        <tr class='border headtable'>
        <th class='border headtable'></th>
        <th class='border headtable'>build</th>
        <th class='border headtable'>userin</th>
        <th class='border headtable'>userout</th>
        <th class='border headtable'>คำนำหน้า</th>
        <th class='border headtable'>depart</th>
        <th class='border headtable'>หมายเลขตู้</th>
        <th class='border vertical-lr-text'>1. ไม่มีสัตว์พาหะอยู่ในล็อคเกอร์</th>
        <th class='border vertical-lr-text'>2. ห้ามติดสติกเกอร์ใดๆ ที่ตู้ล็อคเกอร์</th>
        <th class='border vertical-lr-text'>3. ห้ามนำจาน-ชามของบริษัทฯมาเก็บในตู้ล็อคเกอร์</th>
        <th class='border vertical-lr-text'>4. ห้ามนำสิ่งของทุกชนิดมาเก็บไว้ในตู้ล็อคเกอร์ว่าง <br>หรือตู้ล็อคเกอร์ของผู้อื่นโดยไม่ได้รับอนุญาต</th>
        <th class='border vertical-lr-text'>5. ห้ามนำอาหารและเครื่องดื่มเข้ามาเก็บในตู้ล็อคเกอร์</th>
        <th class='border vertical-lr-text'>6. ห้ามรับประทานอาหารและเครื่องดื่มภายในห้องแต่งตัว</th>
        <th class='border vertical-lr-text'>7. ห้ามนำสินค้าทุกชนิดมาจำหน่ายในห้องแต่งตัว</th>
        <th class='border vertical-lr-text'>8. ห้ามงัดและเคลื่อนย้ายตู้ล็อคเกอร์</th>
        <th class='border vertical-lr-text'>9. สภาพตู้ล็อคเกอร์ไม่ชำรุด</th>
        <th class='border vertical-lr-text'>อื่นๆ</th>
              
        <th class='border headtable'>audit</th>
        <th class='border headtable'></th>
        </tr>
        ";
        while ($row = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)) {
        $count++;
        $entryDate = $row['startdate'] !== null ? $row['startdate']->format('Y-m-d ') : ''; // ตรวจสอบ EntryDate ก่อนใช้ format()
        $exitDate = $row['enddate'] !== null ? $row['enddate']->format('Y-m-d ') : ''; // ตรวจสอบ ExitDate ก่อนใช้ format()
        echo "<tr class='border-end border-start p-2'><td class='border-end border-start p-2'>" .$count . "</td>";
        echo "<td class='border-end border-start p-2'>" . $row['building_name'] . "</td>";
        echo "<td class='border-end border-start p-2'>" .$entryDate . "</td>";
        echo "<td class='border-end border-start p-2'>" .$exitDate . "</td>";

        echo "<td class='border-end border-start p-2'>" . $row['intitail'] . "</td>";
        echo "<td class='border-end border-start p-2'>" . $row['typeaudit'] . "</td>";
        echo "<td class='border-end border-start p-2'>" . $row['lockernumber'] . "</td>";
        if($row['animal']===1){
            echo"<td class='border-end border-start'>✓</td>";
        }
        else{
            echo"<td class='border-end border-start'>✗</td>";
        }
        if($row['sticker']===1){
            echo"<td class='border-end border-start'>✓</td>";
        }
        else{
            echo"<td class='border-end border-start'>✗</td>";
        }
        if($row['plate']===1){
            echo"<td class='border-end border-start'>✓</td>";
        }
        else{
            echo"<td class='border-end border-start'>✗</td>";
        }
        if($row['something']===1){
            echo"<td class='border-end border-start'>✓</td>";
        }
        else{
            echo"<td class='border-end border-start'>✗</td>";
        }
        if($row['food']===1){
            echo"<td class='border-end border-start'>✓</td>";
        }
        else{
            echo"<td class='border-end border-start'>✗</td>";
        }
        if($row['eat']===1){
            echo"<td class='border-end border-start'>✓</td>";
        }
        else{
            echo"<td class='border-end border-start'>✗</td>";
        }
        if($row['sell']===1){
            echo"<td class='border-end border-start'>✓</td>";
        }
        else{
            echo"<td class='border-end border-start'>✗</td>";
        }
        if($row['moveoratk']===1){
            echo"<td class='border-end border-start'>✓</td>";
        }
        else{
            echo"<td class='border-end border-start'>✗</td>";
        }
        if($row['normal']===1){
            echo"<td class='border-end border-start'>✓</td>";
        }
        else{
            echo"<td class='border-end border-start'>✗</td>";
        }
        if($row['other']==='0' || $row['other']=== ""){
            echo"<td class='border-end border-start'>✓</td>";
        }
        else{
            // echo"<td class='border-end border-start'>✗</td>";
            echo "<td class='border-end border-start p-2'>" . $row['other'] . "</td>";
        }
        echo "<td class='border-end border-start p-2'>" . $row['auditname'] . "</td>";



        }
        echo"</table>";
?>
</body>
</html>