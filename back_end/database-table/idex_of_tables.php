<?php 
include("create_database.php");


$con = new mysqli("localhost", "root", "","payroll");
if(!$con){
  die("couldn't conect to the created database ===========> ".mysqli_error($con));
}
$sql = "ALTER TABLE `allowances`
  ADD PRIMARY KEY (`alw_id`),
  ADD KEY `fk_emp_in_alw` (`emp_id`);";
if (!$con->query($sql) ) {
    echo $con->error;
  } 
  
$sql = "ALTER TABLE `announcements`
  ADD PRIMARY KEY (`announce_id`);";

if (!$con->query($sql) ) {
    echo $con->error;
  } 

$sql = "ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attend_id`),
  ADD KEY `fk_emp_in_attend` (`emp_id`);";

if (!$con->query($sql) ) {
    echo $con->error;
  } 

$sql = "ALTER TABLE `deductions`
  ADD PRIMARY KEY (`ded_id`),
  ADD KEY `fk_emp_in_ded` (`emp_id`);";

if (!$con->query($sql) ) {
    echo $con->error;
  } 

$sql = "ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`);";

if (!$con->query($sql) ) {
    echo $con->error;
  } 

$sql = "ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `fk_pos_in_emp` (`pos_id`);";

if (!$con->query($sql) ) {
    echo $con->error;
  } 

$sql = "ALTER TABLE `positions`
  ADD PRIMARY KEY (`pos_id`),
  ADD KEY `fk_positons` (`dept_id`);";

if (!$con->query($sql) ) {
    echo $con->error;
  } 

$sql = "ALTER TABLE `salaries`
  ADD PRIMARY KEY (`sal_id`),
  ADD KEY `fk_pos_in_sal` (`pos_id`);";

if (!$con->query($sql) ) {
    echo $con->error;
  } 

$sql = "ALTER TABLE `support`
  ADD PRIMARY KEY (`spt_id`);";

if (!$con->query($sql) ) {
    echo $con->error;
  } 

  $sql = "ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_emp_in_user` (`emp_id`),
  ADD KEY `fk_dept_in_user` (`dept_id`);";

if (!$con->query($sql) ) {
    echo $con->error;
  } 

?>