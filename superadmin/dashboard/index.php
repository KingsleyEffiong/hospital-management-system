<?php include '../../backend/config/connection.php';?>
<?php include 'dashboardconfig/session-validation.php';?>
<!-- ?php include '../../backend/config/user-validation.php';?> -->



<?php
 $staff_id= $_POST['staff_id'];
?>

<?php    
    $fetch_staff_profile=$callclass->_get_user_details($conn, $s_staff_id);
    $staff_profile_array = json_decode($fetch_staff_profile, true);
    $fullname= $staff_profile_array[0]['fullname'];
    $email= $staff_profile_array[0]['email'];
    $phonenumber= $staff_profile_array[0]['phonenumber'];
   // $role_id= $staff_profile_array[0]['role_id'];
    $status_id= $staff_profile_array[0]['status_id'];
    $date= $staff_profile_array[0]['date'];
    $last_login= $staff_profile_array[0]['last_login'];
   $passport = $staff_profile_array[0]["passport"];
    
        
    $fetch_status=$callclass->_get_status_details($conn, $status_id);
    $status_array = json_decode($fetch_status, true);
    $status_name= $status_array[0]['status_name'];
   
?>
 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <?php include 'meta.php'?>
    <title>Hospital management System</title>



      <!-- <script>
        // Function to be executed when the user leaves the page
        window.onbeforeunload = function() {
            // Perform an AJAX request to notify the server
            // that the user is leaving the page
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'logout_script.php', false);
            xhr.send();
        };
    </script> -->
    <script>
       if (window.history && window.history.pushState) {
            window.history.pushState('forward', null,);
            window.onpopstate = function () {
                window.history.pushState('forward', null);
            };
        }
    </script>
</head>
<body onload="updateTime(),setInterval(updateTime, 1000);">
  <div class="navbar">
        <div class="display__date" id="timer">
          00:00:00 00-00-00
        </div>
          <div class="profile">
            <div class="profile_account hide">
            <img id="image_profile_account" src="<?php echo $website_url.'/profile_pix/staff_passport/default_passport.jpg' ?>" alt="Default Passport">

            <span>Super admin</span>
            <button class="btn_submit">Upload Image</button>
           </div>

            <div class="image">
            <img id="image_profile_account1" src="<?php echo $website_url.'/profile_pix/staff_passport/default_passport.jpg' ?>" alt="Default Passport">
            <div class="active_on"></div>
            </div>
            <span><?php echo $fullname?></span>
            <i class="bi bi-caret-down-fill" onclick="displayUserProfile()"></i>
                 </div>
  </div>

  <div class="sidebar">
    <div class="sidebar-body">
      <ul>
        <li class="links active">
          <span>Overview</span>
        </li>
        <li class="links">
          <span>Patients</span>
        </li>
        <li class="links">
          <span>Staff management</span>
        </li>
        <li class="links">
          <span>Account</span>
        </li>
        <li class="links">
          <span>Pharmacy</span>
        </li>
        <li class="links">
          <span>Equipment Inventory</span>
        </li>
        <li class="links">
          <span>Settings</span>
        </li>

        <li onclick="document.getElementById('logoutform').submit();" id="logout_link" class="links">
          <span>Logout</span>
          <form method="post" action="dashboardconfig/code.php" id="logoutform">
            <input type="hidden" name="action" value="logout"/>
          </form>
        </li>
      </ul>
    </div>
  </div>

  <section class="overview">
  <div class="inner-div">
    <div class="cards">
      <span>Information and Health Records</span><br>
      <p>Total Patients: <span id="total_patients"></span></p>
      <canvas id="patientsChart"></canvas>
    </div>
    <div class="cards">
      <span>Total Staffs</span>
      <p>Total Staffs: <span id="total_staff"></span></p>
      <canvas id="staffsChart"></canvas>
    </div>
    <div class="cards">
      <span>Monthly Income</span>
      <canvas id="incomeChart"></canvas>

    </div>
    <div class="cards">
      <span>Pharmacy Sales</span>
      <canvas id="pharmacyChart"></canvas>
    </div>
    <div class="cards">
      <span>Surgery</span>
      <canvas id="surgery_rate"></canvas>
    </div>
    <div class="cards">
      <span>Radiology Appointments</span>
      <canvas id="radiology_appointments"></canvas>
    </div>
    <div class="cards">
      <span>Labouratory Appointments</span>
      <canvas id="labouratory_appointments"></canvas>
    </div>
    <div class="cards">
      <span>Matanity</span>
      <canvas id="matanityChart"></canvas>
    </div>
    
  </div>
</section>


<?php include 'scripts_meta.php'?>


</body>
</html>
