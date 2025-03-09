<?php
// Copying form data into variables
$name = $_POST['name'];
$gender = $_POST['gender'];
// $position = $_POST['position'];
$position = "Software Engineer";
$doj = $_POST['doj'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$city = $_POST['city'];
$address = $_POST['address'];

// Connecting with the database   
$con = new mysqli('localhost', 'root', '', 'payroll');

// Check connection
if ($con->connect_error) {
    die('Connection Failed : ' . $con->connect_error);
} else {
    // Inserting into employees table
    $result = mysqli_query($con, "SELECT pos_id FROM positions WHERE pos_name = '$position'");
    if ($result) {
        $row = mysqli_fetch_array($result);
        if ($row) {
            $pos_id = $row[0];

            $stmt = $con->prepare("INSERT INTO `employees` (`name`, `gender`, `doj`, `dob`, `email`, `phone`, `city`, `address`, `pos_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssissi", $name, $gender, $doj, $dob, $email, $phone, $city, $address, $pos_id);

            if ($stmt->execute()) {
                $lastId = $con->insert_id;

                // Insert into allowances and deductions
                $val = 0;
                $alw = $con->prepare("INSERT INTO allowances (allowance, emp_id) VALUES (?, ?)");
                $alw->bind_param("ii", $val, $lastId);
                $alw->execute();

                $ded = $con->prepare("INSERT INTO deductions (deduction, emp_id) VALUES (?, ?)");
                $ded->bind_param("ii", $val, $lastId);
                $ded->execute();

                // Redirect to the addEmp page
                header("Location: ../admin/addEmp.php?status=1");
                exit;
            } else {
                echo "Error inserting employee: " . $stmt->error;
            }
            $stmt->close();

        } else {
            echo "Position not found.";
        }
    } else {
        echo "Error querying position: " . mysqli_error($con);
    }

    // Close the statement and connection
   
    $con->close();
}
?>
