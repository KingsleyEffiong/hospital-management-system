<?php include '../backend/config/connection.php';?>
<?php include '../config/surgical_suit-session-validation.php';?>


<?php
$surgical_unit_id = $_POST['surgical_suite_id'];
?>

<?php    

$fetch_surgical_suite_profile = $callclass->_get_surgical_suite_details($conn, $s_surgical_unit_id);
$surgical_suite_profile_array = json_decode($fetch_surgical_suite_profile, true);
$fullname = $surgical_suite_profile_array[0]['fullname'];
$email = $surgical_suite_profile_array[0]['email'];
$phonenumber = $surgical_suite_profile_array[0]['phonenumber'];
// $role_id= $surgical_suite_profile_array[0]['role_id'];
$status_id = $surgical_suite_profile_array[0]['status_id'];
$date = $surgical_suite_profile_array[0]['date'];
$last_login = $surgical_suite_profile_array[0]['last_login'];
$passport = $surgical_suite_profile_array[0]["passport"]; 
$fetch_status = $callclass->_get_status_details($conn, $status_id);
$status_array = json_decode($fetch_status, true);
$status_name = $status_array[0]['status_name'];
?>

<?php 
$page = "surgical_suite_dash"; // Assign the value "surgical_suite_dash" to the $page variable
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
  <title>Surgical Suite Management</title>
  <?php include 'meta.php' ?> 
</head>
<body>
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
            <img src="../Images/24b23c44ac34e5a0fb80978cd976604c.jpg" alt="userImage"/>
            <div class="active_on"></div>
            </div>
            <span><?php echo $fullname ?></span>
            <i class="bi bi-caret-down-fill" onclick="displayUserProfile()"></i>
                 </div>
                </div>


    <div class="sidebar">
    <div class="sidebar__header"></div>
    <div class="sidebar-body">
      <ul>
        <li  id="emergency__form__link" class="links active" onclick="incomingAppoitment()">
        <i class="bi bi-clock"></i>
          <span>Incoming Appoitment for surgery</span>
        </li>
        <li  id="emergency__form__link" class="links" onclick="acceptedAppoitment()">
        <i class="bi bi-clock"></i>
          <span>Accepted appoitment for surgery</span>
        </li>
        <li id="emergency__link" class="links" onclick="pendingSurgeryList()">
        <i class="bi bi-book"></i>
          <span>Pending Surgery List</span>
        </li>
        <!-- <li id="emergency__link" class="links" onclick="patientProfile()">
        <i class="bi bi-person"></i>
          <span>Patient Profile</span>
        </li> -->
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


  <div class="list_div" id="incomingAppouitment">
    <div class="table_container">
            <div class="search_bar_container">
                <h3>Incoming Surgery List</h3>
                <input type="text" name="" id="" placeholder="Search">
            </div>
            <?php
                $sql = "SELECT surgical_suite_appointment_tab.*, patient_tab.patient_passport 
                        FROM surgical_suite_appointment_tab
                        LEFT JOIN patient_tab ON surgical_suite_appointment_tab.patient_id = patient_tab.patient_id
                        WHERE  surgical_suite_appointment_tab.status_id = '1'";

                      $result = $conn->query($sql);
                      ?>
                      <table id="TableData">
                          <thead>
                              <tr>
                                  <td>S/N</td>
                                  <td>Patient Profile</td>
                                  <td>Patient Name</td>
                                  <td>Patient Id</td>
                                  <td>Date</td>
                                  <td>Time</td>
                                  <td>Request type</td>
                                  <td>Actions</td>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                              if ($result->num_rows > 0) {
                                  $sn = 1;
                                  while ($row = $result->fetch_assoc()) {
                                      echo "<tr>";
                                      echo "<td>" . $sn++ . "</td>";
                                      echo "<td><img src='" . htmlspecialchars($website_url . "/uploaded_files/profile_pix/patient/" . $row["patient_passport"]) . "' alt='Profile Picture' width='50' height='50'/></td>";
                                      echo "<td>" . htmlspecialchars($row['patient_name']) . "</td>";
                                      echo "<td>" . htmlspecialchars($row['patient_id']) . "</td>";
                                      echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                                      echo "<td>" . htmlspecialchars($row['time']) . "</td>";
                                      echo "<td>" . htmlspecialchars($row['surgical_procedure']) . "</td>";
                                      echo '<td>
                                              <button class="bg-white" onclick="accept_patient(\'' . $row["surgical_suite_appointment_id"] . '\', \'' . $s_surgical_unit_id . '\')">Accept</button>
                                              <button class="bg-white">Reject</button>
                                            </td>';
                              
                              
                              
                                      echo "</tr>";
                                  }
                              } else {
                                  echo "<tr><td colspan='8'>No data found</td></tr>";
                              }
                              ?>
                          </tbody>
                      </table>



                     

  </div>
  </div>

  <div class="modal hidden" id="patient">
  <div class="">
    <button onclick="PatientProfiles()" class="bg-blue">Display Patient Profile</button>
  </div>
