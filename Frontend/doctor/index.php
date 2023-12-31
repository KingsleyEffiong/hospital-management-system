<?php include '../../backend/config/connection.php';?>
<?php include '../../config/doctor-session-validation.php';?>


<?php
$doctor_id = $_POST['doctor_id'];
?>

<?php    
$fetch_doctor_profile = $callclass->_get_doctor_details($conn, $s_doctor_id);
$doctor_profile_array = json_decode($fetch_doctor_profile, true);
$fullname = $doctor_profile_array[0]['fullname'];
$email = $doctor_profile_array[0]['email'];
$phonenumber = $doctor_profile_array[0]['phonenumber'];
// $role_id= $doctor_profile_array[0]['role_id'];
$status_id = $doctor_profile_array[0]['status_id'];
$date = $doctor_profile_array[0]['date'];
$last_login = $doctor_profile_array[0]['last_login'];
$passport = $doctor_profile_array[0]["passport"]; 
$fetch_status = $callclass->_get_status_details($conn, $status_id);
$status_array = json_decode($fetch_status, true);
$status_name = $status_array[0]['status_name'];
?>

<?php 
$page = "doctor_dash"; // Assign the value "doctor_dash" to the $page variable
?>



<?php
    $fetch_appointment = $callclass->_get_appointment_details($conn, $s_doctor_id);
    $doctor_appointment_array = json_decode($fetch_appointment, true);

    // Check if decoding was successful
    if ($doctor_appointment_array !== null) {
        // Access values from the decoded array
        $patient_name = $doctor_appointment_array[0]['patient_name'];
        $email = $doctor_appointment_array[0]['email'];
        $phonenumber = $doctor_appointment_array[0]['phonenumber'];
        $role_id = $doctor_appointment_array[0]['role_id'];
        $status_id = $doctor_appointment_array[0]['status_id'];
        $passport = $doctor_appointment_array[0]['passport'];
        $appointment_date = $doctor_appointment_array[0]['appointment_date'];
        $appointment_reason = $doctor_appointment_array[0]['reason'];

        // Now you can use these variables as needed in your code
    } else {
        // Handle the case where decoding failed
        echo "Failed to decode JSON";
    }
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <!-- <link rel="stylesheet" href="./dashboard.css"> -->
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href='../awesome-font/css/font-awesome.min.css'>
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
    <nav class="navbar">
        <div class="logo">
            <span style="font-size:2rem; color:#fff;">Doctor Dashboard</span>
        </div>
    <form method="post" action="./../../config/code.php" id="logoutform" class="log_out_form">
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

   <!---Script for dashboard-->
      <div class="container">
    <div class="contents">
        <div class="head-sec">
            <span style="color:black;">Appoitment Details</span>
            <div class="appoitment_input_control">
            <i class="fa fa-search" id="search-icon"></i>
                <input type="text" placeholder="Search here" class="appoitment_input">
            </div>
        </div>
        <div class="body_sec">
        <?php
$sql = "SELECT * FROM appointment_tab WHERE doctor_id ='$s_doctor_id'";
$result = $conn->query($sql);
?>
<table>

    <thead>
        <tr>
            <td>Patient Name</td>
            <td>Date</td>
            <td>Time</td>
            <td>Request Type</td>
            <td>Accept/Reject</td>
        </tr>
    </thead>

    <tbody class="a_1">
        <?php

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                
            
                echo "<td>" . $row["patient_name"] . "</td>";
                echo "<td>" . $row["appointment_date"] . "</td>";
                echo "<td>" . $row["time"] . "</td>";
                echo "<td>" . $row["reason"] . "</td>";
                ?>
                <td>
                    <button onClick="display_input(<?php $patient_id ?>)">Accept</button>
                    <button>Reject</button>
                </td>
                </tr>
            <?php
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>
    </tbody>
</table>

      



        </div>


     <!----Start from here-->
   <div class="all_sections_input hide">
    <!--Start of the complaint section--->
   <div class="complain_dropdown">
    <span>Complaints</span>
    <i class="fa fa-plus" id="complaint_icon_plus"></i>
    <i class="fa fa-minus" id="complaint_icon_minus"></i>
   </div>
   <div class="complaint-section hidden">
        <form action="">
            <div class="complaint_form-control">
            <label for="major_complaints">Major Complaints & Duration</label>
            <input type="text"  class="complaint-input" id="major_complaints">
            </div>
            <div class="complaint_form-control">
            <label for="history_of_presenting_complaints">History of Presenting Complaints</label>
            <input type="text" class="complaint-input" id="history_of_presenting_complaints">
            </div>
            <div class="complaint_form-control">
            <label for="family_social_history">Family & Social History</label>
            <input type="text" class="complaint-input" id="family_social_history">
            </div>
            <div class="complaint_form-control">
            <label for="past_sugical_medical_history">Past Surgical/Medical History</label>
            <input type="text"  class="complaint-input" id="past_sugical_medical_history">
            </div>
            <div class="complaint_form-control">
            <label for="major_complaints">Surgical Procedure</label>
            <div class="checkbox">
            <input type="checkbox" name="surgery" id="check1">
            <label for="surgery">Yes</label>
            <input type="checkbox" name="surgery" id="check2">
            <label for="surgery">No</label>
            </div>
