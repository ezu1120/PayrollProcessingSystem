<?php
include '../../connection.php';
$name = $_POST['name'];
$hod = $_POST['hod'];

$stmt = $con->prepare("INSERT INTO departments (dept_name, hod) VALUES (?,?)");
$stmt->bind_param("ss", $name, $hod);
$stmt->execute();
echo "New Department Added Successfully!";
header("location: ../../front_end/admin/addDepartment.php.php?status=1");
?>