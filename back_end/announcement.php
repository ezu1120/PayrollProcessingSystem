<?php
    include '../connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Announcements</title>
</head>
<body>
    <div class="bg_announce">
        <div class="header">

        <p style="margin-left: 200px;">Payroll Management System</p>
            <a href="index.html">Home</a>
            <a href="support.php">Support</a>
            <a href="announcement.php">Announcements</a>
            <a href="faqs.html">FAQs</a>
        </div>

        <div>
            <h1>ANNOUNCEMENTS</h1>
        </div>
        <?php
            $result = mysqli_query($con, "SELECT * FROM announcements");
            while ($row = mysqli_fetch_array($result)) {
            ?>
        <div class="read-more-container">

            <div class="announce_container" style="border: 1px solid green">
                <p >Date:                                                   <?php echo $row['dateposted'] ?>  Time:<?php echo $row['timeposted'] ?>
                <span class="read-more-text">
                    <?php echo $row['announce_msg'] ?>
                </span>
                </p>
            <span class="read-more-btn">Read More...</span>
            </div>


        </div>
        <?php
            }
        ?>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
          
            const readMoreBtns = document.querySelectorAll('.read-more-btn');

            
            readMoreBtns.forEach((btn) => {
                btn.addEventListener('click', function (event) {
                    const currentText = event.target.parentNode.querySelector('.read-more-text');

                    // Toggle the class to show or hide the full announcement text
                    currentText.classList.toggle('read-more-text--show');

                    // Change the button text based on whether it's showing the full text or not
                    event.target.textContent = currentText.classList.contains('read-more-text--show') ? "Read Less..." : "Read More...";
                });
            });
        });
    </script>

</body>
</html>
