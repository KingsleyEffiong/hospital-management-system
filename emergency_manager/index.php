<?php include '../backend/config/connection.php';?>
<?php include '../config/emergency_unit-session-validation.php';?>

<?php
$emergency_unit_id = $_POST['emergency_unit_id'];
?>

<?php    

$fetch_emergency_unit_profile = $callclass->_get_emergency_unit_details($conn, $s_emergency_unit_id);
$emergency_unit_profile_array = json_decode($fetch_emergency_unit_profile, true);
$fullname = $emergency_unit_profile_array[0]['fullname'];
$email = $emergency_unit_profile_array[0]['email'];
$phonenumber = $emergency_unit_profile_array[0]['phonenumber'];
// $role_id= $emergency_unit_profile_array[0]['role_id'];
$status_id = $emergency_unit_profile_array[0]['status_id'];
$date = $emergency_unit_profile_array[0]['date'];
$last_login = $emergency_unit_profile_array[0]['last_login'];
$passport = $emergency_unit_profile_array[0]["passport"]; 
$fetch_status = $callclass->_get_status_details($conn, $status_id);
$status_array = json_decode($fetch_status, true);
$status_name = $status_array[0]['status_name'];
?>

<?php 
$page = "emergency_unit_dash"; // Assign the value "emergency_unit_dash" to the $page variable
?>



<?php 
    


    $fetch_status = $callclass->_get_status_details($conn, $status_id);
    $status_array = json_decode($fetch_status, true);
    
    ?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Emergency Unit</title>
<?php include 'meta.php'?>
</head>
<body>


<script>
       if (window.history && window.history.pushState) {
            window.history.pushState('forward', null,);
            window.onpopstate = function () {
                window.history.pushState('forward', null);
            };
        }
    </script>

    
<!--------------------------------------------START OF NAVBAR------------------------------------------------------>
<div class="navbar">
        <div class="display__date">
        </div>
          <div class="profile">
            <div class="profile_account hide">
            <img id="image_profile_account" src="../Images/24b23c44ac34e5a0fb80978cd976604c.jpg" alt="">
            <span><?php echo $fullname ?></span>
           </div>

            <div class="image">
            <img src="<?php echo $website_url?>/Images/24b23c44ac34e5a0fb80978cd976604c.jpg" alt="userImage"/>
            <div class="active_on"></div>
            </div>
            <span><?php echo $fullname ?></span>
            <i class="bi bi-caret-down-fill" onclick="displayUserProfile()"></i>
                 </div>
                </div>
      <!--------------------------------------START OF SIDEBAR------------------------------------------------------>

    <div class="sidebar">
    <div class="sidebar__header"></div>
    <div class="sidebar-body">
      <ul>
        <li  id="emergency__form__link" class="links active" onclick="patientLForm()">
          <i class="fa-solid fa-person-pregnant"></i>
          <span>Emergecy Unit Form</span>
        </li>
        <li id="emergency__link" class="links" onclick="patientList()">
          <i class="fa-solid fa-person-pregnant"></i>
          <span>Emergency Patient List</span>
        </li>
        <li onclick="document.getElementById('logoutform').submit();" id="logout_link" class="links">
          <i class="fa-solid fa-right-from-bracket"></i>
          <span>Logout</span>
          <form method="post" action="../config/code.php" id="logoutform">
            <input type="hidden" name="action" value="logout"/>
          </form>
        </li>
      </ul>
    </div>
  </div>
  <!----------------------------------------------------------------------------------->

  
<div class="container">
<div class="emergency_form_container">
<form method ="post" action="" id="emergencyInputData">
<h3>EMERGENCY FORM</h3>
  <h3>Patient Info</h3>
  <div class="each_sections">
