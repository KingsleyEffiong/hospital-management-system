<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="../awesome-font/css/font-awesome.min.css">
    <title>Doctor Dashboard</title>
</head>
<body>
<nav class="navbar">

<button id='btn' onClick="patient_list()">Patient Lists</button>
    <div class="logo">
        <span style="font-size:2rem; color:#fff;">Doctor Dashboard</span>
    </div>
<form method="post" action="./../../config/code.php" id="logoutform">
        <input type="hidden" name="action" value="logout"/>    
          <i class="fa fa-sign-out" id="sign-out"onclick="document.getElementById('logoutform').submit();"></i>
    </form>
         </nav>
         <div class="sidebar">
<div class="togglebar">
<i class="fa fa-bars"></i>
<i class="fa fa-times"></i>
</div>
<div class="checkbar">
<i class='fa fa-calendar-check-o active'></i>
<i class='fa fa-envelope active'></i> 
<i class='fa fa-user-circle-o active'></i>
</div>
</div>
<script>
        const patientForm = function(){
            let url = 'patient-registration-form/';
            window.parent(location = (url));
        }

        const patient_list = ()=>{
            let url = "patients.php";
            window.parent(location = (url));
        }

const addEvent  = document.getElementById("btn");
const show = document.querySelector(".drop-down")
const calender = document.querySelector(".fa-calendar-check-o");
const envelope = document.querySelector(".fa-envelope");
const user = document.querySelector(".fa-user-circle-o");
const toggleOpen = document.querySelector(".fa-bars");
const toggleClose = document.querySelector(".fa-times");
const sidebar = document.querySelector(".sidebar");


    //Manipulate sidebar 
toggleOpen.addEventListener("click", function() {
    envelope.innerHTML = '  Chat';
    user.innerHTML =   '  Account';
    calender.innerHTML = '  Appoitment';
    sidebar.classList.toggle("active")
    toggleOpen.style.display = "none";
    toggleClose.style.display = "block";
})

toggleClose.addEventListener("click", function() {
    envelope.innerHTML = ' '
    user.innerHTML =   '  ';
    calender.innerHTML = '  ';
    sidebar.classList.toggle("active")
    toggleOpen.style.display = "block";
    toggleClose.style.display = "none";
    
})

addEvent.addEventListener("click", function(){
    show.classList.remove("hidden")

})
</script>
</body>

</html>