
function displayUserProfile(){
  document.querySelector(".profile_account").classList.toggle("hide");
};
//////////////////////////////////////////
///////////////////////////////////////
// Modal window
const modal = document.querySelector('.modal');

const overlay = document.createElement('div');
overlay.className = 'overlay';

const openModal = function (modalId) {
  const modal = document.getElementById(modalId);

  overlay.style.opacity = 1;
  document.querySelector('body').appendChild(overlay);
  modal.classList.remove('hidden');
}


const closeModal = function (modalId) {
  const modal = document.getElementById(modalId);
  overlay.style.opacity = 0;
  overlay.classList.add('hidden');
  document.querySelector('body').removeChild(overlay);
  modal.classList.add('hidden');
};
////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////

function createDate(){
const now = new Date();
const options = {
day:'numeric',
month:'numeric',
year:'numeric',
hour:'numeric',
minute:'numeric',
second:'numeric',
}
const dateTime = new Intl.DateTimeFormat(navigator.language, options).format(now)
document.querySelector('.display__date').textContent = dateTime
}
setInterval(() => createDate());
////////////////////////////////////////////////////////////////////
   
   //PERONAL PROFILE SECTION
   function personal_profile_section(){
    document.querySelector(".list_div").classList.add("hide");
    document.querySelector(".patient-profile").classList.remove("hide");
    document.querySelector(".available-patient-list").classList.add("hide");
   }

   function availablePatientList(){
      document.querySelector(".list_div").classList.add("hide");
      document.querySelector(".available-patient-list").classList.remove("hide");
      document.querySelector(".patient-profile").classList.add("hide");
   }
function appoitmentSection(){
   document.querySelector(".list_div").classList.remove("hide");
   document.querySelector(".available-patient-list").classList.add("hide");
   document.querySelector("patient-profile").classList.add("hide");
}

function selectDoc(){
  openModal('patientBooking');
  document.querySelector('.av_doctor_role').classList.remove("hide");
  document.querySelector('.book_patient').classList.add("hide");
  document.querySelector('.modal').style.width = "40%";
}

function bookPatient(){
  $('.av_doctor_role').addClass('hide')
  $('.book_patient').removeClass('hide')
  document.querySelector('.modal').style.width = "70%";
  doctor_id = $()
}

const roles = {
  surgeon: ['Dr. Patrick John', 'Dr. Amanda Smith'],
  healthPractitioner: ['Dr. Isreal Clarke', 'Dr. Issac Newton'],
  dentist: ['Dr. Tomiwa John', 'Dr. Kingsley John', 'Dr. Emmanuel Stone'],
  heartDoctor: ['Dr. Heartbeat', 'Dr. Ventricle', 'Dr. Aorta']
};

function updateDoctors() {
  const roleSelect = document.getElementById('av-roles');
  const doctorSelect = document.getElementById('av-doctors');
  const selectedRole = roleSelect.value;

  data.doctor.forEach(doctor => {
    const option = document.createElement('option');
    // option.setAttribute('id', "doctor_id");
    option.textContent = doctor.fullname;
    option.value = doctor.doctor_id;
  
    doctorSelect.appendChild(option);
  });
}




  ////////////////

  function accept(patient_Id) {
   // Fade in elements with class 'all_sections_input'
   $('.booked-patient-container').fadeIn(500);

   // Construct data string to send in the AJAX request
   var dataString = 'patient_Id=' + patient_Id;

   // Perform AJAX request
   $.ajax({
       type: "POST", // HTTP method
       url: 'config/profile_input.php', // URL of the PHP script
       data: dataString, // Data to send with the request
       cache: false, // Disable caching
       success: function(html) {
        // On success, update content of elements with class 'all_sections_input' with the received HTML
        $('.booked-patient-container').html(html);

  
        // Hide container with ID 'appointmentDetailsContainer'
        var container = document.querySelector('.list_div');
        container.classList.add('hide')

        // Remove 'hide' class from elements with class 'all_sections_input'
        var hidden = document.querySelector('.booked-patient-container');
        hidden.classList.remove("hide");
       }
   });
                   document.addEventListener('click', function(event) {
       console.log('Event type:', event.type); // Output the type of event
       console.log('Event target:', event.target); // Output the target of the event
   });

}



