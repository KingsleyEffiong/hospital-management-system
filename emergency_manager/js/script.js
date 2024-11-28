    //PROFILE IMAGE
    function displayUserProfile(){
        document.querySelector(".profile_account").classList.toggle("hide");
    };

    const modal = document.querySelector('.modal');
    const blackBackground = document.querySelector('.black--background');




const openModal = function (modalId) {
  const modal = document.getElementById(modalId);
  
  modal.classList.remove('hidden');
  blackBackground.classList.remove('hidden');
};


const closeModal = function (modalId) {
  const modal = document.getElementById(modalId);
  
  modal.classList.add('hidden');
  blackBackground.classList.add('hidden');
};


    
  
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
  setInterval(() => createDate())
/////////////////////////////////////////////////////////////////////////////////////////////////



function createNoDataMessage() {
    const noDataMessage = document.createElement('tr');
    noDataMessage.innerHTML = '<td colspan="7" style="text-align: center;">No data</td>';
    return noDataMessage;
}

function isFormValid(inputs) {
    for (const input of inputs) {
        if (input.value.trim() === '') {
            return false;
        }
    }
    return true;
}

function isInputChecked(selector) {
    const inputElement = document.querySelector(selector);
    if (!inputElement) {
        console.error('No element found with the given selector.');
        return false;
    }
    return inputElement.checked;
 }

    function isPhoneNumberValid(selector) {
        const phoneNumber = document.querySelector(selector).value.trim();
        const isNumeric = /^\d+$/.test(phoneNumber);
        const startsWith090 = phoneNumber.startsWith('090');
        const startsWith081 = phoneNumber.startsWith('081');
        const startsWith080 = phoneNumber.startsWith('080');
        const startsWith091 = phoneNumber.startsWith('091');
        const startsWith442 = phoneNumber.startsWith('442');
        const startsWith070 = phoneNumber.startsWith('070');

        return phoneNumber.length === 11 && isNumeric && startsWith090 || startsWith070 || startsWith081 || startsWith080 || startsWith091 || startsWith442 ;
    }

function showMessage(message, text, backgroundColor) {
    message.className = 'alert_div';
    message.innerHTML = text;
    message.style.backgroundColor = backgroundColor;
    document.querySelector('body').prepend(message);
    setTimeout(() => message.classList.add('hide'), 3000);
}

