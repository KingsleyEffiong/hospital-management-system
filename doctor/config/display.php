
<?php include "../../backend/config/connection.php";



$patient_id = $_POST['patient_Id'];

 

    // Fetch patient details using your _get_patient_details function
    $fetch_patient_profile = $callclass->_get_patient_details($conn, $patient_id);

    // Decode the JSON response
    $patient_profile_array = json_decode($fetch_patient_profile, true);

    if ($patient_profile_array) {
        // Extract patient details from the response
        $sn = $patient_profile_array['sn'];
        $patient_name = $patient_profile_array['fullname'];
        $email = $patient_profile_array['email'];
        $gender = $patient_profile_array['gender'];
        $dateofbirth = $patient_profile_array['dateofbirth'];
        $address = $patient_profile_array['address'];
        $phonenumber = $patient_profile_array['phonenumber'];
        $status_id = $patient_profile_array['status_id'];
        $category_id = $patient_profile_array['category_id'];
        $date = $patient_profile_array['date'];
        $last_login = $patient_profile_array['last_login'];
        $passport = $patient_profile_array['patient_passport'];
        ///next of kin
        $kname = $patient_profile_array['kname'];
        $kgender = $patient_profile_array['kgender'];
        $kphonenumber = $patient_profile_array['kphonenumber'];
        $krelationship = $patient_profile_array['krelationship'];
        $kaddress = $patient_profile_array['kaddress'];

        $occupation = $patient_profile_array['occupation'];
        $past_obsterics = $patient_profile_array['past_obsterics'];
        $medical_history = $patient_profile_array['medical_history'];
        $sexual_history = $patient_profile_array['sexual_history'];
        $past_disease = $patient_profile_array['past_disease'];
        $family_disease = $patient_profile_array['family_disease'];
        $past_surgery = $patient_profile_array['past_surgery'];

        // // Prepare the HTML content to be sent back as the response
        // $html_response = '<div class="all_sections_input">';
        // // Construct HTML content with patient details
        // // ...
        // $html_response .= '</div>';

        // // Send the HTML response back to the client
        // echo $html_response;
    } else {
        // Send an error message back if patient details not found
        echo '<p>Error: Patient details not found</p>';
    }


