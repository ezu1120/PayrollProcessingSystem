<?php
    include '../connection.php';
    // Initialize session
    session_start();
    $id = $_SESSION['id'];

    if ($_SESSION['loggedin'] !== true) {
        header('location: ../login.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Dashboard</title>
</head>
<body>
   <div style="overflow: hidden; height: 100vh; ">
        <div class="header">
            <!-- <div class="sub-header"> -->
            <div class="app-header-left" style="padding-right: 10px; padding-left:10px; padding-bottom:10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-list">
                            <line x1="4" y1="6" x2="32" y2="6" />
                            <line x1="4" y1="12" x2="32" y2="12" />
                            <line x1="4" y1="18" x2="32" y2="18" />
                        </svg>
            </div>
            <p>Payroll Management System</p>
            <a href="../index.html">Home</a>
            <a href="../support.php">Support</a>
            <a href="../announcement.php">Announcements</a>
            <a href="../faqs.html">FAQs</a>
            <!-- </div> -->


        </div>

    <div class="task_area" >

        <div class="bg_task_area">



            <div class="sidebar">
            <div class="bg_sidebar">
                <div class="user">

                    <?php
                        $img = mysqli_query($con, "select picture from users where user_id = $id "); // fetch data from database
                        $row = mysqli_fetch_array($img);

                        if (
                            $row['picture'] == '' || $row['picture'] == null || empty($row['picture']) || ! $row['picture']) {
                        ?>
                        <img src="../images/user.png" alt="User Photo" width="45%"> <!-- This Dummy image will be displayed if user img not found in DB -->
                        <?php
                            } else {
                                // echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['picture'] ).'" width="100" eight="100"/>';
                                echo '<img src= "' . $row["picture"] . '" width="100" eight="100"/>';
                            }
                        ?>
                    <span style="display: block;">Welcome<?php echo $_SESSION['name'] ?></span>

                </div>
                <hr style="border-width:1px;width:95%;text-align:center">
                <a href="../admin/dashboard.php">Dashboard</a>
                <a href="../admin/employees.php">Employees</a>
                <a href="../admin/departments.php">Departments</a>
                <a href="../../back_end/admin/payrolls.php">Payrolls</a>
                <a href="../../back_end/admin/users.php">Users</a>
                <a href="../../logout.php">Logout</a>
            </div>
        </div>
                <div class="area1_db_adm">
                    <h3>ADMIN DASHBOARD</h3>
                    <a href="support.php">Support</a>
                    <a href="announcement.php">Announcements</a>
                    <?php
                        $today        = date('Y-m-d');
                        $present      = mysqli_query($con, "SELECT COUNT(*) AS `count` FROM `attendance` WHERE `attend_date` = '$today'");
                        $row          = mysqli_fetch_array($present);
                        $countPresent = $row['count'];

                        $employees = mysqli_query($con, "SELECT COUNT(*) AS `count` FROM `employees`");
                        $row       = mysqli_fetch_array($employees);
                        $totalEmp  = $row['count'];

                        $absent = $totalEmp - $countPresent;

                        if ($totalEmp > 0) {
                            $percent = 100 * $countPresent / $totalEmp;
                        } else { $percent = 0;}
                    ?>
                    <div  class="logs">
                        <div style="display: flex; gap:30px; width:85%;text-align:center;">

                            <div  class="log present" > <h2>Present</h2> <span><?php echo $countPresent ?></span>
                            </div>
                            <div  class="log absent"> <h2>Absent</h2>     <span><?php echo $absent ?></span>
                            </div>
                        </div>
                        <div class="log-2" style="display: flex; gap:30px;width:85%;text-align:center;">
                            <div  class="log total_emp"><h2> Total Employees</h2><span><?php echo $totalEmp ?></span>
                            </div>
                                <div  class="log attendance"> <h2>Attendance</h2><span><?php echo round($percent, 2) ?></span> %
                                </div>
                        </div>


                    </div>

                </div>
                <hr style="border-width:1px;width:90%;text-align:center; margin-top:30px">
                <div class="area2_db_adm">
                    <div class="area2" style="display: flex;flex-direction: row;   gap: 200px; text-align:center; ">
                        <span class="employees">Employees</span>
                        <span class="departments">Departments</span>
                        <span class="payrolls">Payrolls</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
         document.querySelector(".departments").addEventListener("click", function() {
        window.location.href = "../admin/departments.php"; // Change this URL to your desired page
    });
    document.querySelector(".payrolls").addEventListener("click", function() {
        window.location.href = "../../back_end/admin/payrolls.php"; // Change this URL to your desired page
    });});
    </script>
    <script src="../../js/script.js"> </script>
</body>
</html>