</div>
        </form>
   </div>
   <div class="surgical_booking hidden">
    <i class="fa fa-times-circle" id='close-icon' onClick="close_procedure_form()"></i>
        <h1 class="login-form-h1">Surgical Procedure</h1>
        <form>
        <div class="form-control-precedure">
        <label for='full_name'>Full  name</label>
        <input type="text" name="full_name" autoComplete='off' class="surgical_input" id="full_name"/> 
        </div>

        <div class="form-control-precedure">
        <label for='date'>Date</label>
        <input type="date"  name="date" autoComplete='off' class="surgical_input" id="date"/> 
        </div>
        <div class="form-control-precedure">
        <label for='time'>Time</label>
        <input type="time"  name="time" autoComplete='off' class="surgical_input" id="time"/> 
        </div>

        <div class="form-control-precedure">
        <label for='procedure'>Procedure</label>
        <input type="text" name="procedures" autoComplete='off' class="surgical_input" id="procedure"/> 
        </div>
        <div class="form-control-precedure">
        <label for='phone_number'>Phone Number</label>
        <input type="number" name="phone_number" autoComplete='off' class="surgical_input" id="phone_number"/> 
        </div>
        <div class="form-control-precedure">
        <label for='cost'>Cost</label>
        <input type="number" name="cost" autoComplete='off' class="surgical_input" id="cost"/> 
        </div>
        <button type="button" class="btn" onClick="if_details_correct_login()">Submit</button>
