'use strict';

///////////////////////////////////////
// Modal window
const modal = document.querySelector('.modal');
const overlay = document.querySelector('.overlay');
const btnCloseModal = document.querySelector('.btn--close-modal');
const btnsOpenModal = document.querySelectorAll('.btn--show-modal');


const openModal = function (modalId) {
  const modal = document.getElementById(modalId);
  
  modal.classList.remove('hidden');
  overlay.classList.remove('hidden');
};


const closeModal = function (modalId) {
  const modal = document.getElementById(modalId);
  
  modal.classList.add('hidden');
  overlay.classList.add('hidden');
};
////////////////////////////////////////////////////////////////////

function displayUserProfile(){
    document.querySelector(".profile_account").classList.toggle("hide");
};
//////////////////////////////////////////

const sections = document.querySelectorAll('.section');
const allProfiles = document.querySelectorAll('.allProfiles');
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




const message = document.createElement('div');
const successMessage = function(text){
message.className= 'success alert';
message.innerHTML = `
  <div class="content">
      <div class="icon">
      <i class="bi bi-exclamation-triangle-fill bootsrapIcon"></i>
    </div>
      <h2>${text}</h2>
    </div>
`;
document.querySelector('body').appendChild(message);
setTimeout(() => message.classList.add('hide'),3000);
}

const infoMessage = function(text){
message.className= 'info alert';
message.innerHTML = text;
document.querySelector('body').appendChild(message);
setTimeout(() => message.classList.add('hide'),3000);
}
const warningMessage = function(text){
message.className= 'warning alert';
message.innerHTML = `
  <div class="content">
      <div class="icon">
      <i class="bi bi-exclamation-triangle-fill bootsrapIcon"></i>
    </div>
      <h2>${text}</h2>
    </div>
`;
document.querySelector('body').appendChild(message);
setTimeout(() => message.classList.add('hide'),3000);
}
const dangerMessage = function(text){
message.className= 'danger alert';
message.innerHTML = text;
document.querySelector('body').appendChild(message);
setTimeout(() => message.classList.add('hide'),3000);
}





////////////////////////////////////////////

//Validate All Input Fields
function isInputValid(inputs) {
for (const input of inputs) {
    if (input.value.trim() === '') return false;
}
return true;
}
function isEmailValid(inputId) {
    const email = document.getElementById(inputId).value.trim();
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return emailPattern.test(email);
}
function areSelectsValid(selects) {
    let allValid = true;
    selects.forEach(select => {
      if (select.value === "") {
        allValid = false;
      }
    });
    return allValid;
  }

const isNumberValid = function(numeric){
const number = document.querySelector(numeric).value
if(!+number) return false;
return true;
}
const inputChecked = function(checked){
const input = document.getElementById(checked);
if(!input) return false;
return input.checked;
}

function generateId() {
return`STAFF${Math.floor(Math.random() * 1000)}`
}
function isPhoneNumberValid(selector) {
  const phoneNumber = document.getElementById(selector).value.trim();
  const isNumeric = /^\d+$/.test(phoneNumber); 
  const startsWith090 = phoneNumber.startsWith('090');
  const startsWith081 = phoneNumber.startsWith('081');
  const startsWith080 = phoneNumber.startsWith('080');
  const startsWith091 = phoneNumber.startsWith('091');
  const startsWith442 = phoneNumber.startsWith('442');

  return phoneNumber.length === 11 && isNumeric && (
      startsWith090 || 
      startsWith081 || 
      startsWith080 || 
      startsWith091 || 
      startsWith442
  );
}

