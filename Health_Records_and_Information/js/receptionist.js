'use strict';
//PROFILE IMAGE
function click_icon_for_profile (){
  document.querySelector(".profile_account").classList.toggle("hide");
}

//CAMERA FOR NEW INTAKE ADMISSION FORM
var videoElement = document.getElementById('videoElement');
var canvasElement = document.getElementById('canvasElement');
var capturedImageElement = document.getElementById('capturedImage');
var stream;

function openCamera() {
  navigator.mediaDevices.getUserMedia({ video: true })
    .then(function (cameraStream) {
      stream = cameraStream;
      videoElement.srcObject = cameraStream;
    })
    .catch(function (error) {
      console.error('Error accessing the camera: ', error);
    });

    const capture_image = document.querySelector('#capture_image');
    capture_image.style.display="none"

    const showClickButton = document.querySelector(".btn_capture")
    showClickButton.classList.remove("hide");

    const showClickButtonForRecapture = document.querySelector(".btn_re_capture")
    showClickButtonForRecapture.classList.remove("hide")
}

function takePicture() {
  if (stream) {
    let context = canvasElement.getContext('2d');
    canvasElement.width = videoElement.videoWidth;
    canvasElement.height = videoElement.videoHeight;
    context.drawImage(videoElement, 0, 0, canvasElement.width, canvasElement.height);

    // Convert the canvas content to a data URL representing a PNG image
    let imageDataURL = canvasElement.toDataURL('image/png');

    // Display the captured image
    capturedImageElement.src = imageDataURL;
    capturedImageElement.style.display = 'block';

    var submit_btn = document.getElementById('uploadButton');
    submit_btn.style.display = "block";
    
    

    // Stop the camera stream
    stopCamera();
  }
}
function retakePicture() {
    // Hide the captured image
    capturedImageElement.style.display = 'none';

    // Stop the camera stream
    stopCamera();

    // Reopen the camera for retake
    openCamera();
  }
function stopCamera() {
  if (stream) {
    let tracks = stream.getTracks();

    // Stop all tracks
    tracks.forEach(track => track.stop());

    // Remove the stream from the video element
    videoElement.srcObject = null;
  }
}

//CAMERA FOR WALKIN PATIENT
var videoElement2 = document.getElementById('walkin_in_section_videoElement');
var canvasElement2 = document.getElementById('walkin_in_section_canvasElement');
var capturedImageElement2 = document.getElementById('walkin_in_section_capturedImage');
var stream2;

function openCamera2() {
  navigator.mediaDevices.getUserMedia({ video: true })
    .then(function (cameraStream) {
      stream2 = cameraStream;
      videoElement2.srcObject = cameraStream;
    })
    .catch(function (error) {
      console.error('Error accessing the camera: ', error);
    });

    const walkin_in_section_capture_image = document.querySelector('#walkin_in_section_capture_image');
    walkin_in_section_capture_image.style.display="none"

    const showWalkinClickButton = document.querySelector(".walkin_in_section_btn_capture")
    showWalkinClickButton.classList.remove("hide");

    const showWalkinClickButtonForRecapture = document.querySelector(".walkin_in_section_btn_re_capture")
    showWalkinClickButtonForRecapture.classList.remove("hide")
};

function takePicture2() {
  if (stream2) {
    let context = canvasElement2.getContext('2d');
    canvasElement2.width = videoElement2.videoWidth;
    canvasElement2.height = videoElement2.videoHeight;
    context.drawImage(videoElement2, 0, 0, canvasElement2.width, canvasElement2.height);

    // Convert the canvas content to a data URL representing a PNG image
    let imageDataURL = canvasElement2.toDataURL('image/png');

    // Display the captured image
    capturedImageElement2.src = imageDataURL;
    capturedImageElement2.style.display = 'block';

    // Stop the camera stream
    stopCamera2();
 
  }
};
function retakePicture2() {
    // Hide the captured image
    capturedImageElement2.style.display = 'none';

    // Stop the camera stream
    stopCamera2();

    // Reopen the camera for retake
    openCamera2();
  }