function getWards() {
  $('#wards').html('<option>LOADING...</option>'); // Set loading message
  $('#wards').prop('disabled', true); // Disable the dropdown

  var action = 'getWards';
  var data = { action: action }; // Use an object to define data

  $.ajax({
    type: "POST",
    url: "config/code.php",
    data: data, // Pass the data object directly
    cache: false,
    dataType: 'json',
    success: function (data) {
      // Check for success and populate the dropdown
      if (data.success) {
        populateWardsDropdown(data.wards); // Assuming 'wards' is the key for wards in your response
      } else {
        console.error('Error:', data.message);
      }
    },
    error: function (xhr, status, error) {
      console.error('AJAX Error:', status, error);
    }
  });
}

function populateWardsDropdown(wards) {
  var wardsDropdown = document.getElementById("wards");

  // Clear existing options
  wardsDropdown.innerHTML = '';

  // Add options based on the fetched data
  for (var i = 0; i < wards.length; i++) {
    var option = document.createElement("option");
    option.value = wards[i].ward_id;
    option.id= wards[i].ward_id;
    option.textContent = wards[i].ward_number;
    wardsDropdown.appendChild(option);
  }

  // Enable the dropdown after populating options
  $('#wards').prop('disabled', false);

  // Attach the change event to trigger getBeds when a ward is selected
  $('#wards').on('change', getBeds);
}

function getBeds() {
  $('#beds').html('<option>LOADING...</option>'); // Set loading message
  $('#beds').prop('disabled', true); // Disable the dropdown

  var action = 'getBeds';
  var wards = $('#wards').val();
  var data = { action: action, wards: wards };

  $.ajax({
    type: 'POST',
    url: "config/code.php",
    data: data,
    cache: false,
    dataType: 'json',
    success: function (data) {
      // Check for success and populate the dropdown
      if (data.success) {
        populateBedsDropdown(data.beds); // Pass the entire array of beds
      } else {
        console.error('Error:', data.message);
      }
    },
    error: function (xhr, status, error) {
      console.error('AJAX Error:', status, error);
    },
  });
}

function populateBedsDropdown(beds) {
  var bedsDropdown = document.getElementById('beds');

  // Clear existing options
  bedsDropdown.innerHTML = '';

  // Add options based on the fetched data
  for (var i = 0; i < beds.length; i++) {
    var option = document.createElement('option');
    option.value = beds[i].bed_id; // Assuming the bed object has a 'bed_id' property
    option.id= beds[i].bed_id;

    // Concatenate bed_number and bed_status_description
    var optionText = beds[i].bed_number + " - " + beds[i].bed_description;

    option.textContent = optionText;
    bedsDropdown.appendChild(option);
  }

  // Enable the dropdown after populating options
  $('#beds').prop('disabled', false);
}



function vital_input() {
  // Collect input values
  var patientData = {
    action: "vital_input",
    patient_id: $('#patient_id').val(),
    ward: $('#wards').val(),
    stage: $('#stage').val(),
    bed: $('#beds').val(),
    note: $('#note').val(),
    temperature: $('#temperature').val(),
    bp: $('#bp').val(),
    pulse: $('#pulse').val(),
    respiratory: $('#respiratory').val(),
    weight: $('#weight').val(),
    height: $('#height').val(),
    intake: $('#intake').val(),
    output: $('#output').val(),
    spo2: $('#spo2').val(),
    bmi: $('#bmi').val(),
    body_fat: $('#body_fat').val(),
    muscle_mass: $('#muscle_mass').val(),
    musc: $('#musc').val(), // Consider renaming this for clarity
    resting_metabolism: $('#resting_metabolism').val(),
    body_age: $('#body_age').val(),
    bmi_for_age: $('#bmi_for_age').val(),
    visceral_fat: $('#visceral_fat').val(),
    head_circumference: $('#head_circumference').val(),
    waist_circumference: $('#waist_circumference').val(),
    hip_circumference: $('#hip_circumference').val(),
    w_hr: $('#w_hr').val()
  };

  if (!patientData.patient_id || !patientData.ward || !patientData.stage || 
    !patientData.temperature || !patientData.bp || !patientData.pulse || 
    !patientData.respiratory || !patientData.weight || !patientData.height || 
    !patientData.intake || !patientData.output || !patientData.spo2 || 
    !patientData.bmi || !patientData.body_fat || !patientData.muscle_mass || 
    !patientData.musc || !patientData.resting_metabolism || !patientData.body_age || 
    !patientData.bmi_for_age || !patientData.visceral_fat || !patientData.head_circumference || 
    !patientData.waist_circumference || !patientData.hip_circumference || !patientData.w_hr) {
  alert("Please fill in all required fields.");
  }
  else{

      // Disable the submit button and change text
      var $btnSubmit = $('#btn_submit');
      var btnText = $btnSubmit.html();
      $btnSubmit.html('Processing...');
      $btnSubmit.prop('disabled', true);

      // Send AJAX request
      $.ajax({
        type: 'POST',
        url: "config/code.php",
        data: patientData,
        cache: false,
        dataType: 'json',
        success: function (data) {
          if (data.success) {

            alert("Patient Vital has been updated successfully");
            $btnSubmit.html('Save All...');
            $btnSubmit.prop('disabled', true);
            window.location.reload();
          } else {
            console.error('Error:', data.message);
            $btnSubmit.html(btnText);
            $btnSubmit.prop('disabled', false);
          }
        },
        error: function (xhr, status, error) {
          console.error('AJAX Error:', status, error);
          $btnSubmit.html(btnText);
          $btnSubmit.prop('disabled', false);
        }
      });
  }
}

