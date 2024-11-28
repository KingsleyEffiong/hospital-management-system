<?php include '../backend/config/connection.php';?>
<?php include '../backend/dashboardconfig/session-validation.php';?>
<!-- ?php include '../backend/config/user-validation.php';?> -->




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
 
<?php $page === "receptionist_dash"?>












<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo $thename?> | Health Records and Information Dashboard</title>
    <meta name="keywords" content="Admin - <?php echo $thename?>" />
    <meta name="description" content="Administrative Login <?php echo $thename?>"/>
    <?php include 'meta.php'?>
</head>

<body onload="ChooseSelectBox()">

    <script>
       if (window.history && window.history.pushState) {
            window.history.pushState('forward', null,);
            window.onpopstate = function () {
                window.history.pushState('forward', null);
            };
        }
    </script>
    
    
  <!--START OF SIDEBAR AND NAVBAR -->
  <div class="navbar">
        <div class="display__date">
        </div>
        <div class="section2">

          </div>
          <div class="profile">
            <div class="profile_account hide">
            <img id="image_profile_account" src="../Images/24b23c44ac34e5a0fb80978cd976604c.jpg" alt="">
            <h4>Doc. Henculus White</h4>
        </div>
            <div class="image">
            <img src="../Images/24b23c44ac34e5a0fb80978cd976604c.jpg" alt="">
            </div>
        </img>  
            <span>Doc. Henculus White</span>
            <i class="bi bi-caret-down-fill _profile_arrow_icon" onclick="click_icon_for_profile()"></i>
          </div>
        </div>
    </div>

        <div class="sidebar">
    <div class="sidebar__header"></div>
    <div class="sidebar-body">
      <ul>
        <li onclick="patient_admission_form_section()" class="links active">
        <i class="bi bi-file-person-fill"></i>
          <span>Patient admission form </span>
        </li>
        <li onclick="walkin_patient_form()" class="links">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-walking" viewBox="0 0 16 16">
        <path d="M9.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0M6.44 3.752A.75.75 0 0 1 7 3.5h1.445c.742 0 1.32.643 1.243 1.38l-.43 4.083a1.8 1.8 0 0 1-.088.395l-.318.906.213.242a.8.8 0 0 1 .114.175l2 4.25a.75.75 0 1 1-1.357.638l-1.956-4.154-1.68-1.921A.75.75 0 0 1 6 8.96l.138-2.613-.435.489-.464 2.786a.75.75 0 1 1-1.48-.246l.5-3a.75.75 0 0 1 .18-.375l2-2.25Z"/>
        <path d="M6.25 11.745v-1.418l1.204 1.375.261.524a.8.8 0 0 1-.12.231l-2.5 3.25a.75.75 0 1 1-1.19-.914zm4.22-4.215-.494-.494.205-1.843.006-.067 1.124 1.124h1.44a.75.75 0 0 1 0 1.5H11a.75.75 0 0 1-.531-.22Z"/>
        </svg>
          <span>Walkin patient admission Form</span>
        </li>
        <!-- <li class="links">
          <span>Check up</span>
          onclick="checkup_form()" 
        </li> -->
        <li onclick="patient_list()" class="links">
        <i class="bi bi-file-person-fill"></i>
          <span>Patient list</span>
        </li>
        <li onclick="_walkin_patient_list()" class="links">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-walking" viewBox="0 0 16 16">
        <path d="M9.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0M6.44 3.752A.75.75 0 0 1 7 3.5h1.445c.742 0 1.32.643 1.243 1.38l-.43 4.083a1.8 1.8 0 0 1-.088.395l-.318.906.213.242a.8.8 0 0 1 .114.175l2 4.25a.75.75 0 1 1-1.357.638l-1.956-4.154-1.68-1.921A.75.75 0 0 1 6 8.96l.138-2.613-.435.489-.464 2.786a.75.75 0 1 1-1.48-.246l.5-3a.75.75 0 0 1 .18-.375l2-2.25Z"/>
        <path d="M6.25 11.745v-1.418l1.204 1.375.261.524a.8.8 0 0 1-.12.231l-2.5 3.25a.75.75 0 1 1-1.19-.914zm4.22-4.215-.494-.494.205-1.843.006-.067 1.124 1.124h1.44a.75.75 0 0 1 0 1.5H11a.75.75 0 0 1-.531-.22Z"/>
        </svg>
          <span>Walkin patient list</span>
        </li>
        <li onclick="_emergency_patient_list()" class="links">
        <i class="bi bi-file-person-fill"></i>
          <span>Emergecy patient list</span>
        </li>
        <li onclick="document.getElementById('logoutform').submit();" id="logout_link" class="links">
        <i class="bi bi-box-arrow-in-right"></i>
          <span>Logout</span>
          <form method="post" action="../config/code.php" id="logoutform">
            <input type="hidden" name="action" value="logout"/>
          </form>
        </li>
      </ul>
    </div>
  </div>

    <div class="new_intake_admission_form">
    <div class="form-container">
        <h3>Patient admission form</h3>
        <form action="config/code.php?update_profile_pix" id="add_patient_pic" enctype="multipart/form-data" method="post">
            <div class="upload_image" action ="config/code?=update_profile_pix" title="update profile picture">
                <video id="videoElement" width="400" height="300" autoplay></video>
                <i class="bi bi-plus" id="capture_image" onclick="openCamera()"></i>
                <canvas id="canvasElement" style="display: none;"></canvas>

                <?php if ($passport==''){?>
                    <img src="<?php echo $website_url; ?>/uploaded_files/profile_pix/patient/19374.jpg" id="capturedImage" style="display: none;" alt="profile picture"/>
                    <!-- <input type="file" id="passport" style="display:none"  accept=".jpg,.png" onchange="Test.UpdatePreview(this);"/>  -->
                <?php } else {?>

                <img src="<?php echo $website_url; ?>/uploaded_files/profile_pix/<?php echo $passport; ?>" id="my_passport" alt="profile picture"/>
                <!-- <input type="file" id="passport" style="display:none" accept=".jpg,.png" onchange="Test.UpdatePreview(this);"/>  -->
                <?php } ?>
               
            </div>
       
            <div class="flex_capture_div">
                <div class="btn_re_capture bg-blue hide"  onclick="retakePicture()">Recapture</div>
                <div class="btn_capture bg-blue hide" onclick="takePicture()">Capture</div>
                <!-- <button class="btn_re_capture" style="display:none" type="button" id="uploadButton" title="Submit"  onclick="_upload_profile_pix();"> Submit PASSPORT <i class="bi-check"></i></button> -->
            </div>
        </form>

        <form action="" id="registeration_form" enctype="multipart/form-data" method="post">
            <h3>Personal details</h3>
            <div class="sections">
            <div class="form-control">
            <label for="full_name">Full name</label>
            <input type="text"  id="fullname" autocapitalize="off" autocomplete="off">
        </div>
            <div class="form-control">
            <label for="date_of_birth">Date of birth</label>
            <input type="date" id="dob">
        </div>
        <div class="form-control">
            <label for="home_address">Home address</label>
            <input type="text" id="address" autocomplete="off">
        </div>
            <div class="form-control">
            <label for="phone_number">Phone number</label>
            <input type="text" id="phonenumber">
        </div>
        <div class="form-control">
        <label for="gender">Gender</label>
                <div class="radio-group">
              <label>
                  Male
                  <input type="radio" name="gender" value="male" id="gender1">
                  <span class="custom-radio"></span>
              </label>
              <label>
                  Female
                  <input type="radio" name="gender" value="female" id="gender2">
                  <span class="custom-radio"></span>
              </label>
