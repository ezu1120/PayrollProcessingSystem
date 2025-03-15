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
    <title>Users</title>
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
                        <img src="../../front_end/images/user.png" alt="User Photo" width="45%"> <!-- This Dummy image will be displayed if user img not found in DB -->
                        <?php
                            } else {
                                // echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['picture'] ).'" width="100" eight="100"/>';
                                echo '<img src="../../front_end/images/user.png" alt="User Photo" width="45%">';
                                // echo '<img src= "' . $row["picture"] . '" width="100" eight="100"/>';
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
                <div class="area1_emp_adm">
                    <div class="area2" style="margin-left: 45%;">
                    <span class="addU">Add User</span>
                    <span class="deleteU">Delete User</span>
                    </div>

                    <!-- <a href="addUser.php"><p>Add User</p></a>
                    <a href="delt_user.php"><p>Delete User</p></a> -->
                </div>
                <div style="clear: both;"></div>
                <input class="searchbar_emp_adm" type="text" placeholder="Search User...">
                <hr style="border-width:1px;width:100%;text-align:center ; margin:2%;">
                <table style="width: 85%; font-size: 16px;margin-left:7%">
                    <tr>
                        <th>Sr. No</th>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>User Type</th>
                        <th>Position</th>
                        <th>Department</th>
                    </tr>
                    <tr>
                        <?php
                            $admin = mysqli_query($con, "SELECT * FROM users where user_id = 1");
                            $row   = mysqli_fetch_array($admin);
                        ?>
                        <!-- <td>1</td>
                        <td><?php echo $row['user_id'] ?></td>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo $row['password'] ?></td>
                        <td><?php echo $row['type'] ?></td>
                        <td>CEO</td>
                        <td></td> -->

                    </tr>

                    <?php
                        $manager = mysqli_query($con, "SELECT * FROM users
                        INNER JOIN departments ON departments.dept_id =users.dept_id WHERE users.type = 'manager' ");
                        $i = 0;
                        while ($row = mysqli_fetch_array($manager)) {
                        ?>
                                <tr>

                                <td><?php echo $i + 1 ?></td>   <!-- Serial No Generate -->
                                <td><?php echo $row["user_id"]; ?></td>
                                <td><?php echo $row["username"]; ?></td>
                                <td><?php echo $row["password"]; ?></td>
                                <td><?php echo $row["type"]; ?></td>
                                <td>Manager</td>
                                <td><?php echo $row["dept_name"]; ?></td>

                                </tr>
                            <?php
                                $i++;
                                }
                            ?>


                    <?php
                        $result = mysqli_query($con, "SELECT * FROM (((users
                        INNER JOIN employees ON employees.emp_id = users.emp_id)
                        INNER JOIN positions ON positions.pos_id = employees.pos_id)
                        INNER JOIN departments ON departments.dept_id = positions.dept_id)
                        ORDER BY users.user_id");

                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                                <tr>

                                <td><?php echo $i + 1 ?></td>   <!-- Serial No Generate -->
                                <td><?php echo $row["user_id"]; ?></td>
                                <td><?php echo $row["username"]; ?></td>
                                <td><?php echo $row["password"]; ?></td>
                                <td><?php echo $row["type"]; ?></td>
                                <td><?php echo $row["pos_name"]; ?></td>
                                <td><?php echo $row["dept_name"]; ?></td>

                                </tr>
                            <?php
                                $i++;
                                }
                            ?>
                </table>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector(".addU").addEventListener("click", function() {
        window.location.href = "../../front_end/admin/addUser.php"; // Change this URL to your desired page
    });
    document.querySelector(".deleteU").addEventListener("click", function() {
        window.location.href = "../../front_end/admin/delt_user.php"; // Change this URL to your desired page
    });
    });

    </script>
    <script src="../../js/script.js"> </script>
</body>
</html>