function getDoctorsRoles() {

  $('#roles').html('<option>LOADING...</option>'); // Set loading message
  $('#roles').prop('disabled', true); // Disable the dropdown

  var action = 'getDoctorsRoles';
  // var wards = $('#roles').val();
  var data = { action: action, roles: roles };

  $.ajax({
    type: 'POST',
    url: "config/code.php",
    data: data,
    cache: false,
    dataType: 'json',
    success: function (data) {
      // Check for success and populate the dropdown
      if (data.success) {
        populaterolesDropdown(data.doctorRoles); // Pass the entire array of roles
      } else {
        console.error('Error:', data.message);
      }
    },
    error: function (xhr, status, error) {
      console.error('AJAX Error:', status, error);
    },
  });
}

function populaterolesDropdown(doctorRoles) {
  var rolesDropdown = document.getElementById('roles');


  // Clear existing options
  rolesDropdown.innerHTML = '';

  // Add options based on the fetched data
  for (var i = 0; i < doctorRoles.length; i++) {
    var option = document.createElement('option');
    option.value = doctorRoles[i].doctor_role_id; // Assuming the bed object has a 'bed_id' property
    option.id= doctorRoles[i].doctor_role_id;

    // Concatenate bed_number and bed_status_description
    var optionText = doctorRoles[i].doctor_role_name;

    option.textContent = optionText;

    rolesDropdown.appendChild(option);
     
  }

  // Enable the dropdown after populating options
  $('#roles').on('change', getDoctors);
  $('#roles').prop('disabled', false);
}






function getDoctors() {
  $('#doctors').html('<option>LOADING...</option>'); // Set loading message
  $('#doctors').prop('disabled', true); // Disable the dropdown

  var action = 'getDoctors';
  var roles = $('#roles').val();
  var data = { action: action, roles: roles };

  $.ajax({
    type: 'POST',
    url: "config/code.php",
    data: data,
    cache: false,
    dataType: 'json',
    success: function (data) {
      // Check for success and populate the dropdown
      if (data.success) {
        populatedoctorDropdown(data.doctor); // Pass the entire array of beds
      } else {
        console.error('Error:', data.message);
      }
    },
    error: function (xhr, status, error) {
      console.error('AJAX Error:', status, error);
    },
  });
}

function populatedoctorDropdown(doctor) {
  var doctorDropdown = document.getElementById('doctor');

  // Clear existing options
  doctorDropdown.innerHTML = '';

  // Add options based on the fetched data
  for (var i = 0; i < doctor.length; i++) {
    var option = document.createElement('option');
    option.value = doctor[i].doctor_id; // Assuming the bed object has a 'bed_id' property

    option.id= "doctor_id";

    // Concatenate bed_number and bed_status_description
    var optionText = doctor[i].fullname;
    $('#doctor_id2').val(doctor[i].doctor_id);

    option.textContent = optionText;
    doctorDropdown.appendChild(option);
   
  }

  // Enable the dropdown after populating options
  $('#doctor').prop('disabled', false);
}













function updateDoctors() {
  const roleSelect = document.getElementById('av-roles');
  const doctorSelect = document.getElementById('av-doctors');
  const selectedRole = roleSelect.value;

  doctorSelect.innerHTML = ''; // Clear existing options
  roles[selectedRole].forEach(doctor => {
      const option = document.createElement('option');
      option.textContent = doctor;
      option.value = doctor.toLowerCase().replace(/ /g, '-'); // Convert name to a slug-like value
      doctorSelect.appendChild(option);
  });
}