<div class="form-control">
  <label for="fullName">Full name</label>
  <input type="text" name ="fullName" id="fullName" class="emergencyInput">
  </div>
  <div class="form-control">
  <label for="dob">Date of Birth</label>
  <input type="date" name="dob" id="dob" class="emergencyInput"> 
  </div>

  <div class="form-control">
  <label for="address">Address</label>
  <input type="text" name ="address" id="address" class="emergencyInput">
  </div>
  <div class="form-control" onchange='saveOppositeGender()'>
                <label for="gender">Gender</label>
                <div class="radio-group">
              <label>
                  Male
                  <input type="radio" name="gender" value="male" id="maleCheckbox">
                  <span class="custom-radio"></span>
              </label>
              <label>
                  Female
                  <input type="radio" name="gender" value="female" id="femaleCheckbox">
                  <span class="custom-radio"></span>
              </label>
            </div>
              </div>
            </div>

  <h3>Emergency Contact</h3>
  <div class="each_sections">
  <div class="form-control">
  <label for="efullName">Full Name</label>
  <input type="text" name ="efullName" id="efullName" class="emergencyInput">
 </div>


 <div class="form-control">
  <label for="contactNumber">Contact Number</label>
  <input type="text" name ="contactNumber" id="contactNumber" class="emergencyInput">
  </div>
  <div class="form-control">
  <label for="relationship">Relatonship</label>
  <input type="text" name ="relationship" class="emergencyInput" id="relationship" >
  </div>

  </div>
  <h3>Incident Details</h3>
  <div class="each_sections">
  <div class="form-control">
  <label for="doi">Date of the Incident</label>
  <input type="date" name="doi" id="doi" class="emergencyInput"> 
 </div>

 <div class="form-control">
  <label for="toi">Time of the Incident</label>
  <input type="time" name="toi" id="toi" class="emergencyInput"> 
  </div>
 <div class="form-control">
  <label for="coi">Cause of the Incident</label>
  <input type="text" name ="coi" id="coi" class="emergencyInput">
  </div>
  </div>
  <button class="btn_submit" type="button" id="submitEmergencyInput" onclick="EmergencyPatient()"> Submit</button>
</form>
</div>
</div>



<div class="modal hidden" id="book__patient">
  <div class="">
    <button onclick="docForm()">Transfer to doctor</button>
    <button onclick="nurseForm()">Transfer to nurse</button>
    <button onclick="surgicalsuiteForm()">Transfer to surgical suite</button>
    <button onclick="labForm()">Transfer to lab</button>
    <button onclick="radiologyForm()">Transfer to radiology</button>
    <button onclick="isPatientStable()">Is the patient stable</button>
  </div>
</div>

<div class="modal hidden" id="docForm">
  <h3>AVAILABLE DOCTORS</h3>
<button class="btn--close-modal" onclick="closeModal('docForm')">&times;</button>
  <form action="" id="bookDocForm">
  <div class="each_sections">
  <div class="form-control">
    <label>Patient Name</label>
    <input type="text" name="patient_name" id="name"/>
  </div>
  <div class="form-control">
    <label>Patient Id</label>
    <input type="text" name="patient_id" id="id"/>
  </div>
  </div>
  <div class="each_sections">
  <div class="form-control">
    <label>Selected date</label>
    <input type="date" name="selected_date" />
  </div>
  <div class="form-control">
    <label>Selected time</label>
    <input type="time" name="selected_time" />
  </div>
  </div>
  <div class="each_sections">
  <div class="form-control availableDoctor">
    <label for="">Role</label>
  <select  id="select_doc">
<option value="" id="opt">Gyancoligist</option>
<option value="">Surgeon</option>
<option value="">Dentist</option>
<option value="" id="opt">Gyancoligist</option>
<option value="">Surgeon</option>
<option value="">Dentist</option>
<option value="" id="opt">Gyancoligist</option>
<option value="">Surgeon</option>
<option value="">Dentist</option>
</select>
</div>

<div class="form-control availableDoctor">
<label>Available Doctor</label>
<select  id="select_doc">
<option value="" id="opt">Doc. Mathew </option>
<option value="">Doc. Prince</option>
<option value="">Doc. Peter</option>
<option value="">Doc. Patrick</option>
</select>
  </div>
  </div>
  <div class="each_sections">
  <div class="form-control">
    <label>Comment</label>
    <textarea ></textarea>
  </div>
  </div>
<button class="btn_submit">Submit</button>  
  </form>
</div>


<div class="modal hidden" id="nurseForm">
  <h3>AVAILABLE NURSES</h3>