</div>
</div>
        <div class="form-control">
        <label for="hmo" id ="hospital_plan">Hospital plans</label>
        <select name="" id="select_box">
            <option id="option" value="">Loading...</option>
        </select>
    </div>
        <!--Check if any existing family plan--->
        <div class="form-control hide" id="existing_plan_or_not">
        <label for="gender">Any existing family plan?</label>
                <div class="radio-group">
              <label>
                  Yes
                  <input type="radio" name="boolean" id="_family_plan" onchange="familyPlanSection()" style="display: none;">
                  <span class="custom-radio"></span>
              </label>
              <label>
                  No
                  <input type="radio" id="_create_card"  name= "boolean" onchange="create_family_card()" style="display: none;" >
                  <span class="custom-radio"></span>
              </label>
            <input type="hidden" id="accept" value="">
        <div class="generating-div" id="generation_alert" style="display:block"></div>
        </div>
    </div>
</div>
            <!--Family plan authentication--->
    <div class="family_plan_section hide">
            <label for="">Insert your family id</label>
            <input type="text" onkeyup="check_family_card_validity()" name="" id="family_card_id">
            <div class="valid" id="result"></div>
            <button class="btn" id ="users_checker" onclick="check_family_card_users();" type="button">Check for users</button>
            </div>
        </div>
    <h3>Next of kins</h3>
    <div class="sections">
        <div class="form-control">
        <label for="full_name" class="form_icon">Full name</label>
        <input type="text"  id="kname" autocapitalize="off" autocomplete="off">
    </div>
        <div class="form-control">
        <label for="relationship">RelationShip</label>
        <input type="text"  id="krelationship">
    </div>
        <div class="form-control">
        <label for="home_address">Home address</label>
        <input type="text"  id="kaddress"  autocomplete="off">
    </div>
        <div class="form-control">
        <label for="phone_number">Phone number</label>
        <input type="text"  id="kphonenumber">
    </div>
   <div class="form-control">
   <label for="gender">Gender</label>
                <div class="radio-group">
              <label>
                  Male
                  <input type="radio" name="kgender" value="male" id="kgender1">
                  <span class="custom-radio"></span>
              </label>
              <label>
                  Female
                  <input type="radio" name="kgender" value="female" id="kgender2">
                  <span class="custom-radio"></span>
              </label>
            </div>
