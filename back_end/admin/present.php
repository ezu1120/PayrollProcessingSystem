<?php
include '../../connection.php';

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
    <title>Present</title>
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
            <a href="../index.html">Home</a>
            <a href="../support.php">Support</a>
            <a href="../announcement.php">Announcements</a>
            <a href="../faqs.html">FAQs</a>
        </div>
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
          <a href="../../front_end/admin/dashboard.php">Dashboard</a>
                <a href="../../front_end/admin/employees.php">Employees</a>
                <a href="../../front_end/admin/departments.php">Departments</a>
                <a href="../admin/payrolls.php">Payrolls</a>
                <a href="../admin/users.php">Users</a>
                <a href="../../logout.php">Logout</a>
            </div>
        </div>
        <div class="task_area">
            <div class="bg_task_area">
            <p style="margin-left: 5% ; margin-top:2%"> All the present employees today are displayed here. </p>
            <hr style="border-width:1px;width:90%;text-align:center;;margin:2%">
                <table style="width: 90%; margin-left: 5%">
                    <tr>
                        <th>Sr. No</th>
                        <th>Emp. ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Position</th>
                        <th>Department</th>
                        <th>Presents</th>
                        <th>Absents</th>
                        <th>DOJ</th>
                        <th>DOB</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Address</th>
                    </tr>

                    <?php
                        $today = date('Y-m-d');  // today date
                        $first = date('Y-m-00'); // 0 date of the present month
                                                 //   PHP to count absents in working days
                        $myDate   = strtotime(date('Y-m-d'));
                        $workDays = 0;
                        $days     = date('d');
                        while ($days > 0) {
                            $day = date("D", $myDate); // Sun - Sat
                            if ($day != "Sun") {
                                $workDays++;
                            }

                            $days--;
                            $myDate += 86400; // 86,400 seconds = 24 hrs.
                        }
                        // PHP to count total working days in the present month
                        $daysInMonth   = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
                        $workDaysMonth = 0;

                        while ($daysInMonth > 0) {
                            $day = date("D", $myDate); // Sun - Sat
                            if ($day != "Sun") {
                                $workDaysMonth++;
                            }

                            $daysInMonth--;
                            $myDate += 86400; // 86,400 seconds = 24 hrs.
                        }
                        /****************************************************************/
                        $result = mysqli_query($con, "SELECT * FROM employees
                        INNER JOIN attendance ON attendance.emp_id = employees.emp_id
                        INNER JOIN positions ON positions.pos_id = employees.pos_id
                        INNER JOIN salaries ON salaries.pos_id = positions.pos_id
                        INNER JOIN departments ON departments.dept_id = positions.dept_id
                        WHERE attendance.attend_date = '$today'");
                        $j = mysqli_num_rows($result); # $j = No of rows in db
                        if ($j = 0) {
                            echo "No result found!";
                        } else {
                            $i = 0;
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <tr>

                                <td><?php echo $i + 1 ?></td>   <!-- Serial No Generate -->
                                <td>
                                    <?php
                                        $emp_id = $row["emp_id"];
                                                echo $emp_id;
                                            ?>
                                </td>
                                <td><?php echo $row["name"]; ?></td>
                                <td><?php echo $row["gender"]; ?></td>
                                <td><?php echo $row["pos_name"]; ?></td>
                                <td><?php echo $row["dept_name"]; ?></td>

                                <td>
                                    <?php
                                        $attend      = mysqli_query($con, "SELECT count(*) AS count FROM attendance WHERE attend_date > '$first' AND emp_id = $emp_id");
                                                $rows        = mysqli_fetch_array($attend);
                                                $attendCount = $rows['count'];
                                                echo $attendCount;
                                            ?>
                                </td>
                                <td>
                                    <?php
                                        $absent = $workDays - $attendCount;
                                                echo $absent;
                                            ?>
                                </td>

                                <td><?php echo $row["doj"]; ?></td>
                                <td><?php echo $row["dob"]; ?></td>
                                <td><?php echo $row["email"]; ?></td>
                                <td><?php echo $row["phone"]; ?></td>
                                <td><?php echo $row["city"]; ?></td>
                                <td><?php echo $row["address"]; ?></td>

                                </tr>
                            <?php
                                $i++;
                                    }
                                ?>
<?php
    }
?>
                </table>
            </div>
        </div>
    </div>
    <script src="../../js/script.js"> </script>
</body>
</html>