<button class="btn--close-modal" onclick="closeModal('nurseForm')">&times;</button>
  <form action="" id="booknurseForm">
  <div class="each_sections">
  <div class="form-control">
    <label>Patient Name</label>
    <input type="text" name="patient_name" id="name"/>
  </div>
  <div class="form-control">
    <label>Patient Id</label>
    <input type="text" name="patient_id" id="id"/>
  </div>
  </div>
  <div class="each_sections">
  <div class="form-control">
    <label>Selected date</label>
    <input type="date" name="selected_date" />
  </div>
  <div class="form-control">
    <label>Selected time</label>
    <input type="time" name="selected_time" />
  </div>
  </div>
  <div class="each_sections">
<div class="form-control availablenurse">
<label>Available Nurses</label>
<select  id="select_doc">
<option value="" id="opt">Doc. Mathew </option>
<option value="">Doc. Prince</option>
<option value="">Doc. Peter</option>
<option value="">Doc. Patrick</option>
</select>
  </div>
  </div>
  <div class="each_sections">
  <div class="form-control">
    <label>Comment</label>
    <textarea ></textarea>
  </div>
  </div>
<button class="btn_submit">Submit</button>  
  </form>
</div>



<div class="modal hidden" id="surgicalsuiteForm">
  <h3>AVAILABLE SURGICAL SUITE ATTENDANT</h3>
<button class="btn--close-modal" onclick="closeModal('surgicalsuiteForm')">&times;</button>
  <form action="" id="booksurgicalsuiteForm">
  <div class="each_sections">
  <div class="form-control">
    <label>Patient Name</label>
    <input type="text" name="patient_name" id="name"/>
  </div>
  <div class="form-control">
    <label>Patient Id</label>
    <input type="text" name="patient_id" id="id"/>
  </div>
  </div>
  <div class="each_sections">
  <div class="form-control">
    <label>Selected date</label>
    <input type="date" name="selected_date" />
  </div>
  <div class="form-control">
    <label>Selected time</label>
    <input type="time" name="selected_time" />
  </div>
  </div>
  <div class="each_sections">
<div class="form-control availablenurse">
<label>Available attendant</label>
<select  id="select_doc">
<option value="" id="opt">Doc. Mathew </option>
<option value="">Doc. Prince</option>
<option value="">Doc. Peter</option>
<option value="">Doc. Patrick</option>
</select>
  </div>
  </div>
  <div class="each_sections">
  <div class="form-control">
    <label>Comment</label>
    <textarea ></textarea>
  </div>
  </div>
<button class="btn_submit">Submit</button>  
  </form>
</div>


<div class="modal hidden" id="labForm">
  <h3>AVAILABLE LAB SCIENTIST</h3>
<button class="btn--close-modal" onclick="closeModal('labForm')">&times;</button>
  <form action="" id="booklabForm">
  <div class="each_sections">
  <div class="form-control">
    <label>Patient Name</label>
    <input type="text" name="patient_name" id="name"/>
  </div>
  <div class="form-control">
    <label>Patient Id</label>
    <input type="text" name="patient_id" id="id"/>
  </div>
  </div>
  <div class="each_sections">
  <div class="form-control">
    <label>Selected date</label>
    <input type="date" name="selected_date" />
  </div>
  <div class="form-control">
    <label>Selected time</label>
    <input type="time" name="selected_time" />
  </div>
  </div>
  <div class="each_sections">
<div class="form-control availablenurse">
<label>Available lab scientist</label>
<select  id="select_doc">
<option value="" id="opt">Doc. Mathew </option>
<option value="">Doc. Prince</option>
<option value="">Doc. Peter</option>
<option value="">Doc. Patrick</option>
</select>
  </div>
  </div>
  <div class="each_sections">
  <div class="form-control">
    <label>Comment</label>
    <textarea ></textarea>
  </div>
  </div>
<button class="btn_submit">Submit</button>  
  </form>
</div>

<div class="modal hidden" id="radiologyForm">
  <h3>AVAILABLE RADIOLOGY SCIENTIST</h3>
