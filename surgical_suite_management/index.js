    //PROFILE IMAGE
    function displayUserProfile(){
        document.querySelector(".profile_account").classList.toggle("hide");
    };
  
    const modal = document.querySelector('.modal');
    const overlay = document.querySelector('.overlay');

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

function incomingAppoitment(){
    document.querySelector('#pendingSurgeryList').classList.add('hide');
    document.querySelector('#incomingAppouitment').classList.remove('hide');
    document.querySelector('#acceptedAppoitment').classList.add('hide');
    document.querySelector('.booking_section').classList.add('hide');
    document.querySelector('.patientProfile').classList.add('hide');
    document.querySelector('#acceptedAppoitment').classList.add('hide');
    document.querySelector('.upload-section').classList.add('hide');
}
function  acceptedAppoitment(){
    document.querySelector('#pendingSurgeryList').classList.add('hide');
    document.querySelector('#acceptedAppoitment').classList.add('hide');
    document.querySelector('#incomingAppouitment').classList.add('hide');
    document.querySelector('.booking_section').classList.add('hide');
    document.querySelector('.patientProfile').classList.add('hide');
    document.querySelector('#acceptedAppoitment').classList.remove('hide');
    document.querySelector('.upload-section').classList.add('hide');
}
function  pendingSurgeryList(){
    document.querySelector('#pendingSurgeryList').classList.remove('hide');
document.querySelector('#incomingAppouitment').classList.add('hide');
    document.querySelector('#acceptedAppoitment').classList.add('hide');
    document.querySelector('.booking_section').classList.add('hide');
    document.querySelector('.patientProfile').classList.add('hide');
    document.querySelector('#acceptedAppoitment').classList.add('hide');
    document.querySelector('.upload-section').classList.add('hide');
}
function bookinSection(){
    document.querySelector('#pendingSurgeryList').classList.add('hide');
    document.querySelector('#incomingAppouitment').classList.add('hide');
    document.querySelector('#acceptedAppoitment').classList.add('hide');
    document.querySelector('.booking_section').classList.remove('hide');
    document.querySelector('#acceptedAppoitment').classList.add('hide');
    document.querySelector('.patientProfile').classList.add('hide');
    document.querySelector('.upload-section').classList.add('hide');
}
function patientProfile(){
    document.querySelector('#pendingSurgeryList').classList.add('hide');
    document.querySelector('#incomingAppouitment').classList.add('hide');
    document.querySelector('#acceptedAppoitment').classList.add('hide');
    document.querySelector('.booking_section').classList.add('hide');
    document.querySelector('.upload-section').classList.add('hide');
    document.querySelector('#acceptedAppoitment').classList.add('hide');
    document.querySelector('.patientProfile').classList.remove('hide');
}
function uploadSection(){
    document.querySelector('#pendingSurgeryList').classList.add('hide');
    document.querySelector('#incomingAppouitment').classList.add('hide');
    document.querySelector('#acceptedAppoitment').classList.add('hide');
    document.querySelector('.booking_section').classList.add('hide');
    document.querySelector('#acceptedAppoitment').classList.add('hide');
    document.querySelector('.patientProfile').classList.add('hide');
    document.querySelector('.upload-section').classList.remove('hide');
}
 

let patientId;
function showPatientProfile(e){
patientId = e.target.closest('tr').children[2].textContent;
  openModal('patient')
}

async function PatientProfiles() {
    try {
        const response = await fetch('config/code.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'action': 'fetch_patient_profile',
                'patient_id': patientId
            })
        });
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.json(); 
        console.log(data.data);

        // Person data profile
        const patientData = data.data.patient_info;
        document.getElementById('p_profile_image').src = `.././uploaded_files/profile_pix/patient/${patientData.patient_passport}`;
        document.getElementById('pname').textContent = `${patientData.fullname}`;
        document.getElementById('pId').textContent = `${patientData.patient_id}`;
        document.getElementById('pgender').textContent = `${patientData.gender}`;
        document.getElementById('pdob').textContent = `${patientData.date}`;
        document.getElementById('phome_address').textContent = `${patientData.address}`;
        document.getElementById('p_phone_number').textContent = `${patientData.phonenumber}`;
        document.getElementById('pnx_name').textContent = `${patientData.kname}`;
        document.getElementById('pnx_gender').textContent = `${patientData.kgender}`;
        document.getElementById('pnx_address').textContent = `${patientData.kaddress}`;
        document.getElementById('pnx_phone_number').textContent = `${patientData.kphonenumber}`;
        document.getElementById('pnx_relationship').textContent = `${patientData.krelationship}`;
        document.getElementById('p_sh').textContent = `${NaN}`;
        document.getElementById('p_mh').textContent = `${patientData.medical_history}`;
        document.getElementById('p_sxh').textContent = `${patientData.sexual_history}`;
        document.getElementById('p_pd').textContent = `${patientData.past_disease}`;
        document.getElementById('p_fd').textContent = `${patientData.family_disease}`;
        document.getElementById('p_ps').textContent = `${patientData.past_surgery}`;

        const patientVitals = data.data.patient_vitals;
        console.log(patientVitals);

        const tableBody = document.querySelector('#patient__vitals tbody');
        tableBody.innerHTML = ''
        if(patientVitals === null){
            console.log('No data for patient')
            const noTableData = tableBody.insertRow(0);
            const noTableDataCell = noTableData.insertCell(0);
            noTableDataCell.colSpan = 9;
            noTableDataCell.innerHTML = 'No Vitals found';
            noTableDataCell.style.textAlign = 'center';
        }else{
            patientVitalsRow(patientVitals);
        }
        patientProfile()
    } catch (error) {
        console.error("Error:", error);
    } finally {
        console.log('Done');
        closeModal('patient');
    }
}

function patientVitalsRow(data) {
    const tableBody = document.querySelector('#patient__vitals tbody');
    const row = tableBody.insertRow();
    row.insertCell(0).textContent = 'date'
    row.insertCell(1).textContent = data.temperature || 'N/A'; 
    row.insertCell(2).textContent = data.bp || 'N/A';  
    row.insertCell(3).textContent = data.pulse || 'N/A';
    row.insertCell(4).textContent = data.temperature || 'N/A'; 
    row.insertCell(5).textContent = data.respiratory || 'N/A'; 
    row.insertCell(6).textContent = data.spo2 || 'N/A'; 
    row.insertCell(7).textContent = data.intake || 'N/A'; 
    row.insertCell(8).textContent = data.weight || 'N/A'; 
    row.insertCell(9).textContent = data.output || 'N/A';  
    row.insertCell(10).textContent = data.bmi || 'N/A'; 
}




function accept_patient(appointment_id, surgical_unit_id){

        var action = 'accept_appointment';
        var dataString = "action=" + action + "&patient_id=" + surgical_unit_id + "&appointment_id=" + appointment_id
        $.ajax({
            type: 'POST',
            url: "config/code.php",
            data: dataString,
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data.check === "success") {
                    successMessage("Patient has been moved successfully")
                    $btnSubmit.html('Transfer');
                    $btnSubmit.prop('disabled', false);
                    close_tranfer_patient_lab();
                } else {
                    console.error('Error:', data.error);
                    dangerMessage('Error:', data.error)
                    $btnSubmit.html(btnText);
                    $btnSubmit.prop('disabled', false);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', error);
                $btnSubmit.html(btnText);
                $btnSubmit.prop('disabled', false);
            }
        });
    }