function removeNoDataMessage(tableBody, noDataMessage) {
    if (tableBody.contains(noDataMessage)) {
        tableBody.removeChild(noDataMessage);
    }
}
function generateId() {
    return`EMG${Math.floor(Math.random() * 1000)}`
}


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
        <h2>${text}</h2>
        </div>
    </div>
  `;
  messageContainer.appendChild(message);
  setTimeout(() => {
    message.classList.add('hide');
    setTimeout(() => message.remove(), 500); 
  }, duration);
  return message;
}

const successMessage = (text) => createAlertMessage(text, 'success');
const infoMessage = (text) => createAlertMessage(text, 'info');
const warningMessage = (text) => createAlertMessage(text, 'warning');
const dangerMessage = (text) => createAlertMessage(text, 'danger', 4000); 




let selectedGender;
function saveOppositeGender() {
    const maleCheckbox = document.getElementById('maleCheckbox');
    const femaleCheckbox = document.getElementById('femaleCheckbox');
    
    if (maleCheckbox.checked) {
        selectedGender = maleCheckbox.value;
    } else if (femaleCheckbox.checked) {
        selectedGender = femaleCheckbox.value;
    }
    
    // console.log(selectedGender);
}

   
/////emergency

    function EmergencyPatient() {
    const emergencyInputData = document.querySelectorAll('#emergencyInputData .emergencyInput');

    if (!isFormValid(emergencyInputData)) {
        warningMessage('Please fill in all required fields.');
    } else if (!isPhoneNumberValid('#contactNumber')) {
        warningMessage('Invalid Phone Number');
    } else if (!isInputChecked('#maleCheckbox') && !isInputChecked('#femaleCheckbox')) {
        warningMessage('Select Gender');
    } else {
        var fullName = document.getElementById('fullName').value;
        var dob = document.getElementById('dob').value;
        var gender = selectedGender;
        var address = document.getElementById('address').value;
        var emergencyFullName = document.getElementById('efullName').value;
        var contactNumber = document.getElementById('contactNumber').value;
        var relationship = document.getElementById('relationship').value;
        var dateOfIncident = document.getElementById('doi').value;
        var timeOfIncident = document.getElementById('toi').value;
        var causeOfIncident = document.getElementById('coi').value;

        var $btnSubmit = $('#submitEmergencyInput'); // Assuming you're using a button with this ID
        var btnText = $btnSubmit.html();
        $btnSubmit.html('Processing...');
        $btnSubmit.prop('disabled', true);

        var action = 'emergency_input';
        var dataString = "action=" + action + "&fullName=" + fullName + "&dob=" + dob + "&gender=" + gender + "&address=" + address + "&emergencyFullName=" + emergencyFullName + "&contactNumber=" + contactNumber + "&relationship=" + relationship + "&dateOfIncident=" + dateOfIncident + "&timeOfIncident=" + timeOfIncident + "&causeOfIncident=" + causeOfIncident;

        $.ajax({
            type: 'POST',
            url: "config/code.php",
            data: dataString,
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data.success === true) { 
                    successMessage(data.message || 'Patient has been registered successfully');
                    setTimeout(()=>{
                          window.location.reload();
                    },2000)
                  
                } else if (data.success === false) {
                    dangerMessage(data.message || 'Phone number already exists');
                }
                $btnSubmit.html('Transfer');
                $btnSubmit.prop('disabled', false);
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', error);
                dangerMessage('An error occurred while processing your request.');
                $btnSubmit.html(btnText);
                $btnSubmit.prop('disabled', false);
            }
        });
    }
}



function filterAvailablePatient() {
    const tableBody = document.querySelector('#TableData tbody');
    const tableRows = Array.from(tableBody.querySelectorAll('tr')); // Convert NodeList to Array
    const searchInput = document.querySelector('#searchInput').value.trim().toLowerCase();

    let hasVisibleRows = false;
    tableRows.forEach((row) => {
        if (row.children.length < 2)  return;

        const patientName = row.children[1].textContent.trim().toLowerCase();
        const patientId = row.children[2].textContent.trim().toLowerCase();
        if (patientName.includes(searchInput) || patientId.includes(searchInput)){
            row.style.display = ''; // Show the row
            hasVisibleRows = true;
           
        } else row.style.display = 'none'; // Hide the row
    });

    const existingNoDataMessage = document.querySelector('#noDataMessage');
    if (existingNoDataMessage) {
        existingNoDataMessage.remove();
    }
    if (!hasVisibleRows) {
        const noDataMessage = document.createElement('tr');
        noDataMessage.id = 'noDataMessage';
        noDataMessage.innerHTML = '<td colspan="8" style="text-align: center;">No User associated with this input</td>';
        tableBody.appendChild(noDataMessage);
    }
}
document.querySelector('#searchInput').addEventListener('input', filterAvailablePatient);


function patientList(){
    const emergency_list_section = document.getElementById('emergency_list_section');
    const container = document.querySelector('.container');
    const emergency_form_container = document.querySelector('.emergency_form_container');
    emergency_list_section.classList.remove('hide');
    emergency_form_container.classList.add('hide');
    container.classList.add('hide');

}
function patientLForm(){
    const emergency_list_section = document.getElementById('emergency_list_section');
    const container = document.querySelector('.container');
    const emergency_form_container = document.querySelector('.emergency_form_container');
    emergency_list_section.classList.add('hide');
    emergency_form_container.classList.remove('hide');
    container.classList.remove('hide');
}


let patientName;
let patientId;
let patientGender;
function docForm(){
  document.querySelector('#bookDocForm #name').value = patientName;
  document.querySelector('#bookDocForm #id').value = patientId;
    closeModal('book__patient');
    openModal('docForm')
}
function nurseForm(){
  document.querySelector('#booknurseForm #name').value = patientName;
  document.querySelector('#booknurseForm #id').value = patientId;
    closeModal('book__patient');
    openModal('nurseForm');
}
function surgicalsuiteForm(){
  document.querySelector('#booksurgicalsuiteForm #name').value = patientName;
  document.querySelector('#booksurgicalsuiteForm #id').value = patientId;
    closeModal('book__patient');
    openModal('surgicalsuiteForm');
}
function labForm(){
  document.querySelector('#booklabForm #name').value = patientName;
  document.querySelector('#booklabForm #id').value = patientId;
    closeModal('book__patient');
    openModal('labForm');
}

function radiologyForm(){
  document.querySelector('#bookradiologyForm #name').value = patientName;
  document.querySelector('#bookradiologyForm #id').value = patientId;
    closeModal('book__patient');
    openModal('radiologyForm');
}
function morgueForm(){
  document.querySelector('#bookmorgueForm #name').value = patientName;
  document.querySelector('#bookmorgueForm #id').value = patientId;
    closeModal('book__patient');
    openModal('morgueForm');
}
function healthrecordForm(){
  document.querySelector('#bookhealthrecordForm #name').value = patientName;
  document.querySelector('#bookhealthrecordForm #id').value = patientId;
  document.querySelector('#bookhealthrecordForm #gender').value = patientGender;
  console.log(patientGender);
    closeModal('book__patient');
    openModal('healthrecordForm');
}

function isPatientStable() {
    const message = document.createElement('div');
    message.className = "alert info";
    message.innerHTML = `
    <div style="display:block">
       <h2>Is patient ${patientName} stable?</h2>
       <div style="display:flex; justify-content:space-around; width:100%">
           <button id="yes" class="bg-white">Yes</button>
           <button id="no" class="bg-white">No</button>
       </div>
    </div>
    `;
    document.body.appendChild(message);
    document.getElementById('yes').addEventListener('click', function() {
        healthrecordForm()
        message.remove();
    });
    document.getElementById('no').addEventListener('click', function() {
        window.location.reload();
    });
}

function bookHealthRecordForm() {
  const patient_name = document.querySelector('#bookhealthrecordForm #name').value;
  const patient_id = document.querySelector('#bookhealthrecordForm #id').value;
  const comment = document.getElementById('health_record_comment').value;
  var emergency_unit_id = document.getElementById('emergency_unit_id').value;
  var action = 'transfer_to_health_record';
    var dataString = "action=" + action + "&patient_name=" + patient_name + "&patient_id=" + patient_id + "&comment=" + comment+ "&emergency_unit_id=" + emergency_unit_id;

    $.ajax({
        type: 'POST',
        url: "config/code.php",
        data: dataString,
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data.success === true) { 
                successMessage(data.message || 'Patient has been transfered successfully');
                setTimeout(()=>{
                     
                      closeModal('healthrecordForm');
                      patientList();
                },2000)
              
            } else if (data.success === false) {
                dangerMessage(data.message || 'Error occured during transfer.');
            }
            $btnSubmit.html('Transfer');
            $btnSubmit.prop('disabled', false);
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', error);
            dangerMessage('An error occurred while processing your request.');
            $btnSubmit.html(btnText);
            $btnSubmit.prop('disabled', false);
        }
    });
}


////////nurse
function getnurse() {
    $('#select_nurse').html('<option>LOADING...</option>'); // Set loading message
    $('#select_nurse').prop('disabled', true); // Disable the dropdown

    var action = 'get_nurse'; // No roles needed
  
    $.ajax({
        type: 'POST',
        url: "config/code.php", // Adjust URL as needed
        data: { action: action }, // Only action is passed, no roles
        cache: false,
        dataType: 'json',
        success: function (response) {
            // Check for success and populate the dropdown
            if (response.success) {
                populateNurseDropdown(response.nurse); // Populate with nurse data
            } else {
                console.error('Error:', response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', status, error);
        },
    });
}

function populateNurseDropdown(nurse) {
    var nurseDropdown = document.getElementById('select_nurse');
  
    // Clear existing options
    nurseDropdown.innerHTML = '';
  
    // Add options based on the fetched data
    for (var i = 0; i < nurse.length; i++) {
        var option = document.createElement('option');
        option.value = nurse[i].nurse_id; // Assuming nurse object has 'nurse_id'
        option.textContent = nurse[i].fullname; // Assuming nurse object has 'nurse_name'
        nurseDropdown.appendChild(option);
    }
  
    // Enable the dropdown after populating options
    $('#select_nurse').prop('disabled', false);
}
  

function bookNurseForm() {
  const patient_name = document.querySelector('#booknurseForm #name').value
  const patient_id = document.querySelector('#booknurseForm #name').value
  const comment = document.querySelector('#booknurseForm #comment').value
  const selected_time = document.querySelector('#booknurseForm #selected_time').value
  const selected_date = document.querySelector('#booknurseForm #selected_date').value
  const nurse_id = document.querySelector('#booknurseForm #select_nurse').value

  var action = 'transfer_to_nurse';
  var dataString = "action=" + action + "&patient_name=" + patient_name + "&patient_id=" + patient_id + "&comment=" + comment + "&selected_time=" + selected_time + "&selected_date=" + selected_date + "&nurse_id=" + nurse_id;

    $.ajax({
        type: 'POST',
        url: "config/code.php",
        data: dataString,
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data.success === true) { 
                successMessage(data.message || 'Patient has been transfered successfully');
                setTimeout(()=>{
                    //   window.location.reload();
                    closeModal('nurseForm');
                },2000)
              
            } else if (data.success === false) {
                dangerMessage(data.message || 'Error occured during transfer.');
            }
            $btnSubmit.html('Transfer');
            $btnSubmit.prop('disabled', false);
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', error);
            dangerMessage('An error occurred while processing your request.');
            $btnSubmit.html(btnText);
            $btnSubmit.prop('disabled', false);
        }
    });
}



////////surgical suite
function get_surgical_suite() {
    $('#select_surgical_suite').html('<option>LOADING...</option>'); // Set loading message
    $('#select_surgical_suite').prop('disabled', true); // Disable the dropdown

    var action = 'get_surgical_unit'; // No roles needed
  
    $.ajax({
        type: 'POST',
        url: "config/code.php", // Adjust URL as needed
        data: { action: action }, // Only action is passed, no roles
        cache: false,
        dataType: 'json',
        success: function (response) {
            // Check for success and populate the dropdown
            if (response.success) {
                populateSurgDropdown(response.surgical_unit); // Populate with surgical_suite data
            } else {
                console.error('Error:', response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', status, error);
        },
    });
}

function populateSurgDropdown(surgical_unit) {
    var surgical_suiteDropdown = document.getElementById('select_surgical_suite');
  
    // Clear existing options
    surgical_suiteDropdown.innerHTML = '';
  
    // Add options based on the fetched data
    for (var i = 0; i < surgical_unit.length; i++) {
        var option = document.createElement('option');
        option.value = surgical_unit[i].surgical_unit_id; // Assuming surgical_suite object has 'surgical_suite_id'
        option.textContent = surgical_unit[i].fullname; // Assuming surgical_suite object has 'surgical_suite_name'
        surgical_suiteDropdown.appendChild(option);
    }
  
    // Enable the dropdown after populating options
    $('#select_surgical_suite').prop('disabled', false);
}
 


////////surgical suite

function bookSurgicalsuiteForm() {
  const patient_name = document.querySelector('#booksurgicalsuiteForm #name').value
  const patient_id = document.querySelector('#booksurgicalsuiteForm #id').value
  const comment = document.querySelector('#booksurgicalsuiteForm #comment').value
  const time = document.querySelector('#booksurgicalsuiteForm #selected_time').value
  const date = document.querySelector('#booksurgicalsuiteForm #selected_time').value
  const staffavailable = document.querySelector('#booksurgicalsuiteForm #select_surgical_suite').value
  
  var action = 'transfer_to_surgical_suite';
    var dataString = "action=" + action + "&patient_name=" + patient_name + "&patient_id=" + patient_id + "&comment=" + comment + "&time=" + time + "&date=" + date + "&staffavailable=" + staffavailable;

    $.ajax({
        type: 'POST',
        url: "config/code.php",
        data: dataString,
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data.success === true) { 
                successMessage(data.message || 'Patient has been transfered successfully');
                setTimeout(()=>{
                    //   window.location.reload();
                    closeModal('surgicalsuiteForm');
                },2000)
              
            } else if (data.success === false) {
                dangerMessage(data.message || 'Error occured during transfer.');
            }
            $btnSubmit.html('Transfer');
            $btnSubmit.prop('disabled', false);
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', error);
            dangerMessage('An error occurred while processing your request.');
            $btnSubmit.html(btnText);
            $btnSubmit.prop('disabled', false);
        }
    });
}



////////get lab
function get_lab() {
    $('#select_lab').html('<option>LOADING...</option>'); // Set loading message
    $('#select_lab').prop('disabled', true); // Disable the dropdown

    var action = 'get_lab_unit'; // No roles needed
  
    $.ajax({
        type: 'POST',
        url: "config/code.php", // Adjust URL as needed
        data: { action: action }, // Only action is passed, no roles
        cache: false,
        dataType: 'json',
        success: function (response) {
            // Check for success and populate the dropdown
            if (response.success) {
                populateLabDropdown(response.lab_unit); // Populate with lab data
            } else {
                console.error('Error:', response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', status, error);
        },
    });
}

function populateLabDropdown(lab_unit) {
    var labDropdown = document.getElementById('select_lab');
  
    // Clear existing options
    labDropdown.innerHTML = '';
  
    // Add options based on the fetched data
    for (var i = 0; i < lab_unit.length; i++) {
        var option = document.createElement('option');
        option.value = lab_unit[i].lab_scientist_id; // Assuming lab object has 'lab_id'
        option.textContent = lab_unit[i].lab_scientist_name; // Assuming lab object has 'lab_name'
        labDropdown.appendChild(option);
    }
  
    // Enable the dropdown after populating options
    $('#select_lab').prop('disabled', false);
}
 
////lab

function bookLabForm() {
    const patient_name = document.querySelector('#booklabForm #name').value
    const patient_id = document.querySelector('#booklabForm #id').value
    const comment = document.querySelector('#booklabForm #comment').value
    const time = document.querySelector('#booklabForm #selected_time').value
    const date = document.querySelector('#booklabForm #selected_date').value
    const staffavailable = document.querySelector('#booklabForm #select_lab').value
    
    var action = 'transfer_to_lab';
      var dataString = "action=" + action + "&patient_name=" + patient_name + "&patient_id=" + patient_id + "&comment=" + comment + "&time=" + time + "&date=" + date + "&staffavailable=" + staffavailable;
  
      $.ajax({
          type: 'POST',
          url: "config/code.php",
          data: dataString,
          cache: false,
          dataType: 'json',
          success: function (data) {
              if (data.success === true) { 
                  successMessage(data.message || 'Patient has been transfered successfully');
                  closeModal('labForm');
                  setTimeout(()=>{
                    
                        window.location.reload();
                  },2000)
                
              } else if (data.success === false) {
                  dangerMessage(data.message || 'Error occured during transfer.');
              }
              $btnSubmit.html('Transfer');
              $btnSubmit.prop('disabled', false);
          },
          error: function (xhr, status, error) {
              console.error('AJAX Error:', error);
              dangerMessage('An error occurred while processing your request.');
              $btnSubmit.html(btnText);
              $btnSubmit.prop('disabled', false);
          }
      });
  }
  

////////get rad
function get_radiology() {
    $('#select_rad').html('<option>LOADING...</option>'); // Set loading message
    $('#select_rad').prop('disabled', true); // Disable the dropdown

    var action = 'get_radiology'; // No roles needed
  
    $.ajax({
        type: 'POST',
        url: "config/code.php", // Adjust URL as needed
        data: { action: action }, // Only action is passed, no roles
        cache: false,
        dataType: 'json',
        success: function (response) {
            // Check for success and populate the dropdown
            if (response.success) {
                populateRadDropdown(response.radiology); // Populate with rad data
            } else {
                console.error('Error:', response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', status, error);
        },
    });
}

function populateRadDropdown(rad_unit) {
    var radDropdown = document.getElementById('select_rad');
  
    // Clear existing options
    radDropdown.innerHTML = '';
  
    // Add options based on the fetched data
    for (var i = 0; i < rad_unit.length; i++) {
        var option = document.createElement('option');
        option.value = rad_unit[i].radiology_id; // Assuming rad object has 'rad_id'
        option.textContent = rad_unit[i].fullname; // Assuming rad object has 'rad_name'
        radDropdown.appendChild(option);
    }
  
    // Enable the dropdown after populating options
    $('#select_rad').prop('disabled', false);
}
 



///////radiology 
function bookRadForm() {
  const patient_name = document.querySelector('#bookradiologyForm #name').value;
  const patient_id = document.querySelector('#bookradiologyForm #id').value;
  const comment = document.querySelector('#bookradiologyForm #comment').value;
  const time = document.querySelector('#bookradiologyForm #selected_time').value;
  const date = document.querySelector('#bookradiologyForm #selected_date').value;
  const radavailable = document.querySelector('#bookradiologyForm #select_rad').value;
  
  var action = 'transfer_to_radiology';
    var dataString = "action=" + action + "&patient_name=" + patient_name + "&patient_id=" + patient_id + "&comment=" + comment + "&time=" + time + "&date=" + date + "&radavailable=" + radavailable;

    $.ajax({
        type: 'POST',
        url: "config/code.php",
        data: dataString,
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data.success === true) { 
                successMessage(data.message || 'Patient has been transfered successfully');
                closeModal('radiologyForm');
                setTimeout(()=>{
                  
                      window.location.reload();
                },2000)
              
            } else if (data.success === false) {
                dangerMessage(data.message || 'Error occured during transfer.');
            }
            $btnSubmit.html('Transfer');
            $btnSubmit.prop('disabled', false);
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', error);
            dangerMessage('An error occurred while processing your request.');
            $btnSubmit.html(btnText);
            $btnSubmit.prop('disabled', false);
        }
    });
}



////////get morgue
function get_morgue() {
    $('#select_morgue').html('<option>LOADING...</option>'); // Set loading message
    $('#select_morgue').prop('disabled', true); // Disable the dropdown

    var action = 'get_morgue'; // No roles needed
  
    $.ajax({
        type: 'POST',
        url: "config/code.php", // Adjust URL as needed
        data: { action: action }, // Only action is passed, no roles
        cache: false,
        dataType: 'json',
        success: function (response) {
            // Check for success and populate the dropdown
            if (response.success) {
                populateMorgueDropdown(response.morgue); // Populate with rad data
            } else {
                console.error('Error:', response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', status, error);
        },
    });
}

function populateMorgueDropdown(morgue_unit) {
    var MorgueDropdown = document.getElementById('select_morgue');
  
    // Clear existing options
    MorgueDropdown.innerHTML = '';
  
    // Add options based on the fetched data
    for (var i = 0; i < morgue_unit.length; i++) {
        var option = document.createElement('option');
        option.value = morgue_unit[i].morgue_id; // Assuming rad object has 'rad_id'
        option.textContent = morgue_unit[i].fullname; // Assuming rad object has 'rad_name'
        MorgueDropdown.appendChild(option);
    }
  
    // Enable the dropdown after populating options
    $('#select_morgue').prop('disabled', false);
}
 


////////morgue
function bookMorgueForm() {
  const patient_name = document.querySelector('#bookmorgueForm #name').value
  const patient_id = document.querySelector('#bookmorgueForm #id').value
  const comment = document.querySelector('#bookmorgueForm #comment').value
  const time = document.querySelector('#bookmorgueForm #selected_time').value
  const date = document.querySelector('#bookmorgueForm #selected_date').value
  const morgueavailable = document.querySelector('#bookmorgueForm #select_morgue').value
  var emergency_unit_id = document.getElementById("emergency_unit_id").value;
  
  var action = 'transfer_to_morgue';
    var dataString = "action=" + action + "&patient_name=" + patient_name + "&patient_id=" + patient_id + "&comment=" + comment + "&time=" + time + "&date=" + date + "&morgueavailable=" + morgueavailable + "&emergency_unit_id=" +emergency_unit_id;

    $.ajax({
        type: 'POST',
        url: "config/code.php",
        data: dataString,
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data.success === true) { 
                successMessage(data.message || 'Patient has been transfered successfully');
                setTimeout(()=>{
                      window.location.reload();
                },2000)
              
            } else if (data.success === false) {
                dangerMessage(data.message || 'Error occured during transfer.');
            }
            $btnSubmit.html('Transfer');
            $btnSubmit.prop('disabled', false);
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', error);
            dangerMessage('An error occurred while processing your request.');
            $btnSubmit.html(btnText);
            $btnSubmit.prop('disabled', false);
        }
    });
}


function showBookModal(e){
patientName = e.target.closest('tr').children[1].textContent;
patientGender = e.target.closest('tr').children[2].textContent;
patientId = e.target.closest('tr').children[3].textContent;
  openModal('book__patient');
}




function getDoctorsRoles() {

    $('#roles').html('<option>LOADING...</option>'); // Set loading message
    $('#roles').prop('disabled', true); // Disable the dropdown
  
    var action = 'getDoctorsRoles';
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
    getDoctors();
  
    // Enable the dropdown after populating options
    $('#roles').on('change', getDoctors);
    $('#roles').prop('disabled', false);
  }
  
  
  //////////////////////////////doctors 

  
  
  
  
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


  function doctor_submit_btn() {
    // Use querySelector to select the first element with the given class
    var patient_name = document.querySelector("[name='patient_name']").value;
    var patient_id = document.querySelector("[name='patient_id']").value;
    var selected_date = document.querySelector("[name='selected_date']").value;
    var selected_time = document.querySelector("[name='selected_time']").value;
    var doctor_id = document.getElementById("doctor_id").value;
    var comment = document.getElementById("comment").value;

    var $btnSubmit = $('#doctor_submit'); // Button ID
    var btnText = $btnSubmit.html();
    $btnSubmit.html('Processing...');
    $btnSubmit.prop('disabled', true);

    var action = 'transfer_patient_to_doctor';
    var dataString = "action=" + action + "&patient_name=" + encodeURIComponent(patient_name) + 
                     "&patient_id=" + encodeURIComponent(patient_id) + 
                     "&selected_date=" + encodeURIComponent(selected_date) + 
                     "&selected_time=" + encodeURIComponent(selected_time) + 
                     "&doctor_id=" + encodeURIComponent(doctor_id) + 
                     "&comment=" + encodeURIComponent(comment);

    $.ajax({
        type: 'POST',
        url: "config/code.php",
        data: dataString,
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data.success === true) { 
                successMessage(data.message || 'Patient has been registered successfully');
                setTimeout(() => {
                    window.location.reload(); // Reload if needed
                }, 2000);
            } else if (data.success === false) {
                dangerMessage(data.message || 'Error occurred during transfer.');
            }
            $btnSubmit.html('Transfer');
            $btnSubmit.prop('disabled', false);
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', error);
            dangerMessage('An error occurred while processing your request.');
            $btnSubmit.html(btnText);
            $btnSubmit.prop('disabled', false);
        }
    });
}


