document.addEventListener("DOMContentLoaded", function () {
    var navIcon = document.querySelector(".app-header-left svg");
    var sidebar = document.querySelector(".sidebar");
    var task_bar = document.querySelector(".task_area")
    navIcon.addEventListener("click", function () {
        sidebar.classList.toggle("show-sidebar");
        task_bar.classList.toggle("task_area2");
    });
    document.querySelector(".present").addEventListener("click", function() {
        window.location.href = "../admin/ present.php"; // Change this URL to your desired page
    });
    document.querySelector(".absent").addEventListener("click", function() {
        window.location.href = "../back_end/admin/absent.php"; // Change this URL to your desired page
    });
    document.querySelector(".total_emp").addEventListener("click", function() {
        window.location.href = "../front_end/admin/employees.php"; // Change this URL to your desired page
    });
    document.querySelector(".attendance").addEventListener("click", function() {
        window.location.href = "../admin/attendance.php"; // Change this URL to your desired page
    });
    document.querySelector(".employees").addEventListener("click", function() {
        window.location.href = "../front_end/admin/employees.php"; // Change this URL to your desired page
    });
    document.querySelector(".departments").addEventListener("click", function() {
        window.location.href = "../front_end/admin/departments.php"; // Change this URL to your desired page
    });
    document.querySelector(".payrolls").addEventListener("click", function() {
        window.location.href = "../back_end/admin/payrolls.php"; // Change this URL to your desired page
    });

    

        fetch("../database_tables/insert_data.php")
        .then(data => console.log("Server Response:", data))
        .catch(error => console.error("Error inserting data:", error));



});
