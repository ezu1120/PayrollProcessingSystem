document.addEventListener("DOMContentLoaded", function () {
    var navIcon = document.querySelector(".app-header-left svg");
    var sidebar = document.querySelector(".sidebar");
    var task_bar = document.querySelector(".task_area")
    navIcon.addEventListener("click", function () {
        sidebar.classList.toggle("show-sidebar");
        task_bar.classList.toggle("task_area2");
    });
});