</div>
    </div>

<h3>Social history</h3>
<div class="sections">
    <div class="form-control">
    <label for="Occupation">Occupation</label>
    <input type="text" id="occupation"  autocapitalize="off">
</div>

    <div class="form-control">
    <label for="Occupation">Past obsterics</label>
    <input type="text" id="past_obsterics" autocapitalize="off" autocomplete="off">
</div>

    <div class="form-control">
    <label for="Occupation">Medical history</label>
    <input type="text" id="medical_history" autocapitalize="off" autocomplete="off" >
</div>
    <div class="form-control">
    <label for="Occupation">Sexual history</label>
    <input type="text" id="sexual_history" autocapitalize="off" autocomplete="off">
</div>

    <div class="form-control">
    <label for="Occupation">Past disease</label>
    <input type="text" id="past_disease" autocapitalize="off" autocomplete="off">
</div>

    <div class="form-control">
    <label for="Occupation">Family disease</label>
    <input type="text" id="family_disease" autocapitalize="off" autocomplete="off">
  
</div>
    <div class="form-control">
    <label for="Occupation">Past surgery</label>
    <input type="text" id="past_surgery" autocapitalize="off" autocomplete="off">
</div>
    <div class="form-control">
    <label for="Occupation">Health history</label>
    <input type="text" id="health_history" autocapitalize="off" autocomplete="off">
