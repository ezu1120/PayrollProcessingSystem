<?php
	include '../connection.php';
	// Initialize session
	session_start();
    $id = $_SESSION['id'];
    $username = $_SESSION['name'];
    $dept_id = $_SESSION['dept_id'];

	if ($_SESSION['loggedin'] !== TRUE) {
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
    <div style="overflow: hidden; height: 100vh;">
        <div class="header">
        <div class="app-header-left" style="padding-right: 10px; padding-left:10px; padding-bottom:10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-list">
                            <line x1="8" y1="6" x2="21" y2="6" />
                            <line x1="4" y1="12" x2="32" y2="12" />
                            <line x1="8" y1="18" x2="21" y2="18" />
                        </svg>
            </div>

            <p>Payroll Management System</p>
            <a href="../home.html">Home</a>
            <a href="../support.php">Support</a>
            <a href="../announcement.php">Announcements</a>
            <a href="../faqs.html">FAQs</a>
        </div>
        <div class="sidebar">
            <div class="bg_sidebar">
                <div class="user">                        

                    <?php
                    $img = mysqli_query($con,"select picture from users where user_id = $id "); // fetch data from database
                    $row = mysqli_fetch_array($img);

                    if (
                        $row['picture'] == '' ||  $row['picture'] == null ||  empty($row['picture']) ||  !$row['picture'])
                        {
                          ?>
                          <img src="../images/user.png" alt="User Photo" width="45%"> <!-- This Dummy image will be displayed if user img not found in DB -->
                          <?php
                      }
                      else {
                        echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['picture'] ).'" width="100" eight="100"/>';
                      }
                    ?>
                    <span style="display: block;">Welcome <?php echo ucfirst($username) ?></span>
                    
                </div>
                <hr style="border-width:1px;width:95%;text-align:center">
                <a href="../manager/dashboard.php">Dashboard</a>
                <a href="../manager/employees.php">Employees</a>
                <a href="../manager/payrolls.php">Payrolls</a>
                <a href="../manager/positions.php">Positions</a>
                <a href="../manager/users.php">Users</a>
                <a href="../logout.php">Logout</a>
            </div>
        </div>
        <div class="task_area">
            <div class="bg_task_area">
                <div class="area1_db_mng">

                    <?php
                    $result = mysqli_query($con,"SELECT * FROM departments WHERE departments.dept_id = $dept_id");
                    $row = mysqli_fetch_array($result);
                    ?>
                    <h3>DASHBOARD >> <?php echo $row['dept_name'] ?></h3>

                    <?php
                        $today = date('Y-m-d');
                        $countPresent = 0;
                        $present = mysqli_query($con, "SELECT COUNT(*) AS `count` FROM `employees`
                        INNER JOIN attendance ON attendance.emp_id = employees.emp_id
                        INNER JOIN positions ON positions.pos_id = employees.pos_id
                        INNER JOIN departments ON departments.dept_id = positions.dept_id
                        WHERE departments.dept_id = $dept_id AND attendance.attend_date = '$today'");
                        $row = mysqli_fetch_array($present);
                        $countPresent = $row['count'];

                        $employees = mysqli_query($con, "SELECT COUNT(*) AS `count` FROM `employees`
                        INNER JOIN positions ON positions.pos_id = employees.pos_id
                        INNER JOIN departments ON departments.dept_id = positions.dept_id
                        WHERE departments.dept_id = $dept_id");
                        $row = mysqli_fetch_array($employees);
                        $totalEmp = $row['count'];

                        $absent = $totalEmp - $countPresent;

                        $percent = 100 * $countPresent / $totalEmp;
                    ?>
                    
                    <a href="../manager/employees.php"><p>Total Employees<br><span><?php echo $totalEmp ?></span></p></a>
                    <a href="../manager/present.php"><p>Present<br><span><?php echo $countPresent ?></span></p></a>
                    <a href="../manager/absent.php"><p>Absent<br><span><?php echo $absent ?></span></p></a>
                    <p>Attendance<br><span><?php echo round($percent,2) ?></span> %</p>
                </div>
                <hr style="border-width:1px;width:90%;text-align:center">
                <div class="area2_db_mng">
                    <a href="../manager/employees.php">
                        <p>Employees</p>
                    </a>
                    <a href="../manager/payrolls.php">
                        <p>Payrolls</p>
                    </a>
                    <a href="../manager/positions.php">
                        <p>Positions</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
        <script src="../js/script.js"> </script>

</body>
</html>