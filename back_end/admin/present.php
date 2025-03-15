<?php
include '../../connection.php';

// Initialize session
session_start();
$id = $_SESSION['id'];

if ($_SESSION['loggedin'] !== true) {
    header('location: ../../login.php');
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
                    // Fetch user picture
                    $img = mysqli_query($con, "SELECT picture FROM users WHERE user_id = $id");
                    $row = mysqli_fetch_array($img);

                    if (!empty($row['picture'])) {
                        echo '<img src="' . $row["picture"] . '" alt="User Photo" width="45%">';
                    } else {
                        echo '<img src="../../front_end/images/user.png" alt="User Photo" width="45%">';
                    }
                    ?>
                    <span style="display: block;">Welcome, <?php echo $_SESSION['name']; ?></span>
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
                <p style="margin-left: 5%; margin-top:2%"> All the present employees today are displayed here. </p>
                <hr style="border-width:1px;width:90%;text-align:center;margin:2%">
                
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
                    $today = date('Y-m-d');
                    $first = date('Y-m-01'); // First day of the current month

                    // Count total working days this month
                    $totalDays = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
                    $workDaysMonth = 0;

                    for ($d = 1; $d <= $totalDays; $d++) {
                        $date = date('Y-m-' . sprintf("%02d", $d));
                        if (date('N', strtotime($date)) != 7) { // Exclude Sundays
                            $workDaysMonth++;
                        }
                    }

                    // Fetch employee attendance
                    $result = mysqli_query($con, "
                        SELECT employees.*, positions.pos_name, departments.dept_name, COUNT(attendance.emp_id) AS attend_count
                        FROM employees
                        LEFT JOIN attendance ON attendance.emp_id = employees.emp_id AND attendance.attend_date >= '$first'
                        INNER JOIN positions ON positions.pos_id = employees.pos_id
                        INNER JOIN departments ON departments.dept_id = positions.dept_id
                        GROUP BY employees.emp_id
                    ");

                    if (mysqli_num_rows($result) == 0) {
                        echo "<tr><td colspan='14' style='text-align:center;'>No results found!</td></tr>";
                    } else {
                        $i = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            $absents = $workDaysMonth - $row['attend_count'];
                            echo "<tr>
                                <td>{$i}</td>
                                <td>{$row['emp_id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['gender']}</td>
                                <td>{$row['pos_name']}</td>
                                <td>{$row['dept_name']}</td>
                                <td>{$row['attend_count']}</td>
                                <td>{$absents}</td>
                                <td>{$row['doj']}</td>
                                <td>{$row['dob']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['phone']}</td>
                                <td>{$row['city']}</td>
                                <td>{$row['address']}</td>
                            </tr>";
                            $i++;
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <script src="../../js/script.js"></script>
</body>
</html>
