<?php
include 'connection.php';
   include 'back_end/database-table/insert_data.php';
include 'back_end/database-table/idex_of_tables.php';
include 'back_end/database-table/auto_increment.php';
include 'back_end/database-table/table_constraints.php';

session_start();
$user  = $_POST['username'];
$error = "Incorrect username or password!";
if (mysqli_connect_errno()) {

    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


if (! isset($_POST['username'], $_POST['password'])) {

    exit('Please fill both the username and password fields!');
}


if ($stmt = $con->prepare('SELECT user_id, emp_id, password, type FROM users WHERE username = ?')) {

    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $emp_id, $password, $type);
        $stmt->fetch();

        if ($_POST['password'] === $password) {
            // Verification success! User has logged-in!
            if ($type === "admin") {
                session_regenerate_id();
                $_SESSION['loggedin'] = true;
                $_SESSION['name']     = $_POST['username'];
                $_SESSION['id']       = $id;
                $_SESSION['emp_id']   = $emp_id;
                header("location: front_end/admin/dashboard.php");
            } else if ($type === "manager") {
                session_regenerate_id();
                $result               = mysqli_query($con, "SELECT dept_id FROM users WHERE username = '$user'");
                $row                  = mysqli_fetch_array($result);
                $dept_id              = $row['dept_id'];
                $_SESSION['loggedin'] = true;
                $_SESSION['name']     = $_POST['username'];
                $_SESSION['id']       = $id;
                $_SESSION['dept_id']  = $dept_id;
                header("location: manager\dashboard.php");
            } else if ($type === "employee") {
                session_regenerate_id();
                $_SESSION['loggedin'] = true;
                $_SESSION['name']     = $_POST['username'];
                $_SESSION['id']       = $id;
                $_SESSION['emp_id']   = $emp_id;

                /**** CODE FOR MARKING THE ATTENDANCE   ****/
                $today                  = date('Y-m-d');
                $tm                     = date('h:i:s');
                $_SESSION['attendance'] = false;
                $result                 = mysqli_query($con, "SELECT count(*) AS count FROM `attendance` WHERE emp_id = $emp_id AND attend_date = '$today'");
                $row                    = mysqli_fetch_array($result);
                $count                  = $row['count'];
                //to mark the attendance once per day
                if ($count == 0) {
                    $stmt = $con->prepare("INSERT INTO attendance (attend_date, attend_time, emp_id) VALUES (?,?,?)");
                    $stmt->bind_param("ssi", $today, $tm, $emp_id);
                    $stmt->execute();
                    $_SESSION['attendance'] = true;
                    header("location: employee/dashboard.php?status=3");
                    exit();
                }
                header("location: employee/dashboard.php");
            }

        } else {
            // Incorrect password
            echo 'Incorrect username or password! Go back to enter valid username and password.';
            header("location: login.php?status=1");
        }
    } else {
        // Incorrect username
        echo 'Incorrect username or password! Go back to enter valid username and password.';
        header("location: login.php?status=1");
    }

    $stmt->close();
}