function stopCamera2() {
  if (stream2) {
    let tracks = stream2.getTracks();

    // Stop all tracks
    tracks.forEach(track => track.stop());

    // Remove the stream from the video element
    videoElement2.srcObject = null;
  }
}
function display_profile(){
  document.querySelector('.all_patient_list').classList.add("hide")
  document.querySelector('.appoitment_section').classList.add("hide")
  document.querySelector('.profile_container').style.display = 'flex';
  document.querySelector('.overlay').classList.remove("hide")
  document.querySelector("#btn_appoitment").style.display = "none"
}
function patient_list(){
  document.querySelector('.form_sections').style.display = 'none';
  document.querySelector('.checkup_section').style.display = 'none';
  document.querySelector('.all_patient_list').classList.remove("hide")
  document.querySelector('.appoitment_section').classList.add("hide")
  document.querySelector("#btn_appoitment").style.display = "none"
  document.querySelector('.profile_container').style.display = 'none';
}

function form_section(){
  document.querySelector('.form_sections').style.display = 'flex';
  document.querySelector('.all_patient_list').classList.add("hide")
  document.querySelector('.checkup_section').style.display = 'block';
  document.querySelector('.appoitment_section').classList.add("hide")
  document.querySelector("#btn_appoitment").style.display = "none"
  document.querySelector('.profile_container').style.display = 'none';
};



function activateFingerPrint(){
  document.querySelector('.finger_print_div').classList.remove("hide");
}
function deactivateFingerPrint(){
  document.querySelector('.finger_print_div').classList.add("hide");
}
function close_profile(){
  document.querySelector('.form_sections').style.display = 'flex';
  document.querySelector('.all_patient_list').classList.add("hide")
  document.querySelector('.appoitment_section').classList.add("hide")
  document.querySelector('.checkup_section').style.display = 'block';
  document.querySelector('.profile_container').style.display = 'none';
  document.querySelector('.overlay').classList.add("hide")
  document.querySelector("#btn_appoitment").style.display = "none"
}


function _show_book_popup() {
  $('#walkin_popup').removeClass('hide');
  $('.overlay').removeClass('hide');
}
function close_show_book_popup() {
  $('#walkin_popup').addClass('hide');
  $('.overlay').addClass('hide');
  };

function lab_appoitment(){
  $('#lab_appoitment').removeClass('hide');
  $('#walkin_popup').addClass('hide');
  $('.overlay').removeClass('hide');
}
function rad_appoitment(){
  $('#rad_appoitment').removeClass('hide');
  $('#walkin_popup').addClass('hide');
  $('.overlay').removeClass('hide');
}


function _close_all_appoitment(){
  $('#lab_appoitment').addClass('hide');
  $('#rad_appoitment').addClass('hide');
  $('#walkin_popup').removeClass('hide');
  $('.overlay').removeClass('hide');
}


function nurse_appoitment(){
  $('#nurse_appoitment').removeClass('hide');
  $('#patient_popup').addClass('hide');
  $('.overlay').removeClass('hide');
}
function _close_all_patient_appoitments() {
  $('#patient_popup').removeClass('hide');
  $('#nurse_appoitment').addClass('hide');
  $('.overlay').removeClass('hide');
}


function _show_patient_transfer_popup() {
  $('#patient_popup').removeClass('hide');
  $('.overlay').removeClass('hide');
}
function close_show_patient_transfer_popup() {
  $('#patient_popup').addClass('hide');
  $('.overlay').addClass('hide');
  };










document.querySelector("#btn_appoitment").style.display = "none"
function appoitment_booking(){
  document.querySelector('.form_sections').style.display = 'none';
  document.querySelector('.all_patient_list').classList.add("hide")
  document.querySelector('.appoitment_section').classList.remove("hide")
  document.querySelector("#btn_appoitment").style.display = "block"
  document.querySelector('.checkup_section').style.display = 'none';
  document.querySelector('.profile_container').style.display = 'none';
  document.querySelector('.overlay').classList.add("hide")
}
function book_appoitment(){
  const form_doctor_roles_name = document.querySelector(".doctor_roles_name");
  form_doctor_roles_name.classList.remove("hide");
}
function submitRoles(){
  const appoitment_form = document.querySelector(".appoitment_form");
  appoitment_form.classList.remove("hidden");
}

function close_appoitment_form(){
  const form_doctor_roles_name = document.querySelector(".doctor_roles_name");
  form_doctor_roles_name.classList.add("hide");
}

  //BEGINNING OF THE APPOITMENT 

