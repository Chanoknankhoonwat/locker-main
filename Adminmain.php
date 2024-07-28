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
    <script>
      function showPopup(a) {
        if (a==1) {
          document.getElementById("popup-container-1").style.display = "block";
        }else if (a==2) {
          document.getElementById("popup-container-2").style.display = "block";
        }else if (a==3) {
          document.getElementById("popup-container-3").style.display = "block";
        }else if (a==4) {
          document.getElementById("popup-container-4").style.display = "block";
        }else{}
      }

      function hidePopup(a){
        if (a==1) {
          document.getElementById("popup-container-1").style.display = "none";
        }else if (a==2) {
          document.getElementById("popup-container-2").style.display = "none";
        }else if (a==3) {
          document.getElementById("popup-container-3").style.display = "none";
        }else if (a==4) {
          document.getElementById("popup-container-4").style.display = "none";
        }else{}
      }
      
    </script>
    <div id="popup-container-1" style="display=block;">
      <!-- Content of the popup -->
      <p>ไม่มีข้อมูลแบบครึ่งในเดือนนี้ กรุณาเพิ่มข้อมูล!</p>
      <center><button onclick="hidePopup(1)" type="button" class="m-0 p-0 btn btn-outline-success set1 rounded-5">ยืนยัน</button></center>
    </div>
    <div id="popup-container-2">
      <!-- Content of the popup -->
      <p>มีข้อมูลแบบครึ่งในเดือนนี้อยู่แล้ว</p>
      <center><button onclick="hidePopup(2)" type="button" class="m-0 p-0 btn btn-outline-success set1 rounded-5">ยืนยัน</button></center>
    </div>
    <div id="popup-container-3">
      <!-- Content of the popup -->
      <p>ไม่มีข้อมูลใน3เดือนนี้แบบเต็ม กรุณาเพิ่มข้อมูล!</p>
      <center><button onclick="hidePopup(3)" type="button" class="m-0 p-0 btn btn-outline-success set1 rounded-5">ยืนยัน</button></center>
    </div>
    <div id="popup-container-4">
      <!-- Content of the popup -->
      <p>มีข้อมูลแบบเต็มใน3เดือนนี้อยู่แล้ว</p>
      <center><button onclick="hidePopup(4)" type="button" class="m-0 p-0 btn btn-outline-success set1 rounded-5">ยืนยัน</button></center>
    </div>
    <?php
    session_start();
    $admin = $_SESSION['admin'];
    include 'database.php';
    $query = "SELECT * FROM AuditData1 WHERE MONTH(enddate) = MONTH(GETDATE()) AND YEAR(enddate) = YEAR(GETDATE()) AND staudit = 'ok' AND selection = '0.5'";
    $result = sqlsrv_query($conn, $query);
    if ($result === false) {
        echo "เกิดข้อผิดพลาดในการค้นหาข้อมูล: " . print_r(sqlsrv_errors(), true);
    } else {
        $rowCount = sqlsrv_has_rows($result);
        if (!$rowCount) {
          ?>
          <script>showPopup(1);
        </script>
          <?php
            //echo "ไม่มีข้อมูลแบบครึ่งในเดือนนี้ กรุณาเพิ่มข้อมูล!   ";
            // ใส่โค้ดส่วนที่ต้องการแจ้งเตือนในกรณีไม่มีข้อมูลในเดือนนี้
        } else {
          ?>
          <!-- <script>showPopup(2);
        </script> -->
          <?php
            // echo "มีข้อมูลแบบครึ่งในเดือนนี้อยู่แล้ว   ";
            // ใส่โค้ดส่วนที่ต้องการทำในกรณีมีข้อมูลในเดือนนี้
        }
    }
    $query = "SELECT * FROM AuditData1 WHERE
   (DATEDIFF(QUARTER, enddate, GETDATE()) >= 1 OR enddate IS NOT NULL)AND staudit = 'ok' AND selection = '1'";
   $result2 = sqlsrv_query($conn, $query);
   if ($result2 === false) {
       echo "เกิดข้อผิดพลาดในการค้นหาข้อมูล: " . print_r(sqlsrv_errors(), true);
   } else {
       $rowCount = sqlsrv_has_rows($result2);
       if (!$rowCount) {
        ?>
          <script>showPopup(3);
        </script>
          <?php
           //echo "ไม่มีข้อมูลใน3เดือนนี้แบบเต็ม กรุณาเพิ่มข้อมูล!   ";
           // ใส่โค้ดส่วนที่ต้องการแจ้งเตือนในกรณีไม่มีข้อมูลในเดือนนี้
       } else {
        ?>
          <!-- <script>showPopup(4);
        </script> -->
          <?php
           //echo "มีข้อมูลแบบเต็มใน3เดือนนี้อยู่แล้ว    ";
           // ใส่โค้ดส่วนที่ต้องการทำในกรณีมีข้อมูลในเดือนนี้
       }
   }
    ?>
    <!-- Head -->
    <div class="w-100 bg-primary" style="height: 75px;">
      <nav class="navbar ps-5 p-3 pe-5">
        <div class="container-fluid">
          <a class="navbar-brand text-white">
            <?php
              echo $admin;
            ?>
          </a>
          <a href="Index.php"><button class="btn text-white" type="submit">LogOut</button></a>
        </div>
      </nav>
    </div>
    
    <div class="container-fluid">
      <div class="row">
        <!-- Menu -->
        <div class="bg-secondary-subtle p-2" style="width: 175px;">
          จัดการพนักงาน 
          <div class="ps-3 text-start" style="font-size: 14px;">
            <!-- <button type="button" onclick="button1()" class="border-0 bg-secondary-subtle">ตรวจสอบสถานะ</button> -->
            <button type="button" onclick="button2()" class="border-0 bg-secondary-subtle">พนักงานทั้งหมด</button>
            <button type="button" onclick="button3()" class="border-0 bg-secondary-subtle">เพิ่มพนักงาน</button>
          </div>
          ข้อมูลล็อคเกอร์
          <div class="ps-3 text-start" style="font-size: 14px;">
            <button type="button" onclick="button4()" class="border-0 bg-secondary-subtle">ที่เก็บรองเท้าภายนอก</button>
            <button type="button" onclick="button5()" class="border-0 bg-secondary-subtle">ที่เก็บรองเท้าบัดดี้</button>
            <button type="button" onclick="button6()" class="border-0 bg-secondary-subtle">ล็อคเกอร์เก็บของ</button>
            <button type="button" onclick="button8()" class="border-0 bg-secondary-subtle">log</button>
            <button type="button" onclick="button11()" class="border-0 bg-secondary-subtle">log...</button>
          </div>
          การตรวจสอบ
          <div class="ps-3 text-start" style="font-size: 14px;">
            <!-- <button type="button" onclick="button7()" class="border-0 bg-secondary-subtle">การตรวจสอบทั้งหมด</button> -->
            <button type="button" onclick="button9()" class="border-0 bg-secondary-subtle">ครึ่ง</button>
            <button type="button" onclick="button10()" class="border-0 bg-secondary-subtle">เต็ม</button>
          </div>
        </div>
        <!-- Details -->
        <div class="col p-2">
          <div id="test">
            <iframe id="fullscreenIframe" src="showEmployee.php" width="100%" frameborder="0"></iframe>
          </div>
        </div>
      </div>
    </div>

    
  <script src="fullscreenIframe.js"></script>
  <script>
      
    <?php
    // function select details
    echo ('function button1() {
      setIframeSource("-");
    }function button2() {
      setIframeSource("showEmployee.php");
    }function button3() {
      setIframeSource("adminAddhome.php");
    }function button4() {
      setIframeSource("lockerout.php?admin='.$admin.'");
    }function button5() {
      setIframeSource("lockerbuddy.php?admin='.$admin.'");
    }function button6() {
      setIframeSource("lockershirt.php?admin='.$admin.'");
    }function button7() {
      setIframeSource("audit.php");
    }function button8() {
      setIframeSource("showlog.php");
    }function button9() {
      setIframeSource("ChooseAudit.php?selection=0.5");
    }function button10() {
      setIframeSource("ChooseAudit.php?selection=1");
    }function button11() {
      setIframeSource("showbreaklog.php");
    }')
    ?>
  </script>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
