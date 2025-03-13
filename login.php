<?php
include 'database_tables/create_database.php';
include 'database_tables/create_tables.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>User Login</title>
</head>
<body>
    <div style="height: 100vh; overflow: hidden;">
        <div class="header">
            <div class="logo">
                <!-- <img src="images/pms_logo.jpeg" alt="pms_logo" width="85%"> -->
            </div>
            <p>Payroll Management System</p>
            <a href="index.html">Home</a>
            <a href="support.php">Support</a>
            <a href="announcement.php">Announcements</a>
            <a href="faqs.html">FAQs</a>
        </div>


    <div class="login-box">
        <div class="login-logo">
            <a href="index.html"></a>
            <h1>Payroll Management</h1>
            
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Please login to start your session</p>
            <form method="POST" action="authenticate.php" role="form" data-toggle="validator" id="login-form">
                <div class="form-group has-feedback">
                 <!-- <label for="username">Username</label> -->
                    <input type="text" class="form-control" id="code" name="username" placeholder="Type Your Username" required />
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                <!-- <label for="username">Password</label> -->

                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <button type="submit" class="btn btn-success btn-block btn-flat">Login</button>
            </form>
        </div>
    </div>
</div>

















        <!-- <div class="bg_login_img">
            <div class="login_container">
                <p>LOGIN</p>            
                <div id="clock"></div>
                <form class="login_form" action="authenticate.php" method="post">
                    <label for="username">Username</label>
                    <input type="text" placeholder="Type Your Username" name="username">

                    <label for="username">Password</label>
                    <input type="password" placeholder="Type Your Password" name="password">

                    <input class="login-submit" type="submit" value="Login">                
                    <a href="forget_password.php" target="_self">Forgot Password</a>           
                </form>
            </div>
        </div>
    </div> -->

    <script type="text/javascript">
        var clockElement = document.getElementById('clock');
        function clock() {
            clockElement.textContent = new Date().toLocaleTimeString();
        }
        setInterval(clock, 1000);
    </script>

    
    
    <div id="popupLogin">
        Incorrect username or password!
    </div>

    <div id="popupLogin2">
        Congratulations! password changed successfully!
    </div>

    <?php
    $invalid = false;

    if(isset($_GET['status']) && $_GET['status'] == 1){
       $invalid = true;
    }

    if($invalid)
    {
     echo '
       <script type="text/javascript">
         function hideMsg()
         {
            document.getElementById("popupLogin").style.visibility = "hidden";
         }

         document.getElementById("popupLogin").style.visibility = "visible";
         window.setTimeout("hideMsg()", 3500);
       </script>';
    }
    ?> 

<?php
    $done = false;

    if(isset($_GET['status']) && $_GET['status'] == 2){
       $done = true;
    }

    if($done)
    {
     echo '
       <script type="text/javascript">
         function hideMsg()
         {
            document.getElementById("popupLogin2").style.visibility = "hidden";
         }

         document.getElementById("popupLogin2").style.visibility = "visible";
         window.setTimeout("hideMsg()", 3500);
       </script>';
    }
    ?>

</body>
</html>