//DOCTOR
const doctorsData = {
  cardiologist: ['Dr. Tomiwa', 'Dr. Johnson'],
  dermatologist: ['Dr. Kingsley', 'Dr. White'],
  surgeon:['Dr. Priceless', 'Dr John'],
  psychiatrist:['Dr. Towa', 'Dr Paul'],
  family_medicine:['Dr. Praise', 'Dr Trinity'],
  dermatologist: ['Dr.Tom', 'Dr Ruth' ],
  anaesthesiology:['Dr. Drake', 'Dr. Drake'],
  rheumatologist:['Dr. Peace', 'Dr Jude'],
  endocrinologist:['Dr. Grace', 'Dr. Houston'],
  nephrologist:['Dr. Goodness', 'Dr Goodnews'],
  neurologist:['Dr. Goodness', 'Dr.Peace'],
  pediatrician:['Dr. Fooad', 'Dr. Fooad'],
  urologist:['Dr. Uro', 'Dr. Fooad'],
  radiologist:['Dr. Fooad', 'Dr. Fooad'],
  dentist:['Dr. Gofade', 'Dr. Fooad'],
  pulmonologist:['Dr. Foatt', 'Dr. Fooad'],
  podiatristian:['Dr. Foatt', 'Dr. Fogad'],
  emergency_physician:['Dr. Good', 'Dr. Tom'],
  anaesthesiologist:['Dr. Green', 'Dr. Green'],
  cardiologist:['Dr Ben', 'Dr. White'],
  oncologist:['Dr. Bemson', 'Dr. Green'],
  gastroenterologist:['Dr. Houston', 'Dr. Green'],
  ophthanlmologist:['Dr. Jous', 'Dr. King'],
  cardology:['Dr. Funke', 'Dr Roseline'],
  allergist:['Dr. Postel', 'Dr.Houston'],
  orthopedic_surgoen:['Dr.Lookman', 'Dr. Chelsea'],
};

function getDoctors() {
  const selectedRole = document.getElementById('roles').value;
  const doctorsSelect = document.getElementById('doctors');
  doctorsSelect.innerHTML = ''; // Clear previous options

  // Populate the doctors select box based on the selected role
//   doctorsData[selectedRole].forEach(doctor => {
//       const option = document.createElement('option');
//       option.value = doctor;
//       option.text = doctor;
//       doctorsSelect.appendChild(option);
//   });
}

// Initial population of doctors based on the default selected role
getDoctors();


//CALENDAR
 //This help show the current date and time zone of today
 const date =  new Date()

 const renderCalendar = ()=>{
    date.setDate(1)
    // console.log(date.getDay());
     //this help shows the current month we are in and its 0 based "which means its counts from 0 throgh the months"
    //  const month  = date.getMonth()
     const monthDays = document.querySelector(".days")
    const lastDay = new Date(date.getFullYear(), date.getMonth() +1, 0).getDate()
    
    const prevLastDay = new Date(date.getFullYear(), date.getMonth(), 0).getDate()
    
    const firstDayIndex = date.getDay() 
    
    const  lastDayIndex = new Date(date.getFullYear(), date.getMonth() +1, 0).getDay()
    const nextDays = 7 - lastDayIndex -1
    //this is the month array of all the selected month
    const months = [
        "January", 
        "February",
         "March",
          "April", 
          "May", 
          "June", 
          "July", 
          "August", 
          "September",
           "October", 
           "November",
           "December" 
    ] ; 
    
    document.querySelector(".date h1").innerHTML = months[date.getMonth()];
    document.querySelector(".date p").innerHTML = new Date().toDateString();
    // const showDate =  document.querySelector(".content");
    
    let days = "";
    
    for(let x =  firstDayIndex; x>0; x--){
        days += `<div class ="prev-date">${prevLastDay - x +1}</div>`;
    }
    
    for(let i = 1; i <=lastDay; i++) {
        if(i === new Date().getDate() && date.getMonth() === new Date().getMonth()){
            
            days +=`
            <div class="calendar-date today" onclick="updateClickedDate(${i})">${i}</div>`;
        }else{
            
            days +=`
            <div class="calendar-date" onclick="updateClickedDate(${i})">${i}</div> `;
        }
    }
    
    for(let j =1; j<=nextDays; j++){
        days += `<div class="next-date">${j}</div>`;
        monthDays.innerHTML = days;
    }
 }
 function updateClickedDate(clickedDay) {
    document.querySelector(".selected_date").textContent = `${clickedDay}-${date.getMonth() + 1}-${date.getFullYear()}`;
    document.getElementById('date').value=`${clickedDay}-${date.getMonth() + 1}-${date.getFullYear()}`;
  }
 
 
 document.querySelector(".prev").addEventListener("click", function(){
    date.setMonth(date.getMonth() -1)
    renderCalendar()
 })
 document.querySelector(".next").addEventListener("click", function(){
    date.setMonth(date.getMonth()+ 1)
    renderCalendar()
 })
 renderCalendar();












 
 //////////////////////////////





 // function fetch_patient(patient_id){