/// Function to remove no data message
function removeNoDataMessage(tableBody, noDataMessage) {
    if (tableBody.contains(noDataMessage)) {
        tableBody.removeChild(noDataMessage);
    }
  }
  
  function createNoDataMessage() {
    const noDataMessage = document.createElement('tr');
    noDataMessage.innerHTML = '<td colspan="9">No data available</td>';
    return noDataMessage;
  }
  
  const noDataMessage = createNoDataMessage();
  
  // PATIENT LIST 
  const availablePatientList = document.querySelector('#availablePatientList tbody');
  
  document.addEventListener('DOMContentLoaded', async () => {
      await patientList(); // Call patientList directly; handle message inside
  });
  
  const patientList = async function() {
      try {
          const response = await fetch('../../backend/config/search.php?search_term=');
          const data = await response.json();
          
          if (Array.isArray(data) && data.length > 0) {
              newPatientList(availablePatientList, data);
              removeNoDataMessage(availablePatientList, noDataMessage);
              console.log('Data fetched successfully');
          } else {
              availablePatientList.appendChild(noDataMessage);
              console.log('No patients found');
          }
      } catch (error) {
          console.log('Fetch error:', error);
          availablePatientList.appendChild(noDataMessage); // Optionally show no data on error
      }
  };
  
  const newPatientList = function(patientList, patients) {
      patients.forEach((patient, index) => {
          const newRow = patientList.insertRow();
          newRow.insertCell(0).innerHTML = index + 1;
  
          const imageCell = newRow.insertCell(1);
          const image = document.createElement('img');
          image.src = `../../uploaded_files/profile_pix/patient/${patient.patient_passport}`; // Ensure this field exists
          image.alt = 'Patient Passport';
          image.style.width = '50px';
          image.style.height = '50px';
          imageCell.appendChild(image);
  
          newRow.insertCell(2).innerHTML = patient.fullname || 'N/A';
          newRow.insertCell(3).innerHTML = patient.patient_id || 'N/A';
          newRow.insertCell(4).innerHTML = patient.gender || 'N/A';
          newRow.insertCell(5).innerHTML = patient.phonenumber || 'N/A';
          newRow.insertCell(6).innerHTML = patient.hospital_card_id || 'No Id associated with this user';
          newRow.insertCell(7).innerHTML = patient.address || 'N/A';
          newRow.insertCell(8).innerHTML = patient.occupation || 'N/A';
      });
  };

  function filterAvailablePatient() {
    const availablePatientList = document.querySelector('#availablePatientList tbody');
    const tableRows = Array.from(availablePatientList.querySelectorAll('tr')); // Convert NodeList to Array
    const searchInput = document.querySelector('#incomingSearchInput').value.trim().toLowerCase();

    let hasVisibleRows = false;
    tableRows.forEach((row) => {
        if (row.children.length < 2)  return;

        const patientName = row.children[2].textContent.trim().toLowerCase();
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
        noDataMessage.innerHTML = '<td colspan="9" style="text-align: center;">No Patient associated with this input</td>';
        availablePatientList.appendChild(noDataMessage);
    }
}
document.querySelector('#incomingSearchInput').addEventListener('input', filterAvailablePatient);
console.log(document.querySelector('#incomingSearchInput'));



  
  const patientsProfile = async function() {
    const availablePatientList = document.getElementById('availablePatientList');
    let patientId;
    if (availablePatientList) {
      availablePatientList.addEventListener('click', async function(e) {
        const row = e.target.closest('tr');
        if (row && row.children.length > 3) {
          patientId = row.children[3].innerText.trim().toLowerCase()
  
          try {
            const response = await fetch('../../backend/config/search.php?search_term=');
            const data = await response.json();
  
  
            data.find(patient =>{
              if(patient.patient_id === patientId) {
                console.log(patient); 
                const patientPassport = document.getElementById('patient_passport');
                const patientFullname = document.getElementById('fullname');
                const patientId = document.getElementById('patient_id');
                const patientPhoneNumber = document.getElementById('phonenumber');
                const patientHospitalCardId = document.getElementById('hospital_card_id');
                const patientFamilyCardId = document.getElementById('family_card_id');
                const patientGender= document.getElementById('gender');
                const patientDateOfBirth = document.getElementById('dateofbirth');
                const patientFamilyDisease= document.getElementById('family_disease');
                const patientNextOfKinAddress= document.getElementById('kaddress');
                const patientNextOfKinGender = document.getElementById('kgender');
                const patientNextOfKinName = document.getElementById('kname');
                const patientNextOfKinPhoneNumber = document.getElementById('kphonenumber');
                const patientNextOfKinRelationship = document.getElementById('krelationship');
                const patientMedicalHistory= document.getElementById('medical_history');
                const patientOccupation = document.getElementById('occupation');
                const patientPastDisease = document.getElementById('past_disease');
                const patientPastObsterics = document.getElementById('past_obsterics');
                const patientSexualHistory = document.getElementById('sexual_history');
                const patientPastSurgery= document.getElementById('past_surgery');
                const patientStatusId= document.getElementById('status_id');
                openModal('patientProfile');
                patientPassport.src = `../../uploaded_files/profile_pix/patient/${patient.patient_passport}`;
                patientFullname.innerHTML = `Patient Name: ${patient.fullname}`;
                patientId.innerHTML = `Patient Id: ${patient.patient_id}`;
                patientDateOfBirth.innerHTML = `Patient Date of Birth: ${patient.dateofbirth}`;
                patientPhoneNumber.innerHTML = `Patient Phone Number: ${patient.phonenumber}`;
                patientHospitalCardId.innerHTML = `Patient Hospital Card: ${patient.hospital_card_id}`;
                patientGender.innerHTML = `Patient Gender: ${patient.gender}`;
                patientFamilyDisease.innerHTML = `Patient Family Disease: ${patient.family_disease}`;
                patientFamilyCardId.innerHTML = `Patient Family Card: ${patient.family_card_id}`;
                patientNextOfKinAddress.innerHTML = `Patient Next of Kin Address
                : ${patient.kaddress}`;
                patientNextOfKinGender.innerHTML = `Patient Next of kin Gender: ${patient.kgender}`;
                patientNextOfKinName.innerHTML =`Patient Next of Kin Name: ${patient.kname}` ;
                patientNextOfKinPhoneNumber.innerHTML = `Patient Next of Kin Phone Number ${patient.kphonenumber}`;
                patientNextOfKinRelationship.innerHTML = `Patient Next of Kin Relationship: ${patient.krelationship}`;
                patientMedicalHistory.innerHTML = `Patient Medical History: ${patient.medical_history}`;
                patientOccupation.innerHTML = `Patient Occupation: ${patient.occupation}`;
                patientPastDisease.innerHTML = `Patient Past Disease: ${patient.past_disease}`;
                patientPastSurgery.innerHTML = `Patient Past Surgery: ${patient.past_surgery}`;
                patientStatusId.innerHTML = `Patient Status ID: ${patient.status_id}`;
                patientPastObsterics.innerHTML = `Patient Past Obsterics: ${patient.past_obsterics}`;
                patientSexualHistory.innerHTML = `Pactient Sexual History: ${patient.sexual_history}`;
              }  
              else return;
            });
  
          } catch (error) {
            console.error('Error fetching data:', error);
          }
        } else {
          console.log('No valid patient ID found in the clicked row');
        }
      });
    } else {
      console.log('Element with id "availablePatientList" not found.');
    }
  };
  
  patientsProfile();
  
  