function transfer_to_doctor(){

  var patient_id = $('#patient_id').val();
  var patient_name = $('#patient_name').val();
  var date = $('#date').val();
  var time = $('#time').val();
  var reason =$('#reason').val();
  var doctor_id = $('#doctor_id2').val();

  if(patient_id==""||patient_name==""||date==""||time==""||reason==""){
    alert('Fill the required fields');
  }
  else{
    var $btnSubmit = $('#btn-submit');
    var btnText = $btnSubmit.html();
    $btnSubmit.html('Processing...');
    $btnSubmit.prop('disabled', true);

    var action = 'transfer_patient';
    var dataString = "action=" + action + "&patient_id=" + patient_id + "&patient_name=" + patient_name  + "&time=" + time + "&date=" + date +"&reason=" + reason + "&doctor_id=" + doctor_id;
  

    $.ajax({
      type: 'POST',
      url: "config/code.php",
      data: dataString,
      cache: false,
      dataType: 'json',
      success: function (data) {
        if (data.success) {

          alert("Patient Transfer is Successful");
          $btnSubmit.html('BOOK');
          $btnSubmit.prop('disabled', true);
          window.location.reload();
        } else {
          console.error('Error:', data.message);
          $btnSubmit.html(btnText);
          $btnSubmit.prop('disabled', false);
        }
      },
    });
  }
}






function  displayAcceptedNursePatient() {
  var action = 'fetch_appointment_list';
  var staff_id = $('#account_id').val();
  var dataString = "action=" + action + "&staff_id="+ staff_id;
  
  $.ajax({
      type: 'POST',
      url: "config/code.php",
      data: dataString,
      cache: false,
      dataType: 'json', // Expecting a JSON response
      success: function (response) {
          const success = document.querySelector('#success tbody');
          // Clear any existing rows
          success.innerHTML = '';
          if (response.success) {
              const data = response.data;
              // console.log(data)
              if (Array.isArray(data) && data.length > 0) {
                  data.forEach(accepted => {
                      nurse__accepted__patient(accepted);
                  });
              } else {
                  // No transactions found, show "No transaction found" message
                  const noTransactionRow = success.insertRow(0);
                  const noTransactionCell = noTransactionRow.insertCell(0);
                  noTransactionCell.colSpan = 9; // Span across all columns
                  noTransactionCell.innerHTML = 'No accepted appoitment found';
                  noTransactionCell.style.textAlign = 'center';
              }
          } 
          if(response.message === 'No appointments found.'){
              // console.error('Error:', response.message);
              const noTransactionRow = success.insertRow(0);
              const noTransactionCell = noTransactionRow.insertCell(0);
              noTransactionCell.colSpan = 9; // Span across all columns
              noTransactionCell.innerHTML = 'No accepted appoitment found';
              noTransactionCell.style.textAlign = 'center';
          }
          // if(!response.ok){
          //     console.error('Error:', response.message);
          //     const noTransactionRow = success.insertRow(0);
          //     const noTransactionCell = noTransactionRow.insertCell(0);
          //     noTransactionCell.colSpan = 9; // Span across all columns
          //     noTransactionCell.innerHTML = 'Error in the response.';
          //     noTransactionCell.style.textAlign = 'center';
          // }
  },
      error: function (xhr, status, error) {
          console.error('AJAX Error:', error);
          console.log('Response Text:', xhr.responseText);
          alert('AJAX Error: ' + error);
      }
  });
};


$(document).ready(function () {
  displayAcceptedNursePatient();
});

function nurse__accepted__patient(accepted){
  const available__patients = document.querySelector('#available__patients tbody');
  const rowCount = available__patients.rows.length;
  const newRow = available__patients.insertRow(rowCount);

  newRow.insertCell(0).innerHTML = rowCount + 1; // Serial Number (start from 1)
  newRow.insertCell(1).innerHTML = "<img src = ../uploaded_files/profile_pix/patient/"+accepted.patient_passport+">";
  newRow.insertCell(2).innerHTML = accepted.patient_id || 'N/A'; // Patient ID
  newRow.insertCell(3).innerHTML = accepted.account_appointment_id || 'N/A'; // Appointment ID
  newRow.insertCell(4).innerHTML = accepted.time || 'N/A'; // Date & Time
  newRow.insertCell(5).innerHTML = accepted.approved_time || 'N/A'; // Date & Time
}