</form>
    </div>
           <!--End of the complaint section--->

               <!--Start of the System & Review section--->
               <div class="system_dropdown">
    <span>System Review and Symptom</span>
    <i class="fa fa-plus" id="system_icon_plus"></i>
    <i class="fa fa-minus" id="system_icon_minus"></i>
   </div>
               <div class="system_review-section hidden">
        <div class="drop-down1">
            <span>General</span>
            <i class="fa fa-minus" id="close_id_1"></i>
            <i class="fa fa-plus" id="open_id_1"></i>
        </div>
            <form action="" class="form1 hidden">
                <div class="form-control">
                <label for="headache">Headache</label>
                <div class="radio">
                <input type="radio" id="yes" name="h1" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="h1" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Fatigue?</label>
                <div class="radio">
                <input type="radio" id="yes" name="f1" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="f1" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Overall Weekness?</label>
                <div class="radio">
                <input type="radio" id="yes" name="o1" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="01" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Change in appetite?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ca1" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ca1" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Change in weight</label>
                <div class="radio">
                <input type="radio" id="yes" name="cw1" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="cw1" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Fever</label>
                <div class="radio">
                <input type="radio" id="yes" name="fv1" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="fv1" />
                <label for="no">No</label>
                </div>
  </div>
  </form>
  <div class="drop-down2">
            <span>Skin</span>
            <i class="fa fa-minus" id="close_id_2"></i>
            <i class="fa fa-plus" id="open_id_2"></i>
        </div>
        <form action="" class="form2 hidden">
                <div class="form-control">
                <label for="headache">Change in mole(s)?</label>
                <div class="radio">
                <input type="radio" id="yes" name="cm" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="cm" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Hair or nail changes?</label>
                <div class="radio">
                <input type="radio" id="yes" name="h/n" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="h/n" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Color or texture change ?</label>
                <div class="radio">
                <input type="radio" id="yes" name="c/t" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="c/t" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Itching or Rashes ?</label>
                <div class="radio">
                <input type="radio" id="yes" name="i/r" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="i/r" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Sores </label>
                <div class="radio">
                <input type="radio" id="yes" name="s" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="s" />
                <label for="no">No</label>
                </div>
  </div>
  </form>
  <div class="drop-down3">
            <span>Endocrine</span>
            <i class="fa fa-minus" id="close_id_3"></i>
            <i class="fa fa-plus" id="open_id_3"></i>
        </div>
        <form action="" class="form3 hidden">
                <div class="form-control">
                <label for="headache">Enlarging glove or hat size?</label>
                <div class="radio">
                <input type="radio" id="yes" name="e/hs" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="e/hs" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Excessive thirst?</label>
                <div class="radio">
                <input type="radio" id="yes" name="et" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="et" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Salt craving ?</label>
                <div class="radio">
                <input type="radio" id="yes" name="sc" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="sc" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Lost of Sexual drive (libido)?</label>
                <div class="radio">
                <input type="radio" id="yes" name="lsd" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="lsd" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Heat or cold intolerance?</label>
                <div class="radio">
                <input type="radio" id="yes" name="hci" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="hci" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Thyriod enlargement?</label>
                <div class="radio">
                <input type="radio" id="yes" name="te" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="te" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Abnormal growth?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ag"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ag"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Increased appetite?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ia"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ia"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Increased urine production?</label>
                <div class="radio">
                <input type="radio" id="yes" name="iup"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="iup"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Thyriod trouble?</label>
                <div class="radio">
                <input type="radio" id="yes" name="tr"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="tr"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Excessive swearing?</label>
                <div class="radio">
                <input type="radio" id="yes" name="es"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="es"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Diabetes?</label>
                <div class="radio">
                <input type="radio" id="yes" name="d"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="d"/>
                <label for="no">No</label>
                </div>
  </div>
  </form>
  <div class="drop-down4">
            <span>Hematopoietic</span>
            <i class="fa fa-minus" id="close_id_4"></i>
            <i class="fa fa-plus" id="open_id_4"></i>
        </div>
        <form action="" class="form4 hidden">
                <div class="form-control">
                <label for="headache">Chemotherapy Management for Hematopoietic Disorders?</label>
                <div class="radio">
                <input type="radio" id="yes" name="cmhd" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="cmhd" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Radiation therapy integration for Hermatopoietic condition?</label>
                <div class="radio">
                <input type="radio" id="yes" name="rtihc" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="rtihc" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Immunotherapy traking for Hermatopoietic disorder ?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ithd" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ithd" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Steam cell transplantation?</label>
                <div class="radio">
                <input type="radio" id="yes" name="sct" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="sct" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Anticoagulant medication?</label>
                <div class="radio">
                <input type="radio" id="yes" name="am" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="am" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Iron chelation?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ic" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ic" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Hematopoietic growth?</label>
                <div class="radio">
                <input type="radio" id="yes" name="hg"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="hg"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Blood tranfusion?</label>
                <div class="radio">
                <input type="radio" id="yes" name="bt"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="bt"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Erthropoletin?</label>
                <div class="radio">
                <input type="radio" id="yes" name="etin"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="etin"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Granalocyte colony-stimulation?</label>
                <div class="radio">
                <input type="radio" id="yes" name="gcs"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="gcs"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Intravenous immunogubullin?</label>
                <div class="radio">
                <input type="radio" id="yes" name="imin"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="imin"/>
                <label for="no">No</label>
                </div>
  </div>
  </form>
  <div class="drop-down5">
            <span>Muscoskeletal</span>
            <i class="fa fa-minus" id="close_id_5"></i>
            <i class="fa fa-plus" id="open_id_5"></i>
        </div>
        <form action="" class="form5 hidden">
                <div class="form-control">
                <label for="headache">Physical therapy?</label>
                <div class="radio">
                <input type="radio" id="yes" name="pt" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="pt" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Occupational therapy?</label>
                <div class="radio">
                <input type="radio" id="yes" name="occpt" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="occpt" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Orthopedic consultion ?</label>
                <div class="radio">
                <input type="radio" id="yes" name="oc" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="oc" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Pain medication?</label>
                <div class="radio">
                <input type="radio" id="yes" name="pm" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="pm" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Join aspiration?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ja" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ja" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Muscle relaxant?</label>
                <div class="radio">
                <input type="radio" id="yes" name="mr" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="mr" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Surgical intervention?</label>
                <div class="radio">
                <input type="radio" id="yes" name="si"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="si"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Anti-inflammation?</label>
                <div class="radio">
                <input type="radio" id="yes" name="anti-in"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="anti-in"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Assistive?</label>
                <div class="radio">
                <input type="radio" id="yes" name="assistive"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="assistive"/>
                <label for="no">No</label>
                </div>
  </div>
  </form>
  <div class="drop-down6">
            <span>Head & Neck</span>
            <i class="fa fa-minus" id="close_id_6"></i>
            <i class="fa fa-plus" id="open_id_6"></i>
        </div>
        <form action="" class="form6 hidden">
                <div class="form-control">
                <label for="headache">Symptom for head and neck issue?</label>
                <div class="radio">
                <input type="radio" id="yes" name="shni" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="shni" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Record ear, nose, throat (ENT) exams?</label>
                <div class="radio">
                <input type="radio" id="yes" name="rente" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="rente" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Head and neck cancers ?</label>
                <div class="radio">
                <input type="radio" id="yes" name="hnc" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="hnc" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Dental and oral health?</label>
                <div class="radio">
                <input type="radio" id="yes" name="doh" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="doh" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Speech and swallowing assesment?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ssa" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ssa" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Biopsies for neck masses?</label>
                <div class="radio">
                <input type="radio" id="yes" name="bnm" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="bnm" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Thyriod function tests?</label>
                <div class="radio">
                <input type="radio" id="yes" name="tft"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="tft"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Salivary gland disorders?</label>
                <div class="radio">
                <input type="radio" id="yes" name="sgd"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="sgd"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">TMJ evaluations?</label>
                <div class="radio">
                <input type="radio" id="yes" name="tmj"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="tmj"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">imaging for skull and bones?</label>
                <div class="radio">
                <input type="radio" id="yes" name="is&b"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="is&b"/>
                <label for="no">No</label>
                </div>
  </div>
  </form>
  <div class="drop-down7">
            <span>Ears, Nose, Sinuses, Mouth & Throat</span>
            <i class="fa fa-minus" id="close_id_7"></i>
            <i class="fa fa-plus" id="open_id_7"></i>
        </div>
        <form action="" class="form7 hidden">
                <div class="form-control">
                <label for="headache">Hearing loss?</label>
                <div class="radio">
                <input type="radio" id="yes" name="hl" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="hl" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Tinnitus Evalution?</label>
                <div class="radio">
                <input type="radio" id="yes" name="te" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="te" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Ear pain?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ep" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ep" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Ear discharge?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ed" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ed" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Nasal congestion?</label>
                <div class="radio">
                <input type="radio" id="yes" name="nc" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="nc" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Sinus discharge?</label>
                <div class="radio">
                <input type="radio" id="yes" name="sd" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="sd" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Allergic Rhinitis?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ar"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ar"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Oral pain?</label>
                <div class="radio">
                <input type="radio" id="yes" name="op"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="op"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Throat pain?</label>
                <div class="radio">
                <input type="radio" id="yes" name="tp"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="tp"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Dysphagia?</label>
                <div class="radio">
                <input type="radio" id="yes" name="dysphagia"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="dysphagia"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Mouth Lessions?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ml"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ml"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Voice changes?</label>
                <div class="radio">
                <input type="radio" id="yes" name="vc"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="vc"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Halitosis(Bad breath)?</label>
                <div class="radio">
                <input type="radio" id="yes" name="halitosis"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="halitosis"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Gag reflex?</label>
                <div class="radio">
                <input type="radio" id="yes" name="gr"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="gr"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Oral thrush?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ot"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ot"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Tonsillitis?</label>
                <div class="radio">
                <input type="radio" id="yes" name="Tonsillitis"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="Tonsillitis"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Hoarseness?</label>
                <div class="radio">
                <input type="radio" id="yes" name="Hoarseness"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="Hoarseness"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Oral  cancer?</label>
                <div class="radio">
                <input type="radio" id="yes" name="oral_cancer"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="oral_cancer"/>
                <label for="no">No</label>
                </div>