</div>
</div>
<button type="button" id ="proceed-btn" onclick="_add_patient();" class="bg-blue">Book</button>
        </form>
        </div>
        </div>
             <!--END OF ADMISSION FORM1-->

        <!--START OF WALKIN ADMISSION FORM2-->
            <div class="modal walkin_admission_form hidden" id="walkin--patient">
            <button class="btn--close-modal" onclick="closeModal('walkin--patient')">&times;</button>
            <div class="form-container">
        <h3>WalkIn admission form</h3>
        <div class="walkin_in_section_upload_image">
             <video id="walkin_in_section_videoElement" width="400" height="300" autoplay></video>
            <i class="bi bi-plus" id="walkin_in_section_capture_image" onclick="openCamera2()"></i>
            <canvas id="walkin_in_section_canvasElement" style="display: none;"></canvas>

            <?php if ($passport==''){?>
                    <img src="<?php echo $website_url; ?>/uploaded_files/profile_pix/walkin_patient/19374.jpg" id="walkin_in_section_capturedImage" style="display: none;" alt="profile picture"/>
                    <!-- <input type="file" id="passport" style="display:none"  accept=".jpg,.png" onchange="Test.UpdatePreview(this);"/>  -->
                <?php } else {?>

                <img src="<?php echo $website_url; ?>/uploaded_files/profile_pix/walkin_patient<?php echo $passport; ?>" id="walkin_in_section_capturedImage" alt="profile picture"/>
                <!-- <input type="file" id="passport" style="display:none" accept=".jpg,.png" onchange="Test.UpdatePreview(this);"/>  -->
                <?php } ?>

        </div>
        <div class="flex_capture_div">
        <div class="walkin_in_section_btn_re_capture bg-blue hide"  onclick="retakePicture2()">Recapture</div>
        <div class="walkin_in_section_btn_capture bg-blue hide" onclick="takePicture2()">Capture</div>
        </div>
        <form action="walkin_registration_form">
            <h3>Personal details</h3>
            <div class="sections">
            <div class="form-control">
            <label for="full_name">Full name</label>
            <input type="text"  id="wpatient_name" autocapitalize="off" autocomplete="off">
        </div>
            <div class="form-control">
            <label for="date_of_birth">Date of birth</label>
            <input type="date" id="wdob">
        </div>
        <div class="form-control">
            <label for="home_address">Home address</label>
            <input type="text" id="waddress" autocomplete="off">
        </div>
        <div class="form-control">
            <label for="phone_number">Phone number</label>
            <input type="text" id="wphonenumber">
        </div> 
        <div class="form-control">
        <label for="gender">Gender</label>
                <div class="radio-group">
              <label>
                  Male
                  <input type="radio" name="gender" value="male" id="wgender1">
                  <span class="custom-radio"></span>
              </label>
              <label>
                  Female
                  <input type="radio" name="gender" value="female" id="wgender2">
                  <span class="custom-radio"></span>
              </label>
</div>
</div>
</div>
    <button type="button" id="wproceed-btn" onclick="_add_patient2();" class="bg-blue">Submit</button>
    </form>
    </div>
    </div>
    </div>
    </div>
<!--END OF WALKIN ADMISSION FORM2-->









  <!---START OF ALL PATIENT LISTS SECTION -->
  <!--START OF ADMITTED PATIENTS FOR LIST1-->
  <div class="all_patient_list hide">
    <div class="patient_list_div">
            <div class="search_bar_container">
                <h3>Patient admission list</h3>
                <input type="text" name="" id="psearch" placeholder="Search">
            </div>
            <?php 
    $sql = "SELECT * FROM patient_tab";
    $result = $conn->query($sql);
