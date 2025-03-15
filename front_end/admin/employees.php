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
 <link rel="stylesheet" href="front_end/css/style.css">
    <title>Employees</title>
</head>
<body>
    <div style="overflow: hidden; height: 100vh;">
        <div class="header">
        <div class="app-header-left" style="padding-left:10px;">
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
                <a href="../admin/dashboard.php">Dashboard</a>
                <a href="../admin/employees.php">Employees</a>
                <a href="../admin/departments.php">Departments</a>
                <a href="../admin/payrolls.php">Payrolls</a>
                <a href="../admin/users.php">Users</a>
                <a href="../logout.php">Logout</a>
            </div>
        </div>
        <div class="task_area">
            <div class="bg_task_area">
                <div class="area1_emp_adm">
                    <div class="area2">
                    <!-- <span class="addE">Add New Employee</span> -->
                    <span class="addE">Add New Employee</span>
                    <span class="deleteE">Delete An Employee</span>
                    <span class="allowance">Allowance</span>
                    <span class="deduction">Deduction</span>

                    </div>

                    <!-- <a href="addEmp.php"> <span class="addE">Add New Employee</span></a>
                    <a href="delt_emp.php"><p>Delete An Employee</p></a>


                    <a href="allowance.php"><p>Allowance</p></a>
                    <a href="deduction.php"><p>Deduction</p></a> -->

                    <div style="clear: both;"></div>
                </div>
                <input class="searchbar_emp_adm" type="text" placeholder="Search Employee...">
                <div id="results"></div>
                <hr style="border-width:1px;width:100%;text-align:center ; margin:2%;">

        <table style="width: 90%; margin-left: 5%">
                    <tr>
                        <th>Sr. No</th>
                        <th>Emp. ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>DOJ</th>
                        <th>DOB</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Address</th>
                    </tr>

                    <?php
                        $today  = date('Y-m-d');
                        $result = mysqli_query($con, "SELECT * FROM employees
                        WHERE NOT EXISTS (SELECT * FROM attendance WHERE attendance.emp_id = employees.emp_id
                        AND attendance.attend_date = $today)");
                        $j = mysqli_num_rows($result); # $j = No of rows in db
                        if ($j = 0) {
                            echo "Hurrah! No absent found!";
                            echo "All the employees are present";
                        } else {
                            $i = 0;
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <tr>

                                <td><?php echo $i + 1 ?></td>   <!-- Serial No Generate -->
                                <td><?php echo $row["emp_id"]; ?></td>
                                <td><?php echo $row["name"]; ?></td>
                                <td><?php echo $row["gender"]; ?></td>
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
                                }
                            ?>

                </table>


                <table style="width: 85%; font-size: 16px;margin-left:7%">
                    <tr>
                        <th>Sr. No</th>
                        <th>Emp. ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Salary</th>
                        <th>Allowance</th>
                        <th>Deduction</th>
                        <th>DOJ</th>
                        <th>DOB</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Address</th>
                    </tr>

                    <?php
                        $result = mysqli_query($con, "SELECT  *
                 FROM employees
                    INNER JOIN positions ON employees.pos_id = positions.pos_id
                    INNER JOIN departments ON positions.dept_id = departments.dept_id
                    LEFT JOIN allowances ON allowances.emp_id = employees.emp_id
                    LEFT JOIN deductions ON deductions.emp_id = employees.emp_id
                    ORDER BY employees.emp_id;
                    --  LEFT JOIN salaries ON salaries.pos_id = position s.pos_id
                ");

                        // $result = mysqli_query($con,"SELECT * FROM (((((departments
                        // INNER JOIN positions ON positions.dept_id = departments.dept_id)
                        // INNER JOIN employees ON employees.pos_id = positions.pos_id)
                        // INNER JOIN allowances ON allowances.emp_id = employees.emp_id)
                        // INNER JOIN deductions ON deductions.emp_id = employees.emp_id)
                        // INNER JOIN salaries ON salaries.pos_id = positions.pos_id)
                        // ORDER BY employees.emp_id
                        // ");
                        $j = mysqli_num_rows($result);
                        // echo $j;  # $j = No of rows in db
                        if ($j = 0) {
                            echo "No result found!";
                        } else {
                            $i = 0;
                            while ($row = mysqli_fetch_array($result)) {

                            ?>
                                <tr>

                                <td><?php echo $i + 1 ?></td>   <!-- Serial No Generate -->
                                <td><?php echo $row["emp_id"]; ?></td>
                                <td><?php echo $row["name"]; ?></td>
                                <td><?php echo $row["gender"]; ?></td>
                                <td><?php echo $row["dept_name"]; ?></td>
                                <td><?php echo $row["pos_name"]; ?></td>
                                <td><?php echo 0; ?></td>
                                <td><?php echo $row["allowance"]; ?></td>
                                <td><?php echo $row["deduction"]; ?></td>
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
                                }
                            ?>
        </table>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector(".addE").addEventListener("click", function() {
        window.location.href = "addEmp.php"; // Change this URL to your desired page
    });
    document.querySelector(".deleteE").addEventListener("click", function() {
        window.location.href = "delt_emp.php"; // Change this URL to your desired page
    });
    document.querySelector(".allowance").addEventListener("click", function() {
        window.location.href = "allowance.php"; // Change this URL to your desired page
    });
    document.querySelector(".deduction").addEventListener("click", function() {
        window.location.href = "deduction.php"; // Change this URL to your desired page
    });});

    </script>
    <script src="../../js/script.js"> </script>
</body>
</html>