</div>
                <div class="form-control">
                <label for="headache">Recurrent Sore Throat?</label>
                <div class="radio">
                <input type="radio" id="yes" name="rsc"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="rsc"/>
                <label for="no">No</label>
                </div>
  </div>
  </form>
  <div class="drop-down8">
            <span>Breast</span>
            <i class="fa fa-minus" id="close_id_8"></i>
            <i class="fa fa-plus" id="open_id_8"></i>
        </div>
        <form action="" class="form8 hidden">
                <div class="form-control">
                <label for="headache">Breast Disorder?</label>
                <div class="radio">
                <input type="radio" id="yes" name="bd" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="bd" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Surgical Invervention monitoring for breast condition?</label>
                <div class="radio">
                <input type="radio" id="yes" name="simbc" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="simbc" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Hormone replacement?</label>
                <div class="radio">
                <input type="radio" id="yes" name="hr" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="hr" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Breast imaging follow-up?</label>
                <div class="radio">
                <input type="radio" id="yes" name="bifu" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="bifu" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Reconstructive surgery?</label>
                <div class="radio">
                <input type="radio" id="yes" name="rs" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="rs" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Breast pain?</label>
                <div class="radio">
                <input type="radio" id="yes" name="bp" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="bp" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Nutritional?</label>
                <div class="radio">
                <input type="radio" id="yes" name="n"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="n"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Pschosicial Intergration?</label>
                <div class="radio">
                <input type="radio" id="yes" name="pi"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="pi"/>
                <label for="no">No</label>
                </div>
  </div>
  </form>
  <div class="drop-down9">
            <span>Respiratory</span>
            <i class="fa fa-minus" id="close_id_9"></i>
            <i class="fa fa-plus" id="open_id_9"></i>
        </div>
        <form action="" class="form9 hidden">
                <div class="form-control">
                <label for="headache">Respiratory symptom?</label>
                <div class="radio">
                <input type="radio" id="yes" name="rs" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="rs" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Pulmonary function test?</label>
                <div class="radio">
                <input type="radio" id="yes" name="pft" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="pft" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Chest X-ray imaging?</label>
                <div class="radio">
                <input type="radio" id="yes" name="cxi" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="cxi" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Oxygen therapy?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ot" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ot" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Ventilator?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ventilator" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ventilator" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Bronchoscopy?</label>
                <div class="radio">
                <input type="radio" id="yes" name="bronchoscopy" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="bronchoscopy" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Pneumonia?</label>
                <div class="radio">
                <input type="radio" id="yes" name="pneumonia"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="pneumonia"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Asthma action?</label>
                <div class="radio">
                <input type="radio" id="yes" name="aa"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="aa"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Respiratory infection?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ri"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ri"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">COPD?</label>
                <div class="radio">
                <input type="radio" id="yes" name="copd"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="copd"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Spiometer test?</label>
                <div class="radio">
                <input type="radio" id="yes" name="st"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="st"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Smoking cessation?</label>
                <div class="radio">
                <input type="radio" id="yes" name="sc"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="sc"/>
                <label for="no">No</label>
                </div>
  </div>
  </form>
  <div class="drop-down10">
            <span>Cardiovascular</span>
            <i class="fa fa-minus" id="close_id_10"></i>
            <i class="fa fa-plus" id="open_id_10"></i>
        </div>
        <form action="" class="form10 hidden">
                <div class="form-control">
                <label for="headache">Cardiovascular condition?</label>
                <div class="radio">
                <input type="radio" id="yes" name="cardiovascular_condition" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="cardiovascular_condition" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Bood pressure?</label>
                <div class="radio">
                <input type="radio" id="yes" name="bp" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="bp" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Cholesterol Level?</label>
                <div class="radio">
                <input type="radio" id="yes" name="cl" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="cl" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Antiplatelet?</label>
                <div class="radio">
                <input type="radio" id="yes" name="antiplatelet" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="antiplatelet" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Beta-Blocker?</label>
                <div class="radio">
                <input type="radio" id="yes" name="bb" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="bb" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Angiotensin-converting enzyme (ACE) inhibitor?</label>
                <div class="radio">
                <input type="radio" id="yes" name="acei" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="acei" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Anticoagulant?</label>
                <div class="radio">
                <input type="radio" id="yes" name="anticoagulant"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="anticoagulant"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Cardiac?</label>
                <div class="radio">
                <input type="radio" id="yes" name="c"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="c"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Heart failure & Diuretic?</label>
                <div class="radio">
                <input type="radio" id="yes" name="hf&d"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="hf&d"/>
                <label for="no">No</label>
                </div>
  </div>
  </form>
  <div class="drop-down11">
            <span>Gastrointestinal</span>
            <i class="fa fa-minus" id="close_id_11"></i>
            <i class="fa fa-plus" id="open_id_11"></i>
