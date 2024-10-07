<?php include '../backend/config/connection.php';?>
<?php include '../config/doctor-session-validation.php';?>



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
    


    $fetch_status = $callclass->_get_status_details($conn, $status_id);
    $status_array = json_decode($fetch_status, true);
    
    ?>



<?php
    $fetch_appointment = $callclass->_get_appointment_details($conn, $doctor_id);
    $doctor_appointment_array = json_decode($fetch_appointment, true);

    // Check if decoding was successful
    if ($doctor_appointment_array !== null) {
        // Access values from the decoded array
        $apatient_name = $doctor_appointment_array[0]['patient_name'];
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
<link rel="stylesheet" href="css/icons-1.10.2/font/bootstrap-icons.css">
<?php include 'meta.php'?>
</head>
<body>
<script>
new Def.Autocompleter.Search('icd9dx', 'https://clinicaltables.nlm.nih.gov/api/icd9cm_dx/v3/search',
{tableFormat: true, valueCols: [0], colHeaders: ['Code', 'Name']});  

</script>



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
            <img id="image_profile_account" src="<?php echo $website_url ?>/doctor/images/doctor2.jpg" alt="">
            <span><?php echo $fullname ?></span>
           </div>

            <div class="image">
            <img src="<?php echo $website_url ?>/doctor/images/doctor2.jpg" alt="userImage"/>
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
            <li onclick="pendingTransaction()" class="active scaleup" id="links">
            <i class="bi bi-clock"></i>
            <span>Appoitments</span>
            </li>
            <li onclick="document.getElementById('logoutform').submit();" class="scaleup" id="links">
              <i class="fa-solid fa-right-from-bracket"></i>
              <span>Logout</span>
              <form method="post" action="../config/code.php" id="logoutform">
                <input type="hidden" name="action" value="logout" />
              </form>
            </li>
          </ul>
              </div>
            </div>






    <div class="list_div">
        <div class="patient_list_div" >
        <div class="search_bar_container">
                <h3>Appoitment details</h3>  
                    <input type="text" placeholder="Search here" id="incomingSearchInput">
                </div>
                <div class="body_sec" id="appointmentDetailsContainer">
                    <?php 
                    $s_doctor_id_escaped = $conn->real_escape_string($s_doctor_id);
                   
                // SQL query to join doctor_appointment_tab with patient_tab to get appointment and patient details
                $sql = "SELECT doctor_appointment_tab.*, patient_tab.patient_passport 
                FROM doctor_appointment_tab
                JOIN patient_tab ON doctor_appointment_tab.patient_id = patient_tab.patient_id
                WHERE doctor_appointment_tab.doctor_id = '$s_doctor_id_escaped'";
        
        $result = $conn->query($sql);
                    ?>

    <table id="appointment_table">
        <thead>
            <tr>
                <td>S/N</td>
                <td>PASSPORT</td>
                <td>Patient Name</td>
                <td>Patient ID</td>
                <td>Date</td>
                <td>Time</td>
                <td>Request Type</td>
                <td>Accept</td>
                <td>Reject</td>
            </tr>
        </thead>
        <tbody>
            <?php
           
            $appointmentCount = 0; // Initialize appointment count
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $appointmentCount++; // Increment appointment count for each row
                    echo "<tr>";
                    echo "<td>" . $appointmentCount . "</td>"; // Display appointment count
                    echo "<td><img src='" . htmlspecialchars($website_url . "/uploaded_files/profile_pix/patient/" . $row["patient_passport"]) . "' alt='Profile Picture' width='50' height='50'/></td>";
                    echo "<td>" . htmlspecialchars($row["patient_name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["patient_id"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["doctor_appointment_date"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["time"]) . "</td>";
                    // echo "<td>" . htmlspecialchars($row["time"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["reason"]) . "</td>";
                    echo "<td>";
                    ?>
                    <button class="bg-white" type="button" onclick="accept('<?php echo htmlspecialchars($row["patient_id"]); ?>')">Accept</button>
                    <?php
                    echo "</td>";
                    echo "<td>";
                    ?>
                    <button class="bg-white" type="button" onclick="reject('<?php echo htmlspecialchars($row["patient_id"]); ?>')">Reject</button>
                    <?php
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <script>
let messageContainer = document.createElement('div');
document.body.appendChild(messageContainer);

const createAlertMessage = (text, className, duration = 5000) => {
  const message = document.createElement('div');
  message.className = className + ' alert';
  message.innerHTML = `
    <div class="content">
      <div class="message">
        <div class="icon">
          <i class="bi bi-exclamation-triangle-fill bootsrapIcon"></i>
        </div>
        <h4 style="color:white">${text}</h4>
      </div>
    </div>
  `;
  messageContainer.appendChild(message);
  
  if (duration !== 0) {
    setTimeout(() => {
      message.classList.add('hide');
      setTimeout(() => message.remove(), 500);
    }, duration);
  }
  
  return message;
};

const successMessage = (text) => createAlertMessage(text, 'success');
const infoMessage = (text) => createAlertMessage(text, 'info');
const warningMessage = (text) => createAlertMessage(text, 'warning');
const dangerMessage = (text) => createAlertMessage(text, 'danger', 4000);

const acceptMessage = document.createElement('div');
acceptMessage.className = 'alert info';
acceptMessage.innerHTML = `
  <div style="display:flex; flex-direction:column; align-items:center;">
    <h3 style="color:white">Do you want to accept this patient?</h3>
    <div style="display:flex; gap:10px; margin-top:10px;">
      <button class="bg-white" id="accept__patient">Accept patient</button>
      <button class="bg-white" id="reject__patient">Reject patient</button>
    </div>
  </div>
`;
messageContainer.appendChild(acceptMessage);
acceptMessage.style.display = 'none';

// Main accept function with AJAX request
function accept(patient_Id) {
  // Show the acceptMessage popup when the user clicks "Accept"
  acceptMessage.style.display = 'block';
  
  // Handle the "Accept patient" button click
  document.getElementById('accept__patient').addEventListener('click', function() {
    // Hide the acceptMessage popup
    acceptMessage.style.display = 'none';
    successMessage('Patient Accepted')
    
    // Proceed with accepting the patient (AJAX request)
    $('.all_sections_input').fadeIn(500);
    
    var dataString = 'patient_Id=' + patient_Id;

    $.ajax({
      type: "POST",
      url: 'config/display.php',
      data: dataString,
      cache: false,
      success: function(html) {
        $('.search_bar_container').addClass('hide');
        $('.all_sections_input').html(html);

        // Hide appointment details container
        var container = document.getElementById('appointmentDetailsContainer');
        container.style.display = "none";

        // Remove 'hide' class from .all_sections_input
        var hidden = document.querySelector(".all_sections_input");
        hidden.classList.remove("hide");
      }
    });
  });

  // Handle the "Reject patient" button click
  document.getElementById('reject__patient').addEventListener('click', function() {
    // Hide the acceptMessage popup and refresh the page
    acceptMessage.style.display = 'none';
    location.reload(); // Refresh the page
  });
}

// Mockup of confirmDialog function (since it's not provided)
function confirmDialog(message, onConfirm) {
  if (confirm(message)) {
    onConfirm();
  }
}




                    function reject(patient_Id) {
                        // delete_input(patient_Id);
                        dangerMessage(`Rejected patient with ID: ${patient_Id}`);

                    }

                   
                </script>
</div>
            
            <div class="all_sections_input hidden"></div>

                <!----Start from here-->
               
        </div>
        
    </div>
</div>
<div class="black--background hidden"></div>
  


</body>
</html>

