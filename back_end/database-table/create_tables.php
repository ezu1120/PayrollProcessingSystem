<?php
include("create_database.php");

$con = new mysqli("localhost", "root", "","payroll");
if(!$con){
  die("couldn't conect to the created database ===========> ".mysqli_error($con));
}


$sql1 = "CREATE TABLE IF NOT EXISTS `allowances` (
  `alw_id` int(11) NOT NULL,
  `allowance` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
if (!$con->query($sql1) ) {
  echo $con->error;
} 

$sql2 = "CREATE TABLE IF NOT EXISTS `announcements` (
  `announce_id` int(11) NOT NULL,
  `announce_msg` varchar(1500) NOT NULL,
  `dateposted` date NOT NULL,
  `timeposted` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
if (!$con->query($sql2) ) {
  echo $con->error;
} 

$sql3 = "CREATE TABLE IF NOT EXISTS `attendance` (
  `attend_id` int(11) NOT NULL,
  `attend_date` date NOT NULL,
  `attend_time` time NOT NULL,
  `emp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
if (!$con->query($sql3) ) {
  echo $con->error;
} 

$sql4 = "CREATE TABLE IF NOT EXISTS `deductions` (
  `ded_id` int(11) NOT NULL,
  `deduction` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if (!$con->query($sql4) ) {
  echo $con->error;
} 

$sql5 = "CREATE TABLE IF NOT EXISTS `departments` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(100) NOT NULL,
  `hod` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if (!$con->query($sql5) ) {
echo $con->error;
} 
$sql6 = "CREATE TABLE IF NOT EXISTS `positions` (
  `pos_id` int(11) NOT NULL,
  `pos_name` varchar(200) NOT NULL,
  `dept_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if (!$con->query($sql6) ) {
echo $con->error;
} 
$sql7 = "CREATE TABLE IF NOT EXISTS `salaries` (
  `sal_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `pos_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if (! $con->query($sql7) ) {
  echo "". $con->error;
}
$sql8 = "CREATE TABLE IF NOT EXISTS `support` (
  `spt_id` int(11) NOT NULL,
  `spt_name` varchar(100) NOT NULL,
  `spt_email` varchar(100) NOT NULL,
  `spt_subject` varchar(500) NOT NULL,
  `spt_description` varchar(2000) NOT NULL,
  `spt_date` date NOT NULL,
  `spt_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if (!$con->query($sql8) ) {
  echo "". $con->error;
} 

$sql9 = "CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `picture` blob NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if (!$con->query($sql9) ) {
  echo $con->error;
} else {
  $sql1 = "INSERT INTO `users` (`user_id`, `username`, `password`, `nickname`, `type`, `picture`, `emp_id`, `dept_id`) VALUES
  (0, 'EBISA', 'abc123', 'ebisa', 'admin', '../images/user.png', NULL, NULL);";
   if ($con->query($sql1) ) {
    echo "". $con->error;
   } 
}

$sql10 = "CREATE TABLE IF NOT EXISTS `employees` (
  `emp_id` INT NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `doj` varchar(50) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `email` varchar(100) UNIQUE NOT NULL,
  `phone` bigint(20) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `pos_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

if (!$con->query($sql10) ) {
echo $con->error;
} 
?>