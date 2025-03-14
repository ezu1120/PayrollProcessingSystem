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
        <div class="task_area">
            <div class="bg_task_area">
                <p style="margin-left: 100px">Enter following details to delete an existing positon.</p>
                <hr style="border-width:1px;width:90%;text-align:center">
                <form class="addEmpForm" action="deltPosProcess.php" method="post">

                    <label for="pos_id">Position ID</label>
                    <input type="text" name="pos_id" style="margin-bottom: 20px">

                    <input type="submit" value="Delete Position" style="color: white">
                </form>
            </div>
        </div>
    </div>
    <div id="popup">
        Department is deleted successfully!
    </div>


    <div id="popup2">
        Department ID does not exist. Try again.
    </div>
    <?php
        $deleted = false;

        if (isset($_GET['status']) && $_GET['status'] == 1) {
            $deleted = true;
        }

        if ($deleted) {
            echo '
       <script type="text/javascript">
         function hideMsg()
         {
            document.getElementById("popup").style.visibility = "hidden";
         }

         document.getElementById("popup").style.visibility = "visible";
         window.setTimeout("hideMsg()", 3000);
       </script>';
        }
    ?>


    <?php
        $exist = false;

        if (isset($_GET['status']) && $_GET['status'] == 2) {
            $exist = true;
        }

        if ($exist) {
            echo '
       <script type="text/javascript">
         function hideMsg()
         {
            document.getElementById("popup2").style.visibility = "hidden";
         }

         document.getElementById("popup2").style.visibility = "visible";
         window.setTimeout("hideMsg()", 3000);
       </script>';
        }
    ?>
        <script src="../../js/script.js"> </script>

</body>
</html>