?>

            <table id="table1">
                <thead>
                    <tr>
                        <td>S/N</td>
                        <td>Patient Name</td>
                        <td>Patient ID</td>
                        <td>Patient Profile</td>
                        <td>Date of Admission</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $patient_id = $row["patient_id"];
                ?>
                    <tr data-patient-id="<?php echo $patient_id; ?>" onClick="next_page(this);">
                        <td><?php echo $row["sn"]; ?></td>
                        <td><?php echo $row["fullname"]; ?></td>
                        <td><?php echo $row["patient_id"]; ?></td>
                        <td><img src="<?php echo $website_url . "/uploaded_files/profile_pix/patient/" . $row["patient_passport"]; ?>" alt="Profile Picture"></td>
                        <td><?php echo $row["date"]; ?></td>
                        <td><i class="bi bi-three-dots _action" onclick="showTransferPatientToNurse(event)"></i></td>
                    </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='6'>No patients found</td></tr>";
                }
                ?>
                </tbody>
            </table>



            <div class="modal hidden" id="nurse__transfer__dialogue">
            <button onclick="showNurseTransferForm()" class="bg-blue">Transfer to nurse unit</button>
        </div>

            <!----NURSE APPOITMENT-->
        <div class="modal hidden" id="nurseForm">
            <button class="btn--close-modal" onclick="closeModal('nurseForm')">&times;</button>
                <h3>Transfer to nurse unit</h3>
                <form action="" id="nurseFormTransfer">
                    <div class="sections">
                <div class="form-control">
                    <label for="">Patient name</label>
                    <input type="text" name="" id="name">
                </div>
                <div class="form-control">
                    <label for="">Patient id</label>
                    <input type="text" name="" id="id">
                </div>
                <div class="form-control">
                    <label for="">Reasons for booking</label>
                    <textarea name="" id="reason"></textarea>
                </div>
                </div>
                <button type="button" class="bg-blue" onclick="transfer__patient__to__nurse()">Request</button>
                </form>
            </div>
        </div>
      <!--END OF ADMITTED PATIENTS FOR LIST1-->

      <input id="staff_id" type="hidden" value="<?php echo $s_staff_id?>"  />

        <!--START OF WALKIN PATIENTS FOR LIST2-->
    <div class="walkin_patient_list_div hide">
            <div class="search_bar_container">
                <h3>Walkin patient admission list</h3>
                <input type="text" name="" id="wsearch" placeholder="Search">
            </div>
            <?php 
    $sql = "SELECT * FROM walkin_patient_tab";
    $result = $conn->query($sql);
?>
               <table id="table2">
                <thead>
                    <td>S/N</td>
                    <td>Patient Name</td>
                    <td>Patient ID</td>
                    <td>Patient Profile</td>
                    <td>Date of Admission</td>
                </thead>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $patient_id = $row["wpatient_id"];
                ?>
                    <tr data-patient-id="<?php echo $patient_id; ?>" onClick="next_page(this);">
                        <td><?php echo $row["sn"]; ?></td>
                        <td><?php echo $row["wpatient_name"]; ?></td>
                        <td><?php echo $row["wpatient_id"]; ?></td>
                        <td><img src="<?php echo $website_url . "/uploaded_files/profile_pix/walkin_patient/" . $row["wpassport"]; ?>" alt="Profile Picture"></td>
                        <td><?php echo $row["date"]; ?></td>
                        <td><i class="bi bi-three-dots _action" onclick="showTransferPatientToOtherSection(event)"></i></td>
                    </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='6'>No patients found</td></tr>";
                }
                ?>
                </tbody>
            </table>
            

<div class="modal hidden" id="other__unit">
            <button onclick="showLabTransferForm()" class="bg-blue">Transfer to labouratory unit</button>
            <button onclick="showRadTransferForm()" class="bg-blue">Transfer to radiology unit</button>
        </div>

