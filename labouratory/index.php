<?php include '../backend/config/connection.php' ?>
<?php include 'config/lab_scientist-session-validation.php';?>



<?php
    $lab_scientist_id = $_POST['lab_scientist_id'];
?>

    

<?php    

    $fetch_lab_scientist_profile = $callclass->_get_lab_scientist_details($conn, $s_lab_scientist_id);
    $lab_scientist_profile_array = json_decode($fetch_lab_scientist_profile, true);
    $fullname = $lab_scientist_profile_array[0]['lab_scientist_name'];
    $email = $lab_scientist_profile_array[0]['email'];
    $phonenumber = $lab_scientist_profile_array[0]['phonenumber'];
    // $role_id= $lab_scientist_profile_array[0]['role_id'];
    $status_id = $lab_scientist_profile_array[0]['status_id'];
    $date = $lab_scientist_profile_array[0]['date'];
    $last_login = $lab_scientist_profile_array[0]['last_login'];
    $passport = $lab_scientist_profile_array[0]["passport"]; 
    $fetch_status = $callclass->_get_status_details($conn, $status_id);
    $status_array = json_decode($fetch_status, true);
    $status_name = $status_array[0]['status_name'];
?>

<?php 
    $page == "lab_scientist_dash"; // Assign the value "lab_scientist_dash" to the $page variable
?>



<?php 
    


    $fetch_status = $callclass->_get_status_details($conn, $status_id);
    $status_array = json_decode($fetch_status, true);
    
    ?>



<?php
    $fetch_appointment = $callclass->_get_appointment_details($conn, $s_lab_scientist_id);
    $lab_scientist_appointment_array = json_decode($fetch_appointment, true);

    // Check if decoding was successful
    if ($lab_scientist_appointment_array !== null) {
        // Access values from the decoded array
        $apatient_name = $lab_scientist_appointment_array[0]['patient_name'];
        $email = $lab_scientist_appointment_array[0]['email'];
        $phonenumber = $lab_scientist_appointment_array[0]['phonenumber'];
        $role_id = $lab_scientist_appointment_array[0]['role_id'];
        $status_id = $lab_scientist_appointment_array[0]['status_id'];
        $passport = $lab_scientist_appointment_array[0]['passport'];
        $appointment_date = $lab_scientist_appointment_array[0]['appointment_date'];
        $appointment_reason = $lab_scientist_appointment_array[0]['reason'];

        // Now you can use these variables as needed in your code
    } else {
        // Handle the case where decoding failed
        echo "Failed to decode JSON";
    }