</div>
<form action="" class="form11 hidden">
                <div class="form-control">
                <label for="headache">Gastrointestinal symptom?</label>
                <div class="radio">
                <input type="radio" id="yes" name="gastrointestinal_symptom" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="gastrointestinal_symptom" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Endoscopy?</label>
                <div class="radio">
                <input type="radio" id="yes" name="endoscopy" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="endoscopy" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Colonoscopy?</label>
                <div class="radio">
                <input type="radio" id="yes" name="colonoscopy" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="colonoscopy" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Radiology Issue?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ri" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ri" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Gastrointestinal disorder?</label>
                <div class="radio">
                <input type="radio" id="yes" name="gd" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="gd" />
                <label for="no">No</label>
                </div>
  </div>
  </form>
  </div>
        <!--End of the System & Review section--->

  <!--Start of Physica, Examination-->
  <div class="physical_dropdown">
    <span>Physical Examination</span>
    <i class="fa fa-plus" id="physical_icon_plus"></i>
    <i class="fa fa-minus" id="physical_icon_minus"></i>
   </div>
  <div class="physical_examination-section hidden">
        <div class="physical_examination_drop-down1">
            <span>General</span>
            <i class="fa fa-minus" id="physical_examination_icon_minus1"></i>
            <i class="fa fa-plus" id="physical_examination_icon_plus1"></i>
        </div>
        <form action="" class="physical_examination_form1 hidden">
            <div class="physical_examination_form-control">
            <label for="physical_examination">Physical Examination</label>
            <input type="text" id="physical_examination">
</div>
        </form>
        <div class="physical_examination_drop-down2">
            <span>Neurological</span>
            <i class="fa fa-minus" id="physical_examination_icon_minus2"></i>
            <i class="fa fa-plus" id="physical_examination_icon_plus2"></i>
        </div>
        <form action="" class="physical_examination_form2 hidden">
            <div class="physical_examination_form-control">
            <label for="mental_status">Mental Status</label>
            <input type="text" id="mental_status">
            </div>
            <div class="physical_examination_form-control">
            <label for="cranial_nerves">Cranial Nerves</label>
            <input type="text" id="cranial_nerves">
            </div>
            <div class="physical_examination_form-control">
            <label for="position_sense">Position Sense</label>
            <input type="text" id="position_sense">
            </div>
            <div class="physical_examination_form-control">
            <label for="vibration_sense">Vibration Sense</label>
            <input type="text" id="vibration_sense">
            </div>
            <div class="physical_examination_form-control">
            <label for="reflex_technique">Reflex Technique</label>
            <input type="text" id="reflex_technique">
            </div>
            <div class="physical_examination_form-control">
            <label for="coordination_of_upper_extremities">Coordination of upper extremities</label>
            <input type="text" id="coordination_of_upper_extremities">
            </div>
            <div class="physical_examination_form-control">
            <label for="coordination_of_lower_extremities">Coordination of lower extremities</label>
            <input type="text" id="coordination_of_lower_extremities">
            </div>
            <div class="physical_examination_form-control">
            <label for="gait">Gait</label>
            <input type="text" id="gait">
            </div>
            <div class="physical_examination_form-control">
            <label for="glasgow">Glasgow coma scale</label>
            <input type="text" id="glasgow">
            </div>
            <div class="physical_examination_form-control">
            <label for="headache">Eye opening response</label>
                <div class="radio">
                <input type="radio" id="spontaneous" name="eye"/>
                <label for="spontaneous">Spontaneous</label>
                <input type="radio" id="to_speech" name="eye"/>
                <label for="to_speech">To speech </label>
                <input type="radio" id="to_pain" name="eye"/>
                <label for="no_response">To Pain </label>
                <input type="radio" id="no_response" name="eye"/>
                <label for="no_response">No Response</label>
                </div>
</div>
            <div class="physical_examination_form-control">
            <label for="headache">Best verbal response</label>
                <div class="radio">
                <input type="radio" id="oriented" name="verbal"/>
                <label for="oriented">Oriented to time, place & person </label>
                <input type="radio" id="confused" name="verbal"/>
                <label for="confused">Confused 3</label>
                <input type="radio" id="inappropraite" name="verbal"/>
                <label for="no_response">Inappropraite words</label>
                <input type="radio" id="incmprehensible" name="verbal"/>
                <label for="response">Incomprehensible sounds</label>
                <input type="radio" id="response" name="verbal"/>
                <label for="response">No Response</label>
                </div>
</div>
            <div class="physical_examination_form-control">
            <label for="headache">Best motor response</label>
                <div class="radio">
                <input type="radio" id="obey" name="motor"/>
                <label for="obey">Obey command</label>
                <input type="radio" id="localized" name="motor"/>
                <label for="localized">Moved to localised pain</label>
                <input type="radio" id="flexion" name="motor"/>
                <label for="flexion">Flexion withdrawal from pain</label>
                <input type="radio" id="abnornal" name="motor"/>
                <label for="abnormal">Abnormal flexion(decorticate)</label>
                <input type="radio" id="response" name="motor"/>
                <label for="response">No Response</label>
                </div>
</div>
        
        </form>
        <div class="physical_examination_drop-down3">
            <span>Vital Sign</span>
            <i class="fa fa-minus" id="physical_examination_icon_minus3"></i>
            <i class="fa fa-plus" id="physical_examination_icon_plus3"></i>
        </div>
        <form action="" class="physical_examination_form3 hidden">
            <div class="physical_examination_form-control">
            <label for="physical_blood_pressure">Blood Pressure</label>
            <input type="text" id="physical_blood_pressure">
            </div>
            <div class="physical_examination_form-control">
            <label for="heart_rate">Heart Rate</label>
            <input type="text" id="heart_rate">
            </div>
            <div class="physical_examination_form-control">
            <label for="respiratory_rate">Respiratory Rate</label>
            <input type="text" id="respiratory_rate">
            </div>
            <div class="physical_examination_form-control">
            <label for="temperature">Temperature</label>
            <input type="text" id="temperature">
            </div>
            <div class="physical_examination_form-control">
            <label for="oxygen_saturation">Oxygen Saturation</label>
            <input type="text" id="oxygen_saturation">
            </div>