</div>

  <div class="list_div hide" id="acceptedAppoitment">
    <div class="table_container">
            <div class="search_bar_container">
                <h3>Surgery List</h3>
                <input type="text" name="" id="" placeholder="Search">
            </div>
              <?php $sql = "SELECT * FROM surgical_suite_appointment_tab WHERE status_id ='2'";
              $result = $conn->query($sql);
              ?>

              <table id="TableData">
                  <thead>
                      <tr>
                          <td>S/N</td>
                          <td>Patient Name</td>
                          <td>Patient Id</td>
                          <td>Date</td>
                          <td>Time</td>
                          <td>Request Type</td>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                      if ($result->num_rows > 0) {
                          $sn = 1; // Serial number counter
                          while ($row = $result->fetch_assoc()) {
                              echo "<tr>";
                              echo "<td>" . $sn++ . "</td>";
                              echo "<td>" . $row['patient_name'] . "</td>";
                              echo "<td>" . $row['patient_id'] . "</td>";
                              echo "<td>" . $row['date'] . "</td>";
                              echo "<td>" . $row['time'] . "</td>";
                              echo "<td>" . $row['surgical_procedure'] . "</td>";
                              echo "<td><i class='bi bi-three-dots-vertical' onclick='showPatientProfile(event)'></i></td>";
                              echo "</tr>";
                          }
                      } else {
                          echo "<tr><td colspan='7'>No appointments found</td></tr>";
                      }
                      ?>
                  </tbody>
              </table>

  </div>
  </div>

  <div class="list_div hide" id="pendingSurgeryList">
    <div class="table_container">
            <div class="search_bar_container">
                <h3>Pending Surgery List</h3>
                <input type="text" name="" id="" placeholder="Search">
            </div>
            <?php
                // Your SQL query to fetch appointments with status_id = 1
                $sql = "SELECT * FROM surgical_suite_appointment_tab WHERE status_id = '3'";
                $result = mysqli_query($conn, $sql); // Assuming $conn is your database connection

                ?>

                <table id="TableData">
                    <thead>
                        <tr>
                            <td>S/N</td>
                            <td>Patient Name</td>
                            <td>Patient Id</td>
                            <td>Date</td>
                            <td>Time</td>
                            <td>Request type</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Initialize serial number
                        $sn = 1;

                        // Fetch and display each row from the result set
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>' . $sn++ . '</td>';
                                echo '<td>' . $row["patient_name"] . '</td>';
                                echo '<td>' . $row["patient_id"] . '</td>';
                                echo '<td>' . date('d/m/Y', strtotime($row["date"])) . '</td>';
                                echo '<td>' . date('H:i', strtotime($row["time"])) . '</td>';
                                echo '<td>' . $row["surgical_procedure"] . '</td>';
                                echo '<td><i class="bi bi-three-dots-vertical"></i></td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="7">No appointments found</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>

  </div>
  </div>