?>



     <!----Start from here-->
   <div class="all_sections_input">
    <!---PATIENT PERSONAL INFO-->
   <div class="info_dropdown"    onclick="personal_info_section()">
    <h3>Personal Information</h3>
    
        <i class="bi bi-plus-lg" id="info_icon_plus"></i>
    <i class="bi bi-dash-lg" id="info_icon_minus"></i>
   </div>
   <div class="info_section hide">
    <img src="<?php echo ($website_url . "/uploaded_files/profile_pix/patient/" . $passport); ?>" alt="Profile Picture"  style="border-radius: 100%;
  height: 200px;
  width: 200px;" />

            <h3 style="background:white; color:rgb(42, 87, 215); padding:1rem; width:fit-content; border-radius: 999px; box-shadow: rgb(42, 87, 215) 0 10px 20px -10px;">Bio Data</h3>
    <div class="personal_info_section">
        <h4>Name: <?php echo $patient_name ?></h4>
        <h4>Gender: <?php echo $gender ?></h4>
        <h4>Date of Birth: <?php echo $dateofbirth ?></h4>
        <h4>Home Address: <?php echo $address ?></h4>
        <h4>Phone Number: <?php echo $phonenumber ?></h4>
    </div>

            <h3 style="background:white; color:rgb(42, 87, 215); padding:1rem; width:fit-content; border-radius: 999px; box-shadow: rgb(42, 87, 215) 0 10px 20px -10px;">Next of Kins Bio Data</h3>
     <div class="personal_info_section">
        <h4>Name: <?php echo $kname ?></h4>
        <h4>Gender: <?php echo $kgender ?></h4>
        <h4>Home Address: <?php echo $kaddress ?></h4>
        <h4>Phone Number: <?php echo $kphonenumber ?></h4>
        <h4>Relationship: <?php echo $krelationship ?></h4>
    </div>

    <div class="personal_info_section">
        <h3 style="background:white; color:rgb(42, 87, 215); padding:1rem; width:fit-content; border-radius: 999px; box-shadow: rgb(42, 87, 215) 0 10px 20px -10px;">Social Info</h3>
        <h4>Occupation: <?php echo $occupation ?></h4>
    </div>

    <div class="personal_info_section">
        <h3 style="background:white; color:rgb(42, 87, 215); padding:1rem; width:fit-content; border-radius: 999px; box-shadow: rgb(42, 87, 215) 0 10px 20px -10px;">Past Obsterics</h3>
        <h4><?php echo $past_obsterics ?></h4>
    </div>  

    <div class="personal_info_section">
        <h3 style="background:white; color:rgb(42, 87, 215); padding:1rem; width:fit-content; border-radius: 999px; box-shadow: rgb(42, 87, 215) 0 10px 20px -10px;">Medical History</h3>
        <h4><?php echo $medical_history ?></h4>
    </div>

    <div class="personal_info_section">
        <h3 style="background:white; color:rgb(42, 87, 215); padding:1rem; width:fit-content; border-radius: 999px; box-shadow: rgb(42, 87, 215) 0 10px 20px -10px;">Sexual History</h3>
        <h4><?php echo $sexual_history ?></h4>
    </div>

    <div class="personal_info_section">
        <h3 style="background:white; color:rgb(42, 87, 215); padding:1rem; width:fit-content; border-radius: 999px; box-shadow: rgb(42, 87, 215) 0 10px 20px -10px;">Past Diesase</h3>
        <h4><?php echo $past_disease ?></h4>
    </div>

    <div class="personal_info_section">
        <h3 style="background:white; color:rgb(42, 87, 215); padding:1rem; width:fit-content; border-radius: 999px; box-shadow: rgb(42, 87, 215) 0 10px 20px -10px;">Family Diesase</h3>
        <h4><?php echo $family_disease ?></h4>
    </div>

    <div class="personal_info_section">
        <h3 style="background:white; color:rgb(42, 87, 215); padding:1rem; width:fit-content; border-radius: 999px; box-shadow: rgb(42, 87, 215) 0 10px 20px -10px;">Past Surgery</h3>
        <h4><?php echo $past_surgery ?></h4>
   </div>
   </div>
 

   <!---LABOURATORY INFORMATIONS--->
   <div class="lab_dropdown" onclick="lab_section()">
    <h3>Labouratory Information</h3>
    <i class="bi bi-plus-lg" id="lab_icon_plus"></i>
    <i class="bi bi-dash-lg" id="lab_icon_minus"></i>
    </div>
    <div class="lab_section hide">
            <table>
                <thead>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Kind of Test</td>
                    <td>Test Specific</td>
                    <td>Test Result</td>
                </thead>
                <tbody>
                    <td>22-09-2024</td>
                    <td>3:30PM</td>
                    <td>Immunoassay Single Tests</td>
                    <td>
                        <p> Drug Screening Test</p>
                        <p> Digoxin Test</p>
                    </td>
                    <td>
                    <i class="bi bi-download" style="color:white"></i>
                    </td>
                </tbody>
            </table>
          
    </div>


     <!---LABOURATORY INFORMATIONS--->
   <div class="surgery_dropdown" onclick="surgery_section()">
    <h3>Surgery Information</h3>
    <i class="bi bi-plus-lg" id="surgery_icon_plus"></i>
    <i class="bi bi-dash-lg" id="surgery_icon_minus"></i>
    </div>
    <div class="surgery_section hide">
            <table>
                <thead>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Type of Surgery</td>
                    <td>Surgery Result</td>
                </thead>
                <tbody>
                    <td>22-09-2024</td>
                    <td>3:30PM</td>
                    <td>Lorem ipsum dolor</td>
                    <td>
                    <i class="bi bi-download" style="color:white"></i>
                    </td>
                </tbody>
            </table>
          
    </div>
 
   <!---RADIOLOGY INFORMATIONS--->
   <div class="radiology_dropdown" onclick="radiology_section()">
    <h3>Radiology Information</h3>
    <i class="bi bi-plus-lg" id="radiology_icon_plus"></i>
    <i class="bi bi-dash-lg" id="radiology_icon_minus"></i>
    </div>
    <div class="radiology_section hide">
    <table>
                <thead>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Kind of Scan</td>
                    <td>Test Specific</td>
                    <td>Scan Result</td>
                </thead>
                <tbody>
                    <td>22-09-2024</td>
                    <td>3:30PM</td>
                    <td>X-ray (Radiography)</td>
                    <td>
                        <p> Chest X-ray (CXR)</p>
                    </td>
                    <td>
                    <i class="bi bi-download" style="color:white"></i>
                    </td>
                </tbody>
            </table>
    </div>
   <!---NURSES VITAL INFORMATIONS--->
   <div class="vitals_dropdown" onclick="vitals_section()">
    <h3>Vitals Information</h3>
    <i class="bi bi-plus-lg" id="vitals_icon_plus"></i>
    <i class="bi bi-dash-lg" id="vitals_icon_minus"></i>
    </div>
    <div class="vitals_section hide">
    <?php
    // Assuming you have a valid database connection $conn
    // Replace $patient_id with the actual variable containing the patient ID
     // Replace this with the actual patient ID variable
    
    // Escape the patient_id to prevent SQL injection
    $patient_id_escaped = $conn->real_escape_string($patient_id);

    // Query to select vital signs for the given patient_id
    $sql = "SELECT * FROM patient_vital_tab WHERE patient_id = '$patient_id_escaped'";
    
    // Execute the query
    $result = $conn->query($sql);

    if ($result === false) {
        die('Query failed: ' . htmlspecialchars($conn->error));
    }
    ?>

    <table>
        <thead>
            <tr>
                <td>24/7</td>
                <td>Temp(C)</td>
                <td>BP(mmdg)</td>
                <td>Pulse(bp/m)</td>
                <td>Resp.(cm)</td>
                <td>Spo2(%)</td>
                <td>Weight(kg)</td>
                <td>Intake(m/s)</td>
                <td>Output</td>
                <td>BMI</td>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are rows returned
            if ($result->num_rows > 0) {
                // Loop through each row in the result set
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                   
                    echo "<td>" . htmlspecialchars($row["date"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["temperature"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["bp"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["pulse"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["respiratory"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["spo2"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["weight"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["intake"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["output"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["bmi"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                // Display a message if no data is found
                echo "<tr><td colspan='10'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
  

    <!--Start of the complaint section--->
    <div class="doctor__input">
    <form action="" method="post" enctype="multipart/form-data">
  <!--Start of Physica, Examination-->
        <div class="physical_dropdown"onclick="physical_section()">
            <h3>Physical Examination</h3>
            <i class="bi bi-plus-lg" id="physical_icon_plus"></i>
            <i class="bi bi-dash-lg" id="physical_icon_minus"></i>
        </div>
        <div class="physical_examination-section hidden">
                <div class="physical_examination_drop-down1" onclick="physical_showForm1()">
                    <h3>General</h3>
                    <i class="bi bi-dash-lg" id="physical_examination_icon_minus1"></i>
                    <i class="bi bi-plus-lg" id="physical_examination_icon_plus1"></i>
                </div>
                <div  class="physical_examination_form1 hidden">
                    <div class="physical_examination_form-control">
                    <label for="physical_examination">Physical Examination</label>
                    <input type="text" id="physical_examination" value="">
        </div>
        </div>
        <div class="physical_examination_drop-down2"onclick="physical_showForm2()" >
                    <h3>Skin Examination</h3>
                    <i class="bi bi-dash-lg" id="physical_examination_icon_minus2"></i>
                    <i class="bi bi-plus-lg" id="physical_examination_icon_plus2"></i>
                </div>
                <div class="physical_examination_form2 hidden">
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
                    <input type="text" id="lesions_rashes">
                    </div>
                    <div class="physical_examination_form-control">
                    <label for="bruising">Brusing/Petechiae</label>
                    <input type="text" id="bruising">
                    </div>
                    <div class="physical_examination_form-control">
                    <label for="scars">Scars/Surgical Incisions</label>
                    <input type="text" id="scars">
                    </div>
        </div>
        <div class="physical_examination_drop-down3" onclick="physical_showForm3()">
                    <h3>Social and Family History</h3>
                    <i class="bi bi-dash-lg" id="physical_examination_icon_minus3"></i>
                    <i class="bi bi-plus-lg" id="physical_examination_icon_plus3"></i>
                </div>
                <div  class="physical_examination_form3 hidden">
                    <div class="physical_examination_form-control">
                    <label for="social_habits(smoking,alcohol,drugs)">Social Habits (smoking, alcohol)</label>
                    <input type="text" id="social_habits">
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
        </div>
            </div>
            <!--End of Physica, Examination-->


        <!--Start for Treatment and Prescribtion--->
        <div class="treatment_prescribtion_dropdown" onclick="treatment_prescribtion_section()">
            <h3>Treatment & Prescription</h3>
            <i class="bi bi-plus-lg" id="treatment_prescribtion_icon_plus"></i>
            <i class="bi bi-dash-lg" id="treatment_prescribtion_minus"></i>
        </div>
        <div class="treatment_prescribtion-section hidden">
                <div  class="treatment_prescribtion_form1">
                <div class="treatment_prescribtion_flexs">
                    <div class="treatment_prescribtion_form-control">
                    <label for="medicine">Store</label>
                <select name="" id="treatment_prescribtion" class="treatment_prescribtion-input" >
                    <option value="">Pharmacy 1</option>
                    <option value="">Pharmacy 2</option>
                </select>
                    </div>
                    <div class="treatment_prescribtion_form-control">
                    <label for="medicine">Medicine</label>
                    <input type="text" class="treatment_prescribtion-input" id="drugs">
                    </div>
                    <div class="treatment_prescribtion_form-control">
                    <label for="strength">Strength</label>
                    <input type="text" class="treatment_prescribtion-input" id="strength">
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
                    <input type="text" class="treatment_prescribtion-input" id="dos"> 
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
                </div>
            </div>
            </div>

        <div class="complain_dropdown" onclick="complain_section()">
            <h3>Complaints</h3>
            <i class="bi bi-plus-lg" id="complaint_icon_plus"></i>
            <i class="bi bi-dash-lg" id="complaint_icon_minus"></i>
        </div>
        <div class="complaint-section hidden">
        <div class="each_sections">
                    <div class="form-control">
                    <label for="major_complaints">Major Complaints & Duration</label>
                    <input type="text"  class="complaint-input" id="major_complaints">
                    </div>
                    <div class="form-control">
                    <label for="history_of_presenting_complaints">History of Presenting Complaints</label>
                    <input type="text" class="complaint-input" id="history_of_presenting_complaints">
                    </div>
                    <div class="form-control">
                    <label for="family_social_history">Family & Social History</label>
                    <input type="text" class="complaint-input" id="family_social_history">
                    </div>
                    <div class="form-control">
                    <label for="past_sugical_medical_history">Past Surgical/Medical History</label>
                    <input type="text"  class="complaint-input" id="past_sugical_medical_history">
                    </div>
                        <div class="form-control" onchange='saveOppositeGender()'>
                <label for="gender">Admit Patient?</label>
                <div class="radio-group">
              <label>
                  Yes
                  <input type="radio" name="gender" value="male" id="maleCheckbox">
                  <span class="custom-radio"></span>
              </label>
              <label>
                  No
                  <input type="radio" name="gender" value="female" id="femaleCheckbox">
                  <span class="custom-radio"></span>
              </label>
            </div>
        </div>
        </div>
        </div>

                    <!--End of the complaint section--->

                    <!--Start of the System & Review section--->
                    <div class="system_dropdown" onclick="system_review_section()">
            <h3>System Review and Symptom</h3>
            <i class="bi bi-plus-lg" id="system_icon_plus"></i>
            <i class="bi bi-dash-lg" id="system_icon_minus"></i>
        </div>
                    <div class="system_review-section hidden">
                <div class="drop-down1" onclick="showForm1()">
                    <h3>General</h3>
                    <i class="bi bi-dash-lg" id="close_id_1"></i>
                    <i class="bi bi-plus-lg" id="open_id_1"></i>
                </div>

             <div class="form1 hidden">
                <div class="form-control">
                        <label for="gender">Headache</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="h1"/>
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="h1" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                      <div class="form-control">
                        <label for="gender">Fatigue</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="f1" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="f1" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                     <div class="form-control">
                        <label for="gender">Overall Weekness</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="o1" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="o1" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                    <div class="form-control">
                        <label for="gender">Change in appetite</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="ca1" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="ca1" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                    <div class="form-control">
                        <label for="gender">Change in weight</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="cw1" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="cw1" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>


                     <div class="form-control">
                        <label for="gender">Change in weight</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="fv1" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="fv1" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>
                    </div>
                    
            <div class="drop-down2" onclick="showForm2()">
                    <h3>Skin</h3>
                    <i class="bi bi-dash-lg" id="close_id_2"></i>
                    <i class="bi bi-plus-lg" id="open_id_2"></i>
                </div>
                <div class="form2 hidden">
                    <div class="form-control">
                        <label for="gender">Change in mole(s)</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="cm" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="cm" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                     <div class="form-control">
                        <label for="gender">Hair or nail changes</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="h/n" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="h/n" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                      <div class="form-control">
                        <label for="gender">Color or texture change</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="c/t" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="c/t" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                    <div class="form-control">
                        <label for="gender">Itching or Rashes</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="i/r" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="i/r" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                   <div class="form-control">
                        <label for="gender">Sores</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="sores" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="sores" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>
                    </div>


                 <div class="drop-down3" onclick="showForm3()">
                    <h3>Endocrine</h3>
                    <i class="bi bi-dash-lg" id="close_id_3"></i>
                    <i class="bi bi-plus-lg" id="open_id_3"></i>
                </div>
                <div class="form3 hidden">
                    <div class="form-control">
                        <label for="gender">Enlarging glove or hat size</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="e_hs" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="e_hs" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                    <div class="form-control">
                        <label for="gender">Excessive thirst</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="et" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="et" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                    <div class="form-control">
                        <label for="gender">Salt craving</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="salt_craving" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="salt_craving" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                    <div class="form-control">
                        <label for="gender">Lost of Sexual drive (libido)</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="lsd" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="lsd" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                    <div class="form-control">
                        <label for="gender">Heat or cold intolerance</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="hci" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="hci" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                        <div class="form-control">
                        <label for="gender">Thyriod enlargement</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="te" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="te" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                    <div class="form-control">
                        <label for="gender">Abnormal growth</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="ag"/>
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="ag"/>
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                    <div class="form-control">
                        <label for="gender">Increased appetite</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="ia"/>
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="ia"/>
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>
    
                 <div class="form-control">
                        <label for="gender">Increased urine production</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="iup"/>
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="iup"/>
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                    <div class="form-control">
                        <label for="gender">Thyriod trouble</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="tr"/>
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="tr"/>
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                     <div class="form-control">
                        <label for="gender">Excessive swearing</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="es"/>
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="es"/>
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                     <div class="form-control">
                        <label for="gender">Diabetes</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="diabetes"/>
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="diabetes"/>
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>
                    </div>

        <div class="drop-down4" onclick="showForm4()">
            <h3>Muscoskeletal</h3>
            <i class="bi bi-dash-lg" id="close_id_4"></i>
            <i class="bi bi-plus-lg" id="open_id_4"></i>
         </div>
        <div class="form4 hidden">
                <div div class="form-control">
                        <label for="gender">Physical therapy</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="pt" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="pt" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                    <div div class="form-control">
                        <label for="gender">Occupational therapy</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="occpt" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="occpt" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                    <div div class="form-control">
                        <label for="gender">Orthopedic consultion</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="oc" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="oc" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                    <div div class="form-control">
                        <label for="gender">Pain medication</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="pm" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="pm" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                 <div div class="form-control">
                        <label for="gender">Join aspiration</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="ja" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="ja" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>


                <div class="form-control">
                        <label for="gender">Muscle relaxant</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="mr" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="mr" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                <div class="form-control">
                        <label for="gender">Surgical intervention</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="si"/>
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="si"/>
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                <div class="form-control">
                        <label for="gender">Anti-inflammation</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="anti-in"/>
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="anti-in"/>
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                <div class="form-control">
                        <label for="gender">Assistive</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="assistive"/>
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="assistive"/>
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>
                    </div>


     <div class="drop-down5" onclick="showForm5()">
            <h3>Head & Neck</h3>
            <i class="bi bi-dash-lg" id="close_id_5"></i>
            <i class="bi bi-plus-lg" id="open_id_5"></i>
        </div>
        <div class="form5 hidden">

                <div class="form-control">
                        <label for="gender">Symptom for head and neck issue</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="shni" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="shni" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                <div class="form-control">
                        <label for="gender">Record ear, nose, throat (ENT) exams</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="rente" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="rente" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                <div class="form-control">
                        <label for="gender">Head and neck cancers</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="hnc" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                     <input type="radio" id="no" name="hnc" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                <div class="form-control">
                        <label for="gender">Dental and oral health</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="doh" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="doh" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                    <div class="form-control">
                        <label for="gender">peech and swallowing assesment</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="ssa" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="ssa" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                    <div class="form-control">
                        <label for="gender">Biopsies for neck masses</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="bnm" />
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="bnm" />
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                 <div class="form-control">
                        <label for="gender">Thyriod function tests</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="tft"/>
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="tft"/>
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

              <div class="form-control">
                        <label for="gender">TSalivary gland disorders</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="sgd"/>
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="sgd"/>
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                    <div class="form-control">
                        <label for="gender">TMJ evaluations</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="tmj"/>
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="tmj"/>
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>

                    <div class="form-control">
                        <label for="gender">Imaging for skull and bones</label>
                        <div class="radio-group">
                    <label>
                        Yes
                        <input type="radio" id="yes" name="is_b"/>
                        <span class="custom-radio"></span>
                    </label>
                    <label>
                        No
                        <input type="radio" id="no" name="is_b"/>
                        <span class="custom-radio"></span>
                    </label>
                    </div>
                    </div>
                    </div>
                    </div>
<input type="hidden" id="patient_id" value="<?php echo $patient_id?> ">
<button type="button" class="bg-blue" id="btn" onclick="gatherDoctorInputs()">Save all Inputs</button>
</form>
</div>









<!----------------DIFFERENT SECTION FROM THE PATIENT INPUT, THIS IS FOR TRANSFERING PATIENT --->

                <!--Investigation and procedure-->
                <div class=" investigation_dropdown" onclick="investigation_section()">
    <h3>Investigation and Procedure</h3>
    <i class="bi bi-plus-lg" id="investigation_icon_plus"></i>
    <i class="bi bi-dash-lg" id="investigation_icon_minus"></i>
   </div>
      <div class="investigation-section hidden">
      <div class="advice_form_control_appoitment">
            <button type="button" class="bg-white" onclick="openModalTransferLab()">Transfer to Lab</button>
            <button type="button" class="bg-white" onclick="openModalTransferRad()">Transfer to Radiology</button>
    </div>
</div>

    <div class="modal hidden" id="patient__transfer--lab">
        <button class="btn--close-modal" onclick="closeModal('patient__transfer--lab')">&times;</button>
        <h2 class="modal__header">
            Transfer 
            <span class="highlight">to Labouratory</span>
        </h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="each_sections">
             <div class="form-control">
            <label for="">Patient Name</label>
            <input type="text" value="<?php echo $patient_name?>" name="" id="patient_name">
            </div>
            <div class="form-control">
            <label for="">Patient ID</label>
            <input type="text" value="<?php echo $patient_id?>" name="" id="patient_id">
            </div>
            <div class="form-control">
            <label for="">Message</label>
            <input  type="text" name="" value="" id="message"></input>
            </div>
            </div>
            <button type="button" id="submit_btn" class="bg-blue" onclick="transfer_to_lab()">SUBMIT</button>
        </form>
        </div>


    <div class="modal hidden" id="patient__transfer--rad">
        <button class="btn--close-modal" onclick="closeModal('patient__transfer--rad')">&times;</button>
        <h2 class="modal__header">
            Transfer 
            <span class="highlight">to Radiology</span>
        </h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="each_sections">
             <div class="form-control">
            <label for="">Patient Name</label>
            <input type="text" value="<?php echo $patient_name?>" name="" id="patient_name">
            </div>
            <div class="form-control">
            <label for="">Patient ID</label>
            <input type="text" value="<?php echo $patient_id?>" name="" id="patient_id">
            </div>
            <div class="form-control">
            <label for="">Message</label>
            <input  type="text" name="" value="" id="message2"></input>
            </div>
            </div>
            <button type="button" id="rad_submit_btn" class="bg-blue" onclick="transfer_to_rad()">SUBMIT</button>
        </form>
        </div>

    

           <!-- Advice -->
<div class="advice_dropdown" onclick="advice_section()">
    <h3>Advice</h3>
    <i class="bi bi-plus-lg" id="advice_icon_plus"></i>
    <i class="bi bi-dash-lg" id="advice_icon_minus" class="hidden"></i>
</div>
<div class="advice-section hidden">
    <form action="">
        <div class="form-control">
            <label for="major_complaints">Recommend patient for Surgery</label>
            <div class="checkbox">

                <!-- Checkbox for YES -->
                <div class="checkbox-wrapper-46">
                    <input class="inp-cbx" id="check1" type="checkbox" name="check1" style="display: none;" />
                    <label class="cbx" for="check1">
                        <span>
                            <svg width="12px" height="10px" viewBox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                            </svg>
                        </span>
                        <span>Yes</span>
                    </label>
                </div>

                <!-- Checkbox for NO -->
                <div class="checkbox-wrapper-46">
                    <input class="inp-cbx" id="check2" type="checkbox" name="check2" style="display: none;" />
                    <label class="cbx" for="check2">
                        <span>
                            <svg width="12px" height="10px" viewBox="0 0 12 10">
                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                            </svg>
                        </span>
                        <span>No</span>
                    </label>
                </div>
            </div>
        </div>
    </form>
</div>

    <div class="modal hidden" id="procedure">
        <button class="btn--close-modal" onclick="closeModal('procedure')">&times;</button>
        <h2 class="modal__header">
            Pro 
            <span class="highlight">cedure</span>
        </h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="each_sections">
             <div class="form-control hidden">
            <input type="hidden" value="<?php echo $patient_name?>" name="" id="patient_name">
            </div>
             <div class="form-control">
            <label for="">Procedure</label>
            <input type="text" value="" name="" id="sprocedure">
            </div>
            <div class="form-control">
            <label for="">Phone Number</label>
            <input type="text" value="<?php echo $phonenumber ?>" name="" id="phone_number">
            </div>
            <div class="form-control">
            <label for="">Past Surgery</label>
            <input type="text" value="<?php echo $past_surgery?>" name="" id="past_surgery">
            </div>
            <div class="form-control">
            <label for="">Message</label>
            <input type="text" name="" value="" id="smessage">
            </div>
            </div>
            <button type="button" id="pro_btn" class="bg-blue" onclick="surgical_procedure()">Transfer</button>
        </form>
        </div>


        <!--Diagnosis-->
        <div class="diagnosis_dropdown" onclick="diagnosis_section()">
    <h3>Diagnosis</h3>
    <i class="bi bi-plus-lg" id="diagnosis_icon_plus"></i>
    <i class="bi bi-dash-lg" id="diagnosis_icon_minus"></i>
   </div>
      <div class="diagnosis-section hidden">
        <form action="">
            <div class="form-control">
            <label for="">Attendance</label>
            <input type="text" name="" id="">
            </div>
            <div class="form-control">
            <label for="">Type</label>
            <input type="text" name="" id="">
            </div>
            <div class="form-control">
            <label for="">Categories</label>
            <input type="text" name="" id="">
            </div>
            <div class="form-control">
            <label for="condition">Diagnosis</label>
            <input type="text" id="condition" onkeyup="fetchDiagnoses(this.value)" autocomplete="off">
            <select id="diagnosisDropdown" size="5" style="display:none;" onchange="selectDiagnosis(this.value)">
            </select>
            </div>
        </form>
        <button class="bg-white">Enter</button>
        </div>
        <!--Refer to doctor-->
        <div class="refer_doc_dropdown" onclick="refer_doc_section()">
    <h3>Refer to Doctor</h3>
    <i class="bi bi-plus-lg" id="refer_doc_icon_plus"></i>
    <i class="bi bi-dash-lg" id="refer_doc_icon_minus"></i>
   </div>
      <div class="refer_doc-section hidden">
      <button type="button" class="bg-white" onclick="tranfer_patient_doc()">Transfer to Doctor</button>
        </div>
    
    <div class="modal hidden" id="available--doc">
        <button class="btn--close-modal" onclick="closeModal('available--doc')">&times;</button>
        <h2 class="modal__header">
            Transfer 
            <span class="highlight">to selected doctor</span>
        </h2>
        <form action="" >
            <div class="each_sections">
           <div class="form-control">
            <label for="av-roles">Specialties</label>
            <select name="roles" id="roles">
                <option value="">Select</option>
            </select>
            </div>
            <div class="form-control">
            <label for="">Name</label>
            <select name="doctors" id ="doctor" >
                <option id ="doctor_id"></option>
            </select>
            </div>
            <div class="form-control">
            <label for="">Remark</label>
            <input type="text" name="" id="remark" value=""></input>
            <input type="hidden" name="" id="doctor_id2"  value="">
            <input type="hidden" name="" id="patient_id"  value="<?php echo $patient_id ?>">
            <input type="hidden" name="" id="patient_name"  value="<?php echo $patient_name ?>">
            </div>
            </div>
            <button type="button" id='transfer_to_doctor_btn' class="bg-blue" onclick="transfer_to_doctor();">SUBMIT</button>
        </form>
        </div>



        <!--Discharge Section--->
        <div class="discharged_dropdown" onclick="discharged_section()">
    <h3>Discharged</h3>
    <i class="bi bi-plus-lg" id="discharged_icon_plus"></i>
    <i class="bi bi-dash-lg" id="discharged_icon_minus"></i>
   </div>
   <div class="discharged-section hidden">
    <div class="off_on_button ">
        <i class="bi bi-toggle-off" id="discharge_off" onClick="toogle_on_discharged()"></i>
        <i class="bi bi-toggle-on" id="discharge_on" onClick="toogle_off_discharged()"></i>
        </div>
            <div class="discharge_form hidden">
        <form action="" method="post" enctype="multipart/form-data">
             <div class="form_control">
                <label for="">Date of Discharge</label>
            <input type="date" id="discharged_date">
            </div> 
             <div class="form_control">
                <label for="">Time of Discharge</label>
            <input type="time" id="discharged_time">
            </div> 
             <div class="form_control">
                <label for="">Message</label><br/>
                <textarea name="" id="discharge_message" cols="20" rows="5" ></textarea>
                <input type="hidden" name="" id="patient_id"  value="<?php echo $patient_id ?>">
                <input type="hidden" name="" id="patient_name"  value="<?php echo $patient_name ?>">
                <input type="hidden" id ='sdoctor_id' value="<?php echo $s_doctor_id?>">
            </div> 
            <button type="button" class="bg-white" onclick="confirm_discharge();" id="btn_save_discharge">Comfirm Discharge</button>
        </form>
        </div>
   </div>
        <!--Discharge Section--->
        <div class="confirmed_death_dropdown" onclick="confirmed_death_section()">
    <h3>Confirmed Death</h3>
    <i class="bi bi-plus-lg" id="confirmed_death_icon_plus"></i>
    <i class="bi bi-dash-lg" id="confirmed_death_icon_minus"></i>
   </div>
   <div class="confirmed_death-section hidden">
   <div class="off_on_button ">
        <i class="bi bi-toggle-off" id="confirmed_death_off" onClick="toogle_on_confirmed_death()"></i>
        <i class="bi bi-toggle-on" id="confirmed_death_on" onclick="toogle_off_confirmed_death()"></i>
        </div>
            <div class="confirmed_death_form hidden">
        <form action="" method="post" enctype="multipart/form-data">
             <div class="form_control">
                <label for="">Date of Death</label>
            <input type="date" id="date_of_death" value="">
            </div> 
             <div class="form_control">
                <label for="">Time of Death</label>
            <input type="time" id="time_of_death" value="">
            </div> 
             <div class="form_control">
                <label for="">Cause of Death</label><br/>
                <textarea name="" id="cause_of_death" cols="20" rows="5" value=""></textarea>
            </div> 
            <input type="hidden" id ='patient_id' value="<?php echo $patient_id?>">
            <input type="hidden" id ='sdoctor_id' value="<?php echo $s_doctor_id?>">
            
            <button type="button" id="btn_save_confirmed_death" class="bg-white" onclick="show_death_form()">Comfirm Dead</button>
        </form>
        </div>
    </div>
 <script>
    </script>
   

 