</form>
<div class="physical_examination_drop-down4">
            <span>General Apperance</span>
            <i class="fa fa-minus" id="physical_examination_icon_minus4"></i>
            <i class="fa fa-plus" id="physical_examination_icon_plus4"></i>
        </div>
        <form action="" class="physical_examination_form4 hidden">
            <div class="physical_examination_form-control">
            <label for="level">Level of Consciousness</label>
            <input type="text" id="level">
            </div>
            <div class="physical_examination_form-control">
            <label for="nutritional">Nutritional Status</label>
            <input type="text" id="nutritional">
            </div>
            <div class="physical_examination_form-control">
            <label for="signs">Signs of Distress/Discomfort</label>
            <input type="text" id="signs">
            </div>
            <div class="physical_examination_form-control">
            <label for="body_habitus">Body Habitus</label>
            <input type="text" id="body_habitus">
            </div>
</form>
<div class="physical_examination_drop-down5">
            <span>Skin Examination</span>
            <i class="fa fa-minus" id="physical_examination_icon_minus5"></i>
            <i class="fa fa-plus" id="physical_examination_icon_plus5"></i>
        </div>
        <form action="" class="physical_examination_form5 hidden">
            <div class="physical_examination_form-control">
            <label for="pigmentation">Color/Pigmentation</label>
            <input type="text" id="pigmentation">
            </div>
            <div class="physical_examination_form-control">
            <label for="moisture/temperature">Moisture/Temperature</label>
            <input type="text" id="moisture_temperature">
            </div>
            <div class="physical_examination_form-control">
            <label for="lesions/rashes">Lesions/Rashes/Abnormalities</label>
            <input type="text" id="lesions/rashes">
            </div>
            <div class="physical_examination_form-control">
            <label for="bruising">Brusing/Petechiae</label>
            <input type="text" id="bruising">
            </div>
            <div class="physical_examination_form-control">
            <label for="scars">Scars/Surgical Incisions</label>
            <input type="text" id="scars">
            </div>
</form>
<div class="physical_examination_drop-down6">
            <span>Head and Neck</span>
            <i class="fa fa-minus" id="physical_examination_icon_minus6"></i>
            <i class="fa fa-plus" id="physical_examination_icon_plus6"></i>
        </div>
        <form action="" class="physical_examination_form6 hidden">
            <div class="physical_examination_form-control">
            <label for="scalp/hair/nails">Scalp/Hair/Nails</label>
            <input type="text" id="scalp_hair_nails">
            </div>
            <div class="physical_examination_form-control">
            <label for="eyes/ears/nose/throat">Eyes/Ears/Nose/Throat:</label>
            <input type="text" id="eyes_ears_nose_throat"">
            </div>
            <div class="physical_examination_form-control">
            <label for="lesions/rashes">Lesions/Rashes/Abnormalities</label>
            <input type="text" id="lesions_rashes">
            </div>
            <div class="physical_examination_form-control">
            <label for="lymph_nodes">Lymph Nodes</label>
            <input type="text" id="lymph_nodes">
            </div>
            <div class="physical_examination_form-control">
            <label for="neck_rang_of_Motion">Neck Range of Motion</label>
            <input type="text" id="neck_rang_of_Motion">
            </div>
            <div class="physical_examination_form-control">
            <label for="presence_of_Bruits">Presence of Bruits (if applicable)</label>
            <input type="text" id="presence_of_Bruits">
            </div>
</form>
<div class="physical_examination_drop-down7">
            <span>Cardiovascular Examination</span>
            <i class="fa fa-minus" id="physical_examination_icon_minus7"></i>
            <i class="fa fa-plus" id="physical_examination_icon_plus7"></i>
        </div>
        <form action="" class="physical_examination_form7 hidden">
            <div class="physical_examination_form-control">
            <label for="inspection_palpation_of_precordium">Inspection/Palpation of Precordium</label>
            <input type="text" id="inspection_palpation_of_precordium">
            </div>
            <div class="physical_examination_form-control">
            <label for="auscultation_of_heart_sounds_murmurs">Auscultation of Heart Sounds/Murmurs</label>
            <input type="text" id="auscultation_of_heart_sounds_murmurs">
            </div>
            <div class="physical_examination_form-control">
            <label for="peripheral_pulses">Peripheral Pulses</label>
            <input type="text" id="peripheral_pulses">
            </div>
            <div class="physical_examination_form-control">
            <label for="edema_assessment">Edema Assessment</label>
            <input type="text" id="edema_assessment">
            </div>
            <div class="physical_examination_form-control">
            <label for="capillary_refill_time">Capillary Refill Time</label>
            <input type="text" id="capillary_refill_time">
</div>
</form>
<div class="physical_examination_drop-down8">
            <span>Respiratory Examination</span>
            <i class="fa fa-minus" id="physical_examination_icon_minus8"></i>
            <i class="fa fa-plus" id="physical_examination_icon_plus8"></i>
        </div>
           <form action="" class="physical_examination_form8 hidden">
            <div class="physical_examination_form-control">
            <label for="respiratory_effort_inspection">Respiratory Effort Inspection</label>
            <input type="text" id="respiratory_effort_inspection">
            </div>
            <div class="physical_examination_form-control">
            <label for="palpation_percussion_of_chest">Palpation/Percussion of Chest</label>
            <input type="text" id="palpation_percussion_of_chest">
            </div>
            <div class="physical_examination_form-control">
            <label for="auscultation_of_breath Sounds">Auscultation of Breath Sounds</label>
            <input type="text" id="auscultation_of_breath">
            </div>
            <div class="physical_examination_form-control">
            <label for="cough_sputum_assessment">Cough/Sputum Assessment</label>
            <input type="text" id="cough_sputum_assessment">
            </div>