<div class="patientProfile hide">
 <div class="profileInfo listing">
  <h3>PERSONAL INFORMATION</h3>
  <img src="Images/80e729b199b61a6c183b85263d35a6ef.jpg" alt="" 
  style="border-radius: 100%;
  height: 200px;
  width: 200px;" id="p_profile_image">
 </div>
 <div class="bioData listing">
  <h3  style="background:white; color:rgb(42, 87, 215); padding:1rem; width:fit-content; border-radius: 999px; box-shadow: rgb(42, 87, 215) 0 10px 20px -10px;">BIO DATA</h3>
  <div class="column">
  <span id="pname">KINGSLEY PATRICK</span>
  <span id="pId">PAT0003</span>
  <span id="pgender">MALE</span>
  <span id="pdob">23 SEPTEMBER 1998</span>
  <span id="phome_address">40 MAIN LONDON ROAD</span>
  <span id="p_phone_number">+23488993034</span>
  </div>

  <h3  style="background:white; color:rgb(42, 87, 215); padding:1rem; width:fit-content; border-radius: 999px; box-shadow: rgb(42, 87, 215) 0 10px 20px -10px;">NEXT OF KINS DETAIL</h3>
  <div class="column">
  <span id="pnx_name">MERCY PATRICK</span>
  <span id="pnx_gender">FEMALE</span>
  <span id="pnx_address">40 MAIN LONDON ROAD</span>
  <span id="pnx_phone_number">+2348893334</span>
  <span id="pnx_relationship">Brother</span>
  </div>
  <h3 style="background:white; color:rgb(42, 87, 215); padding:1rem; width:fit-content; border-radius: 999px; box-shadow: rgb(42, 87, 215) 0 10px 20px -10px;">SOCIAL HISTORY</h3>
  <div>
  <span ID="p_sh">NAN</span>
  </div>
  <h3 style="background:white; color:rgb(42, 87, 215); padding:1rem; width:fit-content; border-radius: 999px; box-shadow: rgb(42, 87, 215) 0 10px 20px -10px;">MEDICAL HISTORY</h3>
  <div>
  <span id="p_mh">NAN</span>
  </div>
  <h3 style="background:white; color:rgb(42, 87, 215); padding:1rem; width:fit-content; border-radius: 999px; box-shadow: rgb(42, 87, 215) 0 10px 20px -10px;">SEXUAL HISTORY</h3>
  <div>
  <span id="p_sxh">NAN</span>
  </div>
  <h3 style="background:white; color:rgb(42, 87, 215); padding:1rem; width:fit-content; border-radius: 999px; box-shadow: rgb(42, 87, 215) 0 10px 20px -10px;">PAST DISEASE</h3>
  <div>
  <span id="p_pd">NAN</span>
  </div>
  <h3 style="background:white; color:rgb(42, 87, 215); padding:1rem; width:fit-content; border-radius: 999px; box-shadow: rgb(42, 87, 215) 0 10px 20px -10px;">FAMILY DISEASE</h3>
  <div>
  <span id="p_fd">NAN</span>
  </div>
  <h3 style="background:white; color:rgb(42, 87, 215); padding:1rem; width:fit-content; border-radius: 999px; box-shadow: rgb(42, 87, 215) 0 10px 20px -10px;">PAST SURGERY</h3>
  <div>
  <span id="p_ps">NAN</span>
  </div>
 </div>


 <div class="labouratoryData listing">
 <h3>LABOURATORY TESTS</h3>
  <table id="lab_test_tab">
    <thead>
      <tr>
      <td>Date</td>
      <td>Time</td>
      <td>Kind of Test</td>
      <td>Test Specific</td>
      <td>Test Result</td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>xxxxxxxxxx</td>
        <td>xxxxxxxxxx</td>
        <td>xxxxxxxxxx</td>
        <td>xxxxxxxxxx</td>
        <td>download</td>
      </tr>
    </tbody>
  </table>
 </div>

 
 <div class="radiologyData listing">
 <h3>RADIOLOGY TESTS</h3>

    <table id="lab_rad_tab">
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Kind of Test</th>
                <th>Test Specific</th>
                <th>Test Result</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>xxxxxxxxxx</td>
                <td>xxxxxxxxxx</td>
                <td>xxxxxxxxxx</td>
                <td>xxxxxxxxxx</td>
                <td>download</td>
            </tr>
        </tbody>
    </table>
 </div>

 <div class="vitalData listing" style="overflow: auto">
 <h3>VITAL DATA</h3>
 <table id="vital_tab">
    <thead>
        <tr>
            <th>Date</th>
            <th>Temp (°C)</th>
            <th>BP (mmHg)</th>
            <th>Pulse (bpm)</th>
            <th>Resp. (cm)</th>
            <th>SpO2 (%)</th>
            <th>Weight (kg)</th>
            <th>Intake (mL/s)</th>
            <th>Output</th>
            <th>BMI</th>
        </tr>
    </thead>
    <tbody>
        <!-- Data will be populated here -->
    </tbody>
