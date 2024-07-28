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
    <!-- Head -->
    <div class="w-100 bg-primary" style="height: 75px;">
      <nav class="navbar ps-5 p-3 pe-5">
        <div class="container-fluid">
          <a class="navbar-brand text-white">
            <?php
            session_start();
            $admin = $_SESSION['manager'];
            // include 'database.php';
            //   $user = $_GET['user'];
            //   $pass = $_GET['pass'];
            //   $admin = '';
            //   $sql = "SELECT * FROM locker_userlogin WHERE username = ? AND userpassword = ?";
            //   $params = array($user, $pass);
            //   $stmt = sqlsrv_query($conn, $sql, $params);
            //   while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            //              $admin = $row['firstname'];
            //   }
              echo $admin;
            ?>
          </a>
          <a href="Index.html"><button class="btn text-white" type="submit">LogOut</button></a>
        </div>
      </nav>
    </div>
    
    <div class="container-fluid">
      <div class="row">
        <!-- Menu -->
        <!-- <div class="bg-secondary-subtle p-2" style="width: 175px;">
          จัดการพนักงาน 
          <div class="ps-3 text-start" style="font-size: 14px;">
            <button type="button" onclick="button2()" class="border-0 bg-secondary-subtle">พนักงานทั้งหมด</button>
            <button type="button" onclick="button3()" class="border-0 bg-secondary-subtle">เพิ่มพนักงาน</button>
          </div>
          ข้อมูลล็อคเกอร์
          <div class="ps-3 text-start" style="font-size: 14px;">
            <button type="button" onclick="button4()" class="border-0 bg-secondary-subtle">ที่เก็บรองเท้าภายนอก</button>
            <button type="button" onclick="button5()" class="border-0 bg-secondary-subtle">ที่เก็บรองเท้าบัดดี้</button>
            <button type="button" onclick="button6()" class="border-0 bg-secondary-subtle">ล็อคเกอร์เก็บของ</button>
            <button type="button" onclick="button8()" class="border-0 bg-secondary-subtle">log</button>
          </div>
          การตรวจสอบ
          <div class="ps-3 text-start" style="font-size: 14px;">
            <button type="button" onclick="button7()" class="border-0 bg-secondary-subtle">การตรวจสอบทั้งหมด</button>
          </div>
        </div> -->
        <!-- Details -->
        <div class="col p-2">
          <div id="test">
            <iframe id="fullscreenIframe" src="showmanager.php" width="100%" frameborder="0"></iframe>
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
    }')
    ?>
  </script>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
