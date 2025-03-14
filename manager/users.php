<?php
	include '../connection.php';
	// Initialize session
	session_start();
    $id = $_SESSION['id'];
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
                    <span style="display: block;">Welcome <?php echo ucfirst($_SESSION['name']) ?></span>
                    
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
                <div class="area1_user_adm">
                    <a href="add_user.php"><p>Add User</p></a>
                    <a href="delt_user.php"><p>Delete User</p></a>
                </div>
                <div style="clear: both;"></div>
                <input class="searchbar_user_adm" type="text" placeholder="Search User...">
                <hr style="border-width:1px;width:90%;text-align:center">
                <table style="margin-bottom: 30px; width: 90%; margin-left: 5%">
                    <tr>
                        <th>Sr. No</th>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Name</th>
                        <th>User Type</th>
                        <th>Position</th>
                        <th>Department</th>
                    </tr>

                    <?php
                        $result = mysqli_query($con,"SELECT * FROM (((users
                        INNER JOIN employees ON employees.emp_id = users.emp_id)
                        INNER JOIN positions ON positions.pos_id = employees.pos_id)
                        INNER JOIN departments ON departments.dept_id = positions.dept_id)
                        WHERE departments.dept_id = $dept_id ORDER BY users.user_id");
                        $i = 1;
                        while($row = mysqli_fetch_array($result)) {
                        ?>
                                <tr>

                                <td><?php echo $i++ ?></td>   <!-- Serial No Generate -->                                
                                <td><?php echo $row["user_id"]; ?></td>
                                <td><?php echo $row["username"]; ?></td>
                                <td><?php echo $row["password"]; ?></td>
                                <td><?php echo $row["name"]; ?></td>
                                <td><?php echo $row["type"]; ?></td>                                
                                <td><?php echo $row["pos_name"]; ?></td>
                                <td><?php echo $row["dept_name"]; ?></td>

                                </tr>
                            <?php
                            }
                            ?>
                </table>
            </div>
        </div>
    </div>
    <div id="popup">
        Employee has been deleted succeesfully!
    </div>
    <div id="popup2">
        Employee ID not found!
    </div>
    <div id="popup3">
        Sorry! This Employee does not belong to your department!
    </div>

    <?php
    $recordAdded = false;

    if(isset($_GET['status']) && $_GET['status'] == 1){
       $recordAdded = true;
    }

    if($recordAdded)
    {
     echo '
       <script type="text/javascript">
         function hideMsg()
         {
            document.getElementById("popup").style.visibility = "hidden";
         }

         document.getElementById("popup").style.visibility = "visible";
         window.setTimeout("hideMsg()", 2500);
       </script>';
    }
?>

<?php
    $found = false;

    if(isset($_GET['status']) && $_GET['status'] == 2){
       $found = true;
    }

    if($found)
    {
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
<?php
    $belong = false;

    if(isset($_GET['status']) && $_GET['status'] == 3){
       $belong = true;
    }

    if($belong)
    {
     echo '
       <script type="text/javascript">
         function hideMsg()
         {
            document.getElementById("popup3").style.visibility = "hidden";
         }

         document.getElementById("popup3").style.visibility = "visible";
         window.setTimeout("hideMsg()", 3500);
       </script>';
    }
?>
    <script src="../js/script.js"> </script>
</body>
</html>