//     var action='fetch_patient';
//     // $('#next_2').html('<div class="ajax-loader">loading...<br><img src="all-images/images/ajax-loader.gif"/></div>').fadeIn(500);
//     var dataString ='action='+ action+'&patient_id='+ patient_id;
//     $.ajax({
//     type: "POST",
//     url: "config/search.php",
//     data: dataString,
//     cache: false,
//     success: function(html){$('#next_2').html(html);}
//     });

// document.addEventListener('DOMContentLoaded', function() {
//     // Add 'fade-in' class to the body after the DOM content is loaded
//     document.body.classList.add('loaded');
// })


function _add_patient() {
  var fullname = $('#fullname').val();
  var phonenumber = $('#phonenumber').val();
  var dob = $('#dob').val();
  var gender1 = $('#gender1').is(':checked');
  var gender2 = $('#gender2').is(':checked');
  var address = $('#address').val();
  var kname = $('#kname').val();
  var krelationship = $('#krelationship').val();
  var kaddress = $('#kaddress').val();
  var kphonenumber = $('#kphonenumber').val();
  var kgender1 = $('#kgender1').is(':checked');
  var kgender2 = $('#kgender2').is(':checked');
  var occupation = $('#occupation').val();
  var past_obsterics = $('#past_obsterics').val();
  var medical_history = $('#medical_history').val();
  var sexual_history = $('#sexual_history').val();
  var past_disease = $('#past_disease').val();
  var family_disease = $('#family_disease').val();
  var past_surgery = $('#past_surgery').val();
  var category1 = $('#category1').is(':checked');
  var category2 = $('#category2').is(':checked');
  var category3 = $('#category3').is(':checked');
  var category4 = $('#category4').is(':checked');
  var category5 = $('#category5').is(':checked');
  var category6 = $('#category6').is(':checked');
  var category7 = $('#category7').is(':checked');

  var capturedImage = $().val();
 
  var vgender;
  var vkgender;

  if (gender1) {
      vgender = 'Male';
  } else if (gender2) {
      vgender = 'Female';
  }

  if (kgender1) {
      vkgender = 'Female';
  } else if (kgender2) {
      vkgender = 'Male';
  }
/////for category
  // var vcategory;

  // if (category1) {
  //     vcategory = "1";
  // } else if (category2) {
  //     vcategory = "2";
  // } else if (category3) {
  //     vcategory = "3";
  // } else if (category4) {
  //     vcategory = "4";
  // } else if (category5) {
  //     vcategory = "5";
  // } else if (category6) {
  //     vcategory = "6";
  // } else if (category7) {
  //     vcategory = "7";
  // }

var hospital_plan= $('option').val();

  // var bed = $('#beds option:selected').val();
  // var ward = $('#wards option:selected').val();

  

if((fullname=='')||(phonenumber=='')||(dob=='')||(address=='')||(vgender=='') ||(kname=='') ||(krelationship=='') 
||(kaddress=='') ||(kphonenumber=='') ||(vkgender=='') ||(occupation=='')||(past_obsterics=='') ||(sexual_history=='')
 ||(past_disease=='')||(family_disease=='') ||(past_surgery=='')||(medical_history=='')|| (hospital_plan ="")){
  $('#warning-div').html('<div><i class="bi-exclamation-triangle"></i></div> USER ERROR!<br /><span>Fields cannot be empty</span>').fadeIn(500).delay(5000).fadeOut(100);
      window.alert("Fill All fields");
  }else{
   //////////////// get btn text ////////////////
       $('#proceed-btn').html('PROCESSING...');
       document.getElementById('proceed-btn').disabled=true;
////////////////////////////////////////////////	
  
    var action = 'add_patient';		 
        var dataString ='action='+ action+'&fullname='+ fullname + '&phonenumber='+ phonenumber +'&dob='+ dob+
        '&address='+ address+'&gender='+ vgender+'&kname='+ kname+'&krelationship='+ krelationship+'&kaddress='+ kaddress+
        '&kphonenumber='+ kphonenumber+'&kgender='+ vkgender+'&occupation='+ occupation+'&past_obsterics='+ past_obsterics
        +'&sexual_history='+ sexual_history+'&family_disease='+ family_disease+'&past_disease='+ past_disease+
        '&past_surgery='+ past_surgery+'&medical_history='+ medical_history+ '&category='+ vcategory +
        '&hospital_plan='+ hospital_plan;
        $.ajax({
        type: "POST",
        url: "config/code.php",
        data: dataString,
        cache: false,
        dataType: 'json',
        cache: false,
        success: function(data){
                var scheck = data.check;
                var  fpatient_id = data.patient_id;
                var phonenumber = data.phonenumber;
                
                if(scheck==0){ //user Active
                  $('#warning-div').html('<div><i class="bi-exclamation-triangle"></i></div> REGISTRATION ERROR!<br /><span>Email Address Cannot Be Used</span>').fadeIn(500).delay(5000).fadeOut(100);
                  window.alert("Patient's phonenumber is already registered");
              }else{ //user suspended
        $('#success-div').html('<div><i class="bi-check"></i></div> STAFF REGISTERED SUCCESSFULLY').fadeIn(500).delay(5000).fadeOut(100);
                  // _get_page('active-staff','active-staff');
                  // alert_close();
                  window.alert("Registration Successful");
                  window.alert("This patient's ID is "+ fpatient_id );
                  location.reload(true);
              }
              $('#proceed-btn').html('<i class="bi-check2"></i> SUBMIT');
              document.getElementById('proceed-btn').disabled=false;
          } 
      });
}
}	




 
function _upload_profile_pix(){
  var action = 'update_profile_pix';
      var file_data = $('#capturedImage').val();
  if (file_data==''){}else{ 
      var form_data = new FormData();                  
      form_data.append('capturedImage', file_data);
      form_data.append('action', action);
      $.ajax({
          url: "config/code.php",
          type: "POST",
          data: form_data,
          contentType: false,
          cache: false,
          processData:false,
          success: function(html){
      $('#success-div').html('<div><i class="bi-check"></i></div> PROFILE PICTURE UPDATED SUCCESSFULLY').fadeIn(500).delay(5000).fadeOut(100);
          $('#capturedImage').val('');
          $('Submitted');
    }
      });
  }
}
function ChooseSelectBox() {
  var action = 'get_hospital_plan';
  var dataString = 'action=' + action;

  $.ajax({
      type: "POST",
      url: "config/code.php",
      data: dataString,
      cache: false,
      dataType: 'json',
      success: function(data) {
          // Assuming the returned data is an array of hospital plan names
          var plans = data;

          // Get the dropdown element
          var selectBox = document.getElementById("select_box");

          // Clear existing options
          selectBox.innerHTML = "";

          // Populate the select box with fetched data
          plans.forEach(function(plan) {
              var option = document.createElement("option");
              option.text = plan;
              option.value = plan;
              option.id = plan; // Set the ID to the value
              selectBox.appendChild(option);
          });
      },
      error: function(xhr, status, error) {
          console.error("Error fetching hospital plan data:", error);
      }
  });

  // Add an event listener to the select box
  var selectBox = document.getElementById("select_box");
  selectBox.addEventListener("change", function() {
      var selectedOption = this.value;
      if (selectedOption === "Family Card") {
          // Call a function or perform an action specific to family plan
          checkIfFamilyPlan();
      } else {
          // If the selected option is not "Family Card", remove the "hide" class
          document.querySelector('#existing_plan_or_not').classList.add("hide");
      }
  });
}

function checkIfFamilyPlan() {
  document.querySelector('#existing_plan_or_not').classList.toggle("hide");
}



function familyPlanSection(){
  document.querySelector('.family_plan_section').classList.toggle("hide");
}





// function getDoctors() {
//   const selectedRole = document.getElementById('roles').value;
//   const doctorsSelect = document.getElementById('doctors');
//   doctorsSelect.innerHTML = ''; // Clear previous options

//   // Populate the doctors select box based on the selected role
//   doctorsData[selectedRole].forEach(doctor => {
//       const option = document.createElement('option');
//       option.value = doctor;
//       option.text = doctor;
//       doctorsSelect.appendChild(option);
//   });
// }

// // Initial population of doctors based on the default selected role
// getDoctors();
