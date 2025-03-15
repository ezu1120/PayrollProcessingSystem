<?php

$con = new mysqli("localhost", "root", "", "payroll");
if (! $con) {
    die("couldn't conect to the created database ===========> " . mysqli_error($con));
}

$sql = "ALTER TABLE `allowances`
  ADD CONSTRAINT `fk_emp_in_alw` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`) ON DELETE SET NULL;";

if (! $con->query($sql)) {
    echo $con->error;
}

$sql = "ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_emp_in_attend` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`) ON DELETE SET NULL;";

if (! $con->query($sql)) {
    echo $con->error;
}

$sql = "ALTER TABLE `deductions`
  ADD CONSTRAINT `fk_emp_in_ded` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`) ON DELETE SET NULL;";

if (! $con->query($sql)) {
    echo $con->error;
}

$sql = "ALTER TABLE `employees`
  ADD CONSTRAINT `fk_pos_in_emp` FOREIGN KEY (`pos_id`) REFERENCES `positions` (`pos_id`) ON DELETE CASCADE;";

if (! $con->query($sql)) {
    echo $con->error;
}

$sql = "ALTER TABLE `positions`
  ADD CONSTRAINT `fk_positons` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`dept_id`) ON DELETE CASCADE;";

if (! $con->query($sql)) {
    echo $con->error;
}

$sql = "ALTER TABLE `salaries`
  ADD CONSTRAINT `fk_pos_in_sal` FOREIGN KEY (`pos_id`) REFERENCES `positions` (`pos_id`) ON DELETE SET NULL;
";

if (! $con->query($sql)) {
    echo $con->error;
}

$sql = "ALTER TABLE `users`
  ADD CONSTRAINT `fk_dept_in_user` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`dept_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_emp_in_user` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`) ON DELETE CASCADE;";

if (! $con->query($sql)) {
    echo $con->error;
}

$sql = "COMMIT;";

if (! $con->query($sql)) {
    echo $con->error;
}
?>