<button class="btn--close-modal" onclick="closeModal('radiologyForm')">&times;</button>
  <form action="" id="labForm">
  <form action="" id="bookradiologyForm">
  <div class="each_sections">
  <div class="form-control">
    <label>Patient Name</label>
    <input type="text" name="patient_name" id="name"/>
  </div>
  <div class="form-control">
    <label>Patient Id</label>
    <input type="text" name="patient_id" id="id"/>
  </div>
  </div>
  <div class="each_sections">
  <div class="form-control">
    <label>Selected date</label>
    <input type="date" name="selected_date" />
  </div>
  <div class="form-control">
    <label>Selected time</label>
    <input type="time" name="selected_time" />
  </div>
  </div>
  <div class="each_sections">
<div class="form-control availablenurse">
<label>Available radiology scientist</label>
<select  id="select_doc">
<option value="" id="opt">Doc. Mathew </option>
<option value="">Doc. Prince</option>
<option value="">Doc. Peter</option>
<option value="">Doc. Patrick</option>
</select>
  </div>
  </div>
  <div class="each_sections">
  <div class="form-control">
    <label>Comment</label>
    <textarea ></textarea>
  </div>
  </div>
<button class="btn_submit">Submit</button>  
  </form>
</div>


<div class="modal hidden" id="healthrecordForm">
  <h3>TRANSFER PATIENT TO HEALTH RECORD SECTION</h3>
<button class="btn--close-modal" onclick="closeModal('healthrecordForm')">&times;</button>
  <form action="" id="bookhealthrecordForm">
  <div class="each_sections">
  <div class="form-control">
    <label>Patient Name</label>
    <input type="text" name="patient_name" id="name"/>
  </div>
  <div class="form-control">
    <label>Patient Id</label>
    <input type="text" name="patient_id" id="id"/>
  </div>
  <div class="form-control">
    <label>Gender</label>
    <input type="text" name="" id=""/>
  </div>
  </div>
  <div class="each_sections">
  <div class="form-control">
    <label>Comment</label>
    <textarea ></textarea>
  </div>
  </div>
<button class="btn_submit">Submit</button>  
  </form>
</div>

  <div class="list_div section hide" id="emergency_list_section">
    <div class="table_container">
            <div class="search_bar_container">
                <h3>Emergency Patient List</h3>
                <input type="text" name="" id="searchInput" placeholder="Search">
            </div>
             
           
            <?php
              // Assuming you have a valid connection to the database in $conn
              $sql = "SELECT * FROM emergency_patient_tab";
              $result = mysqli_query($conn, $sql);

              if (mysqli_num_rows($result) > 0) {
                  echo '<table id="TableData">
                          <thead>
                              <tr>
                                  <td>S/N</td>
                                  <td>Patient Name</td>
                                  <td>Gender</td>
                                  <td>Patient ID</td>
                                  <td>Cause of Incident</td>
                                  <td>Date of Incident</td>
                                  <td>Time of Incident</td>
                                  <td>Status</td>
                              </tr>
                          </thead>
                          <tbody>';
                          
                  $sn = 1; // Serial number counter
                  while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>
                              <td>' . $sn++ . '</td>
                              <td>' . htmlspecialchars($row['Epatient_name']) . '</td>
                              <td>' . htmlspecialchars($row['gender']) . '</td>
                              <td>' . htmlspecialchars($row['emergency_patient_id']) . '</td>
                              <td>' . htmlspecialchars($row['cause_of_incident']) . '</td>
                              <td>' . htmlspecialchars($row['date_of_incident']) . '</td>
                              <td>' . htmlspecialchars($row['time_of_incident']) . '</td>
                              <td>' . htmlspecialchars($row['status_id']) . '</td>
                              <td><i class="bi bi-three-dots" onclick="showBookModal(event)"></td>
                            </tr>';
                  }
                  
                  echo '</tbody></table>';
              } else {
                  echo '<p>No data found.</p>';
              }
              ?>

<script>
     const links = document.querySelectorAll('.sidebar-body ul li');
    function toggleSidebarLinks(clickedLink){
        links.forEach(link => link.classList.remove('active'));
        clickedLink.classList.add('active');
     }
    links.forEach(link => {
        link.addEventListener('click', function() {
            toggleSidebarLinks(this);
        });
    });
</script>
  </div>
  </div>
  </div>
  <div class="black--background hidden"></div>
</body>
</html>