</form>
<div class="physical_examination_drop-down9">
            <span>Abdominal Examination</span>
            <i class="fa fa-minus" id="physical_examination_icon_minus9"></i>
            <i class="fa fa-plus" id="physical_examination_icon_plus9"></i>
        </div>
        <form action="" class="physical_examination_form9 hidden">
            <div class="physical_examination_form-control">
            <label for="presence_of _tenderness_masses">Presence of Tenderness/Masses</label>
            <input type="text" id="presence_of _tenderness_masses">
            </div>
            <div class="physical_examination_form-control">
            <label for="bowel_sounds_assessment_sounds">Bowel Sounds Assessment</label>
            <input type="text" id="bowel_sounds_assessment_sounds">
            </div>
</form>
<div class="physical_examination_drop-down10">
            <span>Genitourinary Examination</span>
            <i class="fa fa-minus" id="physical_examination_icon_minus10"></i>
            <i class="fa fa-plus" id="physical_examination_icon_plus10"></i>
        </div>
        <form action="" class="physical_examination_form10 hidden">
            <div class="physical_examination_form-control">
            <label for="genitalia_inspection">Genitalia Inspection</label>
            <input type="text" id="genitalia_inspection">
            </div>
            <div class="physical_examination_form-control">
            <label for="urinary_function_assessment">Urinary Function Assessment</label>
            <input type="text" id="urinary_function_assessment">
            </div>
            <div class="physical_examination_form-control">
            <label for="pelvic_examination_sounds">Pelvic Examination (if applicable)</label>
            <input type="text" id="pelvic_examination_sounds">
            </div>
            <div class="physical_examination_form-control">
            <label for="prostate_examination">Prostate Examination (if applicable)</label>
            <input type="text" id="prostate_examination">
            </div>
</form>
<div class="physical_examination_drop-down11">
            <span>Musculoskeletal Examination</span>
            <i class="fa fa-minus" id="physical_examination_icon_minus11"></i>
            <i class="fa fa-plus" id="physical_examination_icon_plus11"></i>
        </div>
        <form action="" class="physical_examination_form11 hidden">
            <div class="physical_examination_form-control">
            <label for="genitalia_inspection_of_joint">Inspection/Palpation of Joints</label>
            <input type="text" id="genitalia_inspection_of_joint">
            </div>
            <div class="physical_examination_form-control">
            <label for="range_of_motion_assessment">Range of Motion Assessment</label>
            <input type="text" id="range_of_motion_assessment">
            </div>
            <div class="physical_examination_form-control">
            <label for="gait_balance_evaluation">Gait/Balance Evaluation</label>
            <input type="text" id="gait_balance_evaluation">
            </div>
            <div class="physical_examination_form-control">
            <label for="pine_examination">pine Examination</label>
            <input type="text" id="pine_examination">
            </div>
</form>
<div class="physical_examination_drop-down12">
            <span>Neurological Examination</span>
            <i class="fa fa-minus" id="physical_examination_icon_minus12"></i>
            <i class="fa fa-plus" id="physical_examination_icon_plus12"></i>
        </div>
        <form action="" class="physical_examination_form12 hidden">
            <div class="physical_examination_form-control">
            <label for="mental_status_assessment">Mental Status Assessment</label>
            <input type="text" id="mental_status_assessment">
            </div>
            <div class="physical_examination_form-control">
            <label for="cranial_nerve_examination">Cranial Nerve Examination</label>
            <input type="text" id="cranial_nerve_examination">
            </div>
            <div class="physical_examination_form-control">
            <label for="motor/sensory_function">Motor/Sensory Function</label>
            <input type="text" id="cranial_nerve_examination">
            </div>
            <div class="physical_examination_form-control">
            <label for="reflexes">Reflexes</label>
            <input type="text" id="reflexes">
            </div>
            <div class="physical_examination_form-control">
            <label for="coordination_balance_assessment">Coordination/Balance Assessment</label>
            <input type="text" id="coordination_balance_assessment">
            </div>
</form>
<div class="physical_examination_drop-down13">
            <span>Review of Systems (ROS)</span>
            <i class="fa fa-minus" id="physical_examination_icon_minus13"></i>
            <i class="fa fa-plus" id="physical_examination_icon_plus13"></i>
        </div>
        <form action="" class="physical_examination_form13 hidden">
            <div class="physical_examination_form-control">
            <label for="cardiovascular_system">Cardiovascular System</label>
            <input type="text" id="cardiovascular_system">
            </div>
            <div class="physical_examination_form-control">
            <label for="respiratory_system">Respiratory System</label>
            <input type="text" id="respiratory_system">
            </div>
            <div class="physical_examination_form-control">
            <label for="gastrointestinal_system">Gastrointestinal System</label>
            <input type="text" id="gastrointestinal_system">
            </div>
            <div class="physical_examination_form-control">
            <label for="genitourinary_system">Genitourinary System</label>
            <input type="text" id="genitourinary_system">
            </div>
            <div class="physical_examination_form-control">
            <label for="neurological_system">Neurological System</label>
            <input type="text" id="neurological_system">
            </div>