</table>

 </div>

  <!-- <div class="select-ward listing">
    <h3>Select Ward</h3>
    <div class="each_sections">
      <div class="form-control">
      <label>Ward 1</label>
    <select name="" id="">
      <option value=""></option>
      <option value=""></option>
      <option value=""></option>
      <option value=""></option>
      <option value=""></option>
      <option value=""></option>
    </select>
      </div>

      <div class="form-control">
    <label>Ward 2</label>
    <select name="" id="">
      <option value=""></option>
      <option value=""></option>
      <option value=""></option>
      <option value=""></option>
      <option value=""></option>
      <option value=""></option>
    </select>
    </div>
  </div>
  <button class="bg-white">Book ward</button>
  <button class="bg-white" onclick="uploadSection()">Upload consent form</button>
 
  </div> -->
  <button class="bg-white" onclick="bookinSection()">Book patient</button>
</div>


        <div class="booking_section hide">
            <div class="booking_container">
              <h3>Book patient for surgery</h3>
                <form action="">
                    <div class="each_sections">
                    <div class="form-control">
                    <label for="procedure">Type of Surgery & Amount</label>
                    <input type="text" id="procedure" onkeyup="fetchProcedures(this.value)" autocomplete="off">
                    <select id="procedureDropdown" size="5" style="display:none;" onchange="selectProcedure(this.value)">
                    </select>

                    

                    
                    <div class="form-control">
                        <label for="">Total Amount</label>
                        <input type="text">
                    </div>
                    </div>
                    <div class="each_sections">
                    <div class="form-control">
                        <label for="">Special Equipment</label>
                        <input type="text">
                    </div>
                    <div class="form-control">
                        <label for="">Date of Surgery</label>
                        <input type="date">
                    </div>
                    <div class="form-control">
                        <label for="">Time of Surgery</label>
                        <input type="time">
                    </div>
                    .</div>
                    <div class="each_sections">
                    <div class="form-control">
                        <label for="">Select Surgeon</label>
                        <select id="surgeonDropdown">
                            <option value="">Select Surgeon</option>
                        </select>
                    </div>
                    <div class="form-control">
                        <label for="">Select Anostologist</label>
                        <select id="anesthesiologistDropdown">
                            <option value="">Select Anesthesiologist</option>
                        </select>
                    </div>
                    </div>
                    <div class="each_sections">
                    <div class="form-control">
                        <label for="">Select Nurse</label>
                        <select id="nurseDropdown">
                            <option value="">Select Nurse</option>
                        </select>
                    </div>
                    <div class="form-control">
                        <label for="">Select Opeating Room</label>
                        <select id="theatreDropdown" onclick="fetch_theatre()">
                            <option value="">Select Theatre</option>
                        </select>
                    </div>
                    </div>
                    
                    <div class="select-ward listing">
                      <h3>Select Ward</h3>
                      <div class="each_sections">
                        <div class="form-control">
                        <label>Ward 1</label>
                      <select name="" id="">
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                      </select>
                        </div>

                        <div class="form-control">
                      <label>Ward 2</label>
                      <select name="" id="">
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                      </select>
                      </div>
                    </div>
                    <button class="bg-white">Book ward</button>
                    <button class="bg-white" onclick="uploadSection()">Upload consent form</button>
                    <button class="bg-blue">Book</button>
                    </div>

                   
                </form>
            </div>
          </div>


          <div class="upload-section hide">
          <div class="flex_upload_div">
            <div class="upload_container">
              <i class="fa fa-folder-open" id="upload_icon"></i>
              <span>Drag and drop file</span>
              <h3>-OR-</h3>
              <input type="file" value="Upload File" class="browse_file">
            </div>
          </div>
          </div>
        </div>
        <div class="overlay hidden"></div>
</body>
</html>