?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php include 'meta.php'?>
    <title><?php echo $thename?>  | Labouratory Dashboard</title>
    <meta name="keywords" content="Admin - <?php echo $thename?>" />
    <meta name="description" content="Administrative Login <?php echo $thename?>"/>
    
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

    <div class="navbar">
        <div class="display__date">
        </div>
          <div class="profile">
            <div class="profile_account hide">
            <img id="image_profile_account" src="<?php echo $website_url?>/Images/24b23c44ac34e5a0fb80978cd976604c.jpg" alt="">
            <span>Doc. Henculus White</span>
            <button class="btn_submit">Upload Image</button>
           </div>

            <div class="image">
            <img src="<?php echo $website_url?>/Images/24b23c44ac34e5a0fb80978cd976604c.jpg" alt="userImage"/>
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
        <li class="links active" onclick="appoitment_list_section()">
          <span>Available appoitments</span>
        </li>
        <li class="links" onclick="approved_appoitment__section()">
          <span>Accepted appoitments</span>
        </li>
        <li onclick="document.getElementById('logoutform').submit();" id="logout_link" class="links">
          <span>Logout</span>
          <form method="post" action="../config/code.php" id="logoutform">
            <input type="hidden" name="action" value="logout"/>
          </form>
        </li>
      </ul>
    </div>
  </div>

                 <!--- END OF SIDEBAR AND NAVBAR-->

                 <!--- START OF AVAILABLE APPOITMENT AND APPROVED APPOITMENT SECTION-->
                 <div class="appoitment_section">
            <div class="patient_list_div">
            <div class="search_bar_container">
                <h3>Appoitment details</h3>
                    <input type="text" placeholder="Search here" id="searchInput">
                </div>
                    <table id="patient">
                                            <thead>
                                                <tr>
                                                    <td>S/N</td>
                                                    <td>Patient Name</td>
                                                    <td>PASSPORT</td>
                                                    <td>Patient ID</td>
                                                    <td>Date</td>
                                                    <td>Time</td>
                                                    <td>Accept</td>
                                                    <td>Reject</td>
                                                </tr>
                                            </thead>
                                            <?php 
                                            //$sql = "SELECT * FROM lab_appointment_tab";
                                           
                                            
                                            
                                            $sql = "SELECT lab_appointment_tab.*, patient_tab.patient_passport 
                                            FROM lab_appointment_tab
                                            JOIN patient_tab ON lab_appointment_tab.patient_id = patient_tab.patient_id
                                            WHERE lab_appointment_tab.status_id = '0'";
                                    
                                    $result = $conn->query($sql);
                                    
                                            
                                            
                                            
                                            
                                            
                                            ?>
                                            <tbody>
            <?php $appointmentCount = 0;
             while ($appointment = $result->fetch_assoc()): 
                 
                  $appointmentCount++;
                  ?>
                <tr>
                    <td><?php echo $appointmentCount ?></td>
                    
                    <td><?php echo htmlspecialchars($appointment['patient_name']); ?></td>
                    <td>
                        <img src="<?php echo htmlspecialchars($website_url . '/uploaded_files/profile_pix/patient/' . $appointment['patient_passport']); ?>" alt="Profile Picture" width="50" height="50">
                    </td>
                    <td><?php echo htmlspecialchars($appointment['patient_id']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
                    <td><?php echo htmlspecialchars($appointment['time']); ?></td>
                  
                    <td>
                        <button class="bg-white" type="button" onclick="click_labouratory_examination('<?php echo htmlspecialchars($appointment['patient_id']); ?>', '<?php echo htmlspecialchars($appointment['lab_scientist_appointment_id']); ?>')">Accept</button>

                    </td>
                    <td>
                        <button class="bg-white" type="button" onclick="reject_labouratory_examination(<?php echo htmlspecialchars($appointment['patient_id']),$appointment['lab_scientist_appointment_id']; ?>)">Reject</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <script>
                function click_labouratory_examination(patient_id,appointment_id) {
                    // Use the built-in confirm dialog
                    if (confirm("Are you sure you want to accept this patient?")) {
                        // Show the lab input section
                        var display = document.querySelector('.display');
                        if (display) {
                            display.classList.remove('hidden');
                        }

                        // Construct data string to send in the AJAX request
                        var dataString = 'patient_id=' + encodeURIComponent(patient_id)+'&appointment_id=' + encodeURIComponent(appointment_id);

                        // Perform AJAX request
                        $.ajax({
                            type: "POST", // HTTP method
                            url: 'config/page-content.php', // URL of the PHP script
                            data: dataString, // Data to send with the request
                            cache: false, // Disable caching
                            success: function(html) {
                                // Hide appointment and approved appointment sections
                                document.querySelector('.appoitment_section').classList.add('hide');
                                document.querySelector('.approved_appoitment').classList.add('hide');
                                
                                // Update the lab input section with the received HTML
                                document.querySelector('.display').innerHTML = html;
                            },
                            error: function(xhr, status, error) {
                                console.error('AJAX Error:', error); // Log any error
                                alert("An error occurred: " + error); // Show an alert with the error
                            }
                        });
                    }
                }

        </script>


        <div class="approved_appoitment hide">  
        <div class="patient_list_div">
                    <div class="search_bar_container">
                        <h3>Approved appoitments</h3>
                        <i class="bi bi-search"></i>
                            <input type="text" placeholder="Search here">
                        </div>
                        <table>
                            <?php 
                           $sql = "SELECT account_appointment_confirm_tab.*, patient_tab.patient_passport, patient_tab.fullname 
                           FROM account_appointment_confirm_tab
                           JOIN patient_tab ON account_appointment_confirm_tab.patient_id = patient_tab.patient_id
                           WHERE account_appointment_confirm_tab.`from` = 'Lab'";
                   
                            $result = mysqli_query($conn, $sql);
                   
                            ?>
                            <thead>
                                <tr>
                                    <td>S/N</td>
                                    <td>PASSPORT</td>
                                    <td>Patient Name</td>
                                    <td>Patient ID</td>
                                    <td>Status</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $serial = 1; // Serial number initialization
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Assuming passport image URL is stored in the database
                                    $passportImage = $row['passport_image'] ? $row['passport_image'] : 'path/to/default-image.jpg'; // Default image if none exists
                                    ?>
                                    <tr>
                                        <td><?php echo $serial++; ?></td>
                                        <td>
                                        <img src="<?php echo htmlspecialchars($website_url . '/uploaded_files/profile_pix/patient/' . $row['patient_passport']); ?>" alt="Profile Picture" width="50" height="50">
                                        </td>
                                        <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                                        <td><?php echo htmlspecialchars($row['patient_id']); ?></td>
                                        <td>
                                            <button class="accept-btn" onclick="uploadResult('<?php echo $row['patient_id']; ?>')">Upload Test Result</button>
                                        </td>
                                        <td>
                                            <i class="bi bi-x-square" onclick="deletePatient('<?php echo $row['patient_id']; ?>')"></i>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            </div>
        </div>
   <!--- END OF AVAILABLE APPOITMENT AND APPROVED APPOITMENT SECTION-->

 
<!--- END OF TEST BOOKING SECTION-->



<div class="display "></div>






<!--- START OF TEST RESULT UPLOAD-->
<div class="result hide">
<i class="bi bi-x-square" onclick="closeResult()"></i>
<h3>LABORATORY RESULT</h3>
<div class="profile_div">
<div class="profile_name">
<h3>Kingsley Effiong</h3>
<h3>PAT0002</h3>
</div>
<div class="img_div">
<img src ="../Images/24cc97ebee8475a31c597fdb32b32d3a.jpg"></img>
</img>
</div>
</div>
<div class="result_for_diagnosis_and_complaint_upload">
        <form action="">
        <div class="flex_control">
        <label>Diagnosis</label>
        <input type= "text"></input>
        </div>
        <div class="flex_control">
        <label>Complaints</label>
        <textarea col="10" row="10"></textarea>
        </div>
        <div class="flex_control">
        <label>Upload Test Result</label>
        <input type= "file"></input>
        </div>
        </form>
</div>
<button>Submit</button>
</div> 

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



    function filterAvailablePatient() {
    const tableBody = document.querySelector('#patient tbody');
    const tableRows = Array.from(tableBody.querySelectorAll('tr')); // Convert NodeList to Array
    const searchInput = document.querySelector('#searchInput').value.trim().toLowerCase();

    let hasVisibleRows = false;
    tableRows.forEach((row) => {
        if (row.children.length < 2)  return;

        const patientName = row.children[1].textContent.trim().toLowerCase();
        const patientId = row.children[3].textContent.trim().toLowerCase();
        if (patientName.includes(searchInput) || patientId.includes(searchInput)){
            row.style.display = ''; // Show the row
            hasVisibleRows = true;
           
        } else row.style.display = 'none'; // Hide the row
    });

    const existingNoDataMessage = document.querySelector('#noDataMessage');
    if (existingNoDataMessage) existingNoDataMessage.remove();

    if (!hasVisibleRows) {
        const noDataMessage = document.createElement('tr');
        noDataMessage.id = 'noDataMessage';
        noDataMessage.innerHTML = '<td colspan="9" style="text-align: center;">No User associated with this input</td>';
        tableBody.appendChild(noDataMessage);
    }
}
document.querySelector('#searchInput').addEventListener('input', filterAvailablePatient);
</script>
</body>
</html>