</form>
<div class="physical_examination_drop-down14">
            <span>Social and Family History</span>
            <i class="fa fa-minus" id="physical_examination_icon_minus14"></i>
            <i class="fa fa-plus" id="physical_examination_icon_plus14"></i>
        </div>
        <form action="" class="physical_examination_form14 hidden">
            <div class="physical_examination_form-control">
            <label for="social_habits(smoking,alcohol,drugs)">Social Habits (smoking, alcohol)</label>
            <input type="text" id="social_habits(smoking,alcohol,drugs)">
            </div>
            <div class="physical_examination_form-control">
            <label for="family_medical_history">Family Medical History</label>
            <input type="text" id="family_medical_history">
            </div>
            <div class="physical_examination_form-control">
            <label for="occupation_environmental_exposures">Occupation/Environmental</label>
            <input type="text" id="occupation_environmental_exposures">
            </div>
            <div class="physical_examination_form-control">
            <label for="living_conditions_support_system">Living Conditions/Support System</label>
            <input type="text" id="living_conditions_support_system">
            </div>
</form>
    </div>
      <!--End of Physica, Examination-->

    <!--Start for Treatment and Prescribtion--->
    <div class="treatment_prescribtion_dropdown">
    <span>Treatment & Prescription</span>
    <i class="fa fa-plus" id="treatment_prescribtion_icon_plus"></i>
    <i class="fa fa-minus" id="treatment_prescribtion_minus"></i>
   </div>
   <div class="treatment_prescribtion-section hidden">
        <form action="" class="treatment_prescribtion_form1">
            <div class="treatment_prescribtion_form-control">
            <label for="drugs">Drugs</label>
            <input type="text" class="treatment_prescribtion-input_change_width" id="drugs">
            </div>
            <div class="treatment_prescribtion_form-control">
            <label for="strength">Strength</label>
            <input type="text" class="treatment_prescribtion-input" id="strength">
            </div>
            <div class="treatment_prescribtion_form-control">
            <label for="mode">Mode</label>
            <select name="mode" id="mode" class="treatment_prescribtion-input" id="mode">
                <option value="injection">Injection</option>
                <option value="capsule">Capsule</option>
            </select>
            </div>
            <div class="treatment_prescribtion_form-control">
            <label for="administration">Administration</label>
            <select name="administration" id="administration" class="treatment_prescribtion-input">
                <option value="im">IM</option>
                <option value="others">Others</option>
            </select>
            </div>
            <div class="treatment_prescribtion_form-control">
            <label for="dos">Dos</label>
            <input type="number" class="treatment_prescribtion-input" id="dos"> 
            </div>
            <div class="treatment_prescribtion_form-control">
            <label for="unit">Unit</label>
            <select name="unit" id="unit" class="treatment_prescribtion-input">
                <option value=""></option>
                <option value=""></option>
            </select>
            </div>
            <div class="treatment_prescribtion_form-control">
            <label for="frequency">Frequency</label>
            <select name="frequency" id="frequency" class="treatment_prescribtion-input">
                <option value="hours">24 hourly</option>
                <option value="others">others</option>
            </select>
            </div>
            <div class="treatment_prescribtion_form-control">
            <label for="duration">Duration</label>
            <input type="text" class="treatment_prescribtion-input">
            </div>
            <div class="treatment_prescribtion_form-control">
            <label for="remark">Remark</label>
            <input type="text" class="treatment_prescribtion-input">
            </div>
            <div class="treatment_prescribtion_form-control">
            <label for="qty">Qty</label>
            <input type="text" class="treatment_prescribtion-input">
            </div>
            <div class="treatment_prescribtion_form-control">
            <label for="cost">Cost</label>
            <input type="number" class="treatment_prescribtion-input">
            </div>
            <i class="fa fa-window-close" id="prescribe_close"></i>
            <!---Second Sec--->
            <div class="treatment_prescribtion_form-control">
            <label for="drugs">Drugs</label>
            <input type="text" class="treatment_prescribtion-input_change_width">
            </div>
            <div class="treatment_prescribtion_form-control">
            <label for="strength">Strength</label>
            <input type="text" class="treatment_prescribtion-input">
            </div>
            <div class="treatment_prescribtion_form-control">
            <label for="mode">Mode</label>
            <select name="mode" id="mode" class="treatment_prescribtion-input">
                <option value="injection">Injection</option>
                <option value="capsule">Capsule</option>
            </select>
            </div>
            <div class="treatment_prescribtion_form-control">
            <label for="dos">Dos</label>
            <input type="number" class="treatment_prescribtion-input">
            </div>
            <div class="treatment_prescribtion_form-control">
            <label for="unit">Unit</label>
            <select name="unit" id="unit" class="treatment_prescribtion-input">
                <option value=""></option>
                <option value=""></option>
            </select>
            </div>
            <div class="treatment_prescribtion_form-control">
            <label for="frequency">Frequency</label>
            <select name="frequency" id="frequency" class="treatment_prescribtion-input">
                <option value="hours">24 hourly</option>
                <option value="others">others</option>
            </select>
            </div>
            <div class="treatment_prescribtion_form-control">
            <label for="duration">Duration</label>
            <input type="text" class="treatment_prescribtion-input" id="duration">
            </div>
            <div class="treatment_prescribtion_form-control">
            <label for="remark">Remark</label>
            <input type="text" class="treatment_prescribtion-input" id="remark">
            </div>
            <div class="treatment_prescribtion_form-control">
            <label for="qty">Qty</label>
            <input type="text" class="treatment_prescribtion-input" id="qty">
            </div>
            <div class="treatment_prescribtion_form-control">
            <label for="cost">Cost</label>
            <input type="number" class="treatment_prescribtion-input" id="cost">
            </div>
            <button id="btn_prescribe">Prescribe</button>      
        </div>
        </form>
        <button id="btn" class="save">Enter</button>
   </div>
   </div>
   </div>
  </div>
  </div>
  </div>
  <div class="overlay hidden"></div>
  <script src="dashboard.js"> </script>
</body>
</html>