<!----LAB APPOITMENT---->
<div class="modal hidden" id="labForm">
            <button class="btn--close-modal" onclick="closeModal('labForm')">&times;</button>
                <h3>Labouratory unit</h3>
                <form action="" id="LabFormTransfer">
                    <div class="sections">
                        <div class="form-control">
                            <label for="">Patient name</label>
                            <input type="text" name="" id="name">
                        </div>
                        <div class="form-control">
                            <label for="">Patient id</label>
                            <input type="text" name="" id="id">
                        </div>
                        <div class="form-control">
                            <label for="">Reasons for booking</label>
                            <textarea name="" id=""></textarea>
                        </div>
                    </div>
                <button class="bg-blue">Request</button>
                </form>
            </div>
            <!-----RADIOLOGY APPOITMENT-->
        <div class="modal hidden" id="radForm">
            <button class="btn--close-modal"  onclick="closeModal('radForm')">&times;</button>
                <h3>Radiology unit</h3>
                <form action="" id="RadFormTransfer">
                    <div class="sections">
                        <div class="form-control">
                            <label for="">Patient name</label>
                            <input type="text" name="" id="name">
                        </div>
                        <div class="form-control">
                            <label for="">Patient id</label>
                            <input type="text" name="" id="id">
                        </div>
                        <div class="form-control">
                            <label for="">Reasons for booking</label>
                            <textarea name="" id=""></textarea>
                        </div>
                    </div>
                <button class="bg-blue">Request</button>
                </form>
            </div>
    </div>
    <div class="emergency_patient_list_div">
            <div class="search_bar_container">
                <h3>Emergency list</h3>
                <input type="text" name="" id="wsearch" placeholder="Search">
            </div>
            <?php
                // Assuming you have a valid database connection in $conn
                $sql = "SELECT * FROM emergency_patient_tab WHERE status_id = '1'";
                $result = mysqli_query($conn, $sql);

                echo '<table id="table1">
                        <thead>
                            <tr>
                                <td>S/N</td>
                                <td>Patient Name</td>
                                <td>Patient Emergency ID</td>
                                <td>Date of Admission</td>
                                <td>Option</td>
                            </tr>
                        </thead>
                        <tbody>';

                // Check if there are any records
                if (mysqli_num_rows($result) > 0) {
                    $sn = 1; // Serial number counter
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                                <td>' . $sn++ . '</td>
                                <td>' . htmlspecialchars($row['Epatient_name']) . '</td>
                                <td>' . htmlspecialchars($row['emergency_patient_id']) . '</td>
                                <td>' . htmlspecialchars($row['date']) . '</td>
                                 <td>  <i class ="bi-three-dots"></i></td>
                            </tr>';
                    }
                } else {
                    // No records found
                    echo '<tr>
                            <td colspan="4">No emergency patients available</td>
                        </tr>';
                }

                echo '</tbody></table>';
                ?>

            </div>
    </div>


    
  </div>
    <!--END OF WALKIN PATIENTS FOR LIST2-->


    



 

        <!-----START ALREADY EXISTING PROFILE-->
                <div class="profile_container hide">
                    <div class="div1">
                    <h3>Date of birth : 23-09-2023</h3>
                        <h3>Address: 531 RockVale Dr, Piedmont, South Carolina.</h3>
                        <h3>Phone number: +122 3521 222</h3>
                    </div>
                    <div class="div2">
                        <img src="Images/80e729b199b61a6c183b85263d35a6ef.jpg" alt="">
                        <h3>Juliet Patrick</h3>
                        <h3>PAT0003</h3>
                        <h3>Female</h3>
                        <h3>Active</h3>
                        <div>
                            <button class="bg-blue" onclick="close_profile()">Cancle</button>
                            <button class="bg-blue" onclick="appoitment_booking()">Book an Appoitment</button>
                        </div>
                    </div>
                </div>
        <!-----END ALREADY EXISTING PROFILE-->
        <div class="avalable_doctor">
            <div class="appoitment hide">
            <form action="" class="av_doctor_role hide">
    <div class="form-control">
        <label for="av-roles">Doctor roles</label>
        <select name="roles" id="av-roles" onchange="updateDoctors()">
            <option value="select">Select</option> 
            <option value="surgeon">Surgeon</option> 
            <option value="healthPractitioner">Health Practitioner</option>
            <option value="dentist">Dentist</option>
            <option value="heartDoctor">Heart Doctor</option>
        </select>
    </div>
    <div class="form-control">
        <label for="av-doctors">Available doctors</label>
        <select name="doctors" id="av-doctors">
        </select>
    </div>
    <button type="button" class="bg-blue" onclick="bookPatient()">BOOK PATIENT</button>
</form>
                <form action="" class="book_patient hide">
                    <div class="form-control">
                        <label for="">Patient name</label>
                        <input type="text" name="" id="">
                    </div>
                    <div class="form-control">
                        <label for="">Patient id</label>
                        <input type="text" name="" id="">
                    </div>
                    <div class="form-control">
                        <label for="">Date</label>
                        <input type="date" name="" id="">
                    </div>
                    <div class="form-control">
                        <label for="">Time</label>
                        <input type="time" name="" id="">
                    </div>
                    <div class="form-control">
                        <label for="">Reason for appoitment</label>
                        <textarea name="" id="" cols="30" rows="10"></textarea>
                    </div>
                    <button class="bg-blue">Book</button>
                </form>
            </div>
            </div>
            <div class="overlay hidden"></div>
        <script src="js/receptionist.js"></script>
</body>
</html>
