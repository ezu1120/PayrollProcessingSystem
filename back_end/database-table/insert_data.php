<?php
include("create_database.php");


$con = new mysqli("localhost", "root", "","payroll");
if(!$con){
  die("couldn't conect to the created database ===========> ".mysqli_error($con));
}

$sql = "INSERT INTO `allowances` (`alw_id`, `allowance`, `emp_id`) VALUES
(1, 10000, 1);";
// (2, 1500, 2),
// (3, 0, 3);";

if (!$con->query($sql) ) {
    echo $con->error;
  }

$sql = "INSERT INTO `announcements` (`announce_id`, `announce_msg`, `dateposted`, `timeposted`) VALUES
(1, 'Aslamo Alekum,\r\nThis is to notify all the departments and employees to have EID-UL-AZHA holidays w.e.f 21-07-2021.\r\nBest Wishes,\r\nCEO Carbon Company\r\nDated: 20-07-2021.', '2021-07-20', '07:42:02');
-- (2, 'Aslamo Alekum, \r\nAll the employees will get 25% bonus in their salaries for the month July, 2021. So, all the employees must work properly and happily. We will be contributing in your joys.\r\nBest Wishes,\r\nCEO Carbon Company.', '2021-07-20', '07:55:53'),
-- (3, 'Aslamo Alekum,\r\nAll the employees can withdraw their salaries today in advance. We will always be contributing in your joys.\r\nGood Luck,\r\nCEO Carbon Company\r\n', '2021-07-20', '08:10:34');";

if (!$con->query($sql) ) {
    echo $con->error;
  }

$sql = "INSERT INTO `attendance` (`attend_id`, `attend_date`, `attend_time`, `emp_id`) VALUES
(1, '2021-07-01', '01:13:15', 1);
-- (2, '2021-07-01', '01:14:01', 2),
-- (3, '2021-07-01', '01:14:01', 3);";

if (!$con->query($sql) ) {
    echo $con->error;
  }

$sql = "INSERT INTO `deductions` (`ded_id`, `deduction`, `emp_id`) VALUES
(1, 2000, 1);
-- (2, 0, 2),
-- (3, 1500, 3);";

if (!$con->query($sql) ) {
    echo $con->error;
  }

$sql = "INSERT INTO `departments` (`dept_id`, `dept_name`, `hod`) VALUES
(1, 'Admin Department', 'Muhammad Ameer');
-- (2, 'Production Department', 'Zeeshan Sadiq'),
-- (3, 'Sales Department', 'Amjad Khan');";

if (!$con->query($sql) ) {
    echo $con->error;
  }

$sql = "INSERT INTO `employees` (`emp_id`, `name`, `gender`, `doj`, `dob`, `email`, `phone`, `city`, `address`, `pos_id`) VALUES
(1, 'Ahmad Hassan', 'Male', '2020-09-05', '2000-05-06', 'ahmad@hotmail.com', 3001234567, 'Lahore', 'Lahore', 1);
-- (2, 'Ali Khan', 'Male', '2020-09-05', '2000-10-09', 'ali@gmail.com', 3267876565, 'Multan', 'Multan', 1),
-- (3, 'Arbaz Ali', 'Male', '2020-09-05', '2001-11-10', 'arbaz@gmail.com', 316898878, 'Rajanpur', 'Rajanpur', 2);";

if (!$con->query($sql) ) {
    echo $con->error;
  }

$sql = "INSERT INTO `positions` (`pos_id`, `pos_name`, `dept_id`) VALUES
(1, 'Finance', 1),
(2, 'Assistant', 1),
(3, 'Human Resources', 1),
(4, 'Software Engineer', 2),
(5, 'Software Designer', 2),
(6, 'Software Tester', 2),
(7, 'Quality Assurance', 2),
(8, 'Sales Person', 3),
(9, 'Sales Associate', 3),
(10, 'Sales Specialist', 3);";

if (!$con->query($sql) ) {
    echo $con->error;
  }

$sql = "INSERT INTO `salaries` (`sal_id`, `amount`, `pos_id`) VALUES
(1, 50000, 1);
-- (2, 50000, 2),
-- (3, 60000, 3);";

if (!$con->query($sql) ) {
    echo $con->error;
  }

$sql = "INSERT INTO `support` (`spt_id`, `spt_name`, `spt_email`, `spt_subject`, `spt_description`, `spt_date`, `spt_time`) VALUES
(1, 'Ahmad Ali', 'ahmadali@gmail.com', 'Employee Entry In The System', 'With due respect,\r\nit is stated that I have been selected as Sales Person in your company a month ago. Still, I have not been issued with the employee id or user login credentials. Please, provide me the said as early. Good Luck! ', '2021-07-21', '13:12:18');
-- (2, 'Aziz Durrani', 'aziz@gmail.com', 'Forget Login Password', 'With due respect,\r\nIt is stated that I have forgot my login credntials. I cannot change my password or reset it. Kind advice is required immediately, please.\r\nBest Wishes,\r\nUser ID: 101\r\nEmp. ID: 150', '2021-07-21', '14:36:20'),
-- (3, 'Aamir Sohail', 'amir@gmail.com', 'Position Change', 'Dear Sir,\r\nI have applied for position change from Software designer post to Software Engineer post. Now, I have received nomination letter as to have the new post as Software Engineer. So, kindly provide me the new login credentials for my new employee account or update the old one with the new data.\r\nThanks.', '2021-07-21', '15:29:02');";

if (!$con->query($sql) ) {
    echo $con->error;
  }

$sql = "INSERT INTO `users` (`user_id`, `username`, `password`, `nickname`, `type`, `picture`, `emp_id`, `dept_id`) VALUES
(1, 'ameer', 'ameer', 'ameer', 'manager', '', NULL, 1);
-- (2, 'zeeshan', 'zeeshan', 'zeeshan', 'manager', '', NULL, 2),
-- (3, 'amjad', 'amjad', 'amjad', 'manager', '', NULL, 3);";

if (!$con->query($sql) ) {
    echo $con->error;
  }


?>