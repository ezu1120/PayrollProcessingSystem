<?php 
include("create_database.php");


$con = new mysqli("localhost", "root", "","payroll");
if(!$con){
  die("couldn't conect to the created database ===========> ".mysqli_error($con));
}

$sql = "ALTER TABLE `allowances`
  MODIFY `alw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;";

if (!$con->query($sql) ) {
    echo $con->error;
  }

$sql = "ALTER TABLE `announcements`
  MODIFY `announce_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;";

if (!$con->query($sql) ) {
    echo $con->error;
  }

$sql = "ALTER TABLE `attendance`
  MODIFY `attend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;";

if (!$con->query($sql) ) {
    echo $con->error;
  }

$sql = "ALTER TABLE `deductions`
  MODIFY `ded_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;";

if (!$con->query($sql) ) {
    echo $con->error;
  }

$sql = "ALTER TABLE `departments`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;";

if (!$con->query($sql) ) {
    echo $con->error;
  }

$sql = "ALTER TABLE `employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;";

if (!$con->query($sql) ) {
    echo $con->error;
  }

$sql = "ALTER TABLE `positions`
  MODIFY `pos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;";

if (!$con->query($sql) ) {
    echo $con->error;
  }

$sql = "ALTER TABLE `salaries`
  MODIFY `sal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;";

if (!$con->query($sql) ) {
    echo $con->error;
  }

$sql = "ALTER TABLE `support`
  MODIFY `spt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;";

if (!$con->query($sql) ) {
    echo $con->error;
  }

$sql = "ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;";

if (!$con->query($sql) ) {
    echo $con->error;
  }


?>