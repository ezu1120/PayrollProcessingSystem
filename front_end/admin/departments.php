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
    <title>Department</title>
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
                    <span class="deleteP">Delete Position</span>
                    <span class="addP">Add Position</span>
                    <span class="deleteD">Delete Department</span>
                    <span class="addD">Add Department</span>

                    </div>
                    <!-- <a href="delt_position.php"><p>Delete Position</p></a>
                    <a href="addPosition.php"><p>Add Position</p></a>
                    <a href="delt_dept.php"><p>Delete Department</p></a>
                    <a href="addDepartment.php"><p>Add Department</p></a> -->
                </div>

                <input class="searchbar_emp_adm" type="text" placeholder="Search Department...">
                <hr style="border-width:1px;width:100%;text-align:center ; margin:2%;">
                <table style="width: 85%; font-size: 16px;margin-left:7%">
                    <tr>
                        <th>Sr. No</th>
                        <th>Dept. ID</th>
                        <th>Dept. Name</th>
                        <th>HOD</th>
                        <!-- <th>Positions</th>
                        <th>Employees</th> -->

                        <?php
                            $result = mysqli_query($con, "SELECT * FROM departments");
                            $j      = mysqli_num_rows($result);
                            if ($j = 0) {
                                echo "No department found!";
                            } else {
                                $i = 0;
                                while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>

                                <td><?php echo $i + 1 ?></td>   <!-- Serial No Generate -->
                                <td><?php echo $row["dept_id"]; ?></td>
                                <td><?php echo $row["dept_name"]; ?></td>
                                <td><?php echo $row["hod"]; ?></td>

                                </tr>
                            <?php
                                $i++;
                                    }
                                ?>
<?php
    }
?>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector(".addP").addEventListener("click", function() {
        window.location.href = "addPosition.php"; // Change this URL to your desired page
    });
    document.querySelector(".deleteP").addEventListener("click", function() {
        window.location.href = "delt_position.php"; // Change this URL to your desired page
    });
    document.querySelector(".addD").addEventListener("click", function() {
        window.location.href = "addDepartment.php"; // Change this URL to your desired page
    });
    document.querySelector(".deleteD").addEventListener("click", function() {
        window.location.href = "delt_dept.php"; // Change this URL to your desired page
    });});

    </script>
    <script src="../js/script.js"> </script>
</body>
</html>