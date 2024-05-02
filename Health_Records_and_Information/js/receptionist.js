'use strict';
//Sidebat responsiveness

//Convert all input to capital letter

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
  
      // var submit_btn = document.getElementById('uploadButton');
      // submit_btn.style.display = "block";
       
       
   
       // Stop the camera stream
       stopCamera();

    // Send the image data to the PHP script to handle moving it to the folder
    sendImageData(imageDataURL);
    // _upload_profile_pix(imageDataURL);
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

function display_profile(){
  document.querySelector('.all_patient_list').classList.add("hide")
  document.querySelector('.appoitment_section').classList.add("hide")
  setTimeout (function(){
    document.querySelector('.profile_container').style.display = 'flex';
    document.querySelector('.overlay_div').classList.remove("hide")
    document.querySelector('.checkup_section').classList.add("hide")
  }, 2000)
  document.querySelector("#btn_appoitment").style.display = "none"
  $('.print_icon').css({
    color:'green'
  })
  $('.finger_print_div').css({
    backgroundColor:'#fff'
  })
}
function patient_list(){
  document.querySelector('.form_sections').style.display = 'none';
  document.querySelector('.checkup_section').classList.add("hide")
  document.querySelector('.all_patient_list').classList.remove("hide")
  document.querySelector('.patient_list_div').classList.remove("hide")
  document.querySelector('.walkin_patient_list_div').classList.add("hide")
  document.querySelector('.appoitment_section').classList.add("hide")
  document.querySelector("#btn_appoitment").style.display = "none"
  document.querySelector('.profile_container').style.display = 'none';
}
function _walkin_patient_list(){
  document.querySelector('.form_sections').style.display = 'none';
  document.querySelector('.checkup_section').classList.add("hide")
  document.querySelector('.all_patient_list').classList.remove("hide")
  document.querySelector('.patient_list_div').classList.add("hide")
  document.querySelector('.walkin_patient_list_div').classList.remove("hide")
  document.querySelector('.appoitment_section').classList.add("hide")
  document.querySelector("#btn_appoitment").style.display = "none"
  document.querySelector('.profile_container').style.display = 'none';
}

function patient_admission_form_section(){
  document.querySelector('.form_sections').style.display = 'flex';
  document.querySelector('.all_patient_list').classList.add("hide")
  document.querySelector('.checkup_section').classList.add("hide")
  document.querySelector('.appoitment_section').classList.add("hide")
  document.querySelector("#btn_appoitment").style.display = "none"
  document.querySelector('.profile_container').style.display = 'none';
};
function walkin_patient_form(){
  $('.overlay_div').removeClass('hide');
  document.querySelector('.form_sections').style.display = 'flex';
  document.querySelector('.all_patient_list').classList.add("hide")
  $('.overlay_div').css({
    zIndex:1200,
  })
  $('.walkin_admission_form').removeClass('hide');
}
function close_walkin_patient_form(){
  $('.overlay_div').addClass('hide');
  $('.overlay_div').css({
    zIndex:1000,
  })
  $('.walkin_admission_form').addClass('hide');
}

function checkup_form(){
  document.querySelector('.form_sections').style.display = 'flex';
  document.querySelector('.all_patient_list').classList.add("hide")
  $('.checkup_section').removeClass('hide');
}
function close_checkup_form(){
  $('.checkup_section').addClass('hide');
}




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
  $('.overlay_div').removeClass('hide');
}
function close_show_book_popup() {
  $('#walkin_popup').addClass('hide');
  $('.overlay_div').addClass('hide');
  };

function lab_appoitment(){
  $('#lab_appoitment').removeClass('hide');
  $('#walkin_popup').addClass('hide');
   $('.overlay_div').removeClass('hide');
}
function rad_appoitment(){
  $('#rad_appoitment').removeClass('hide');
  $('#walkin_popup').addClass('hide');
   $('.overlay_div').removeClass('hide');
}


function _close_all_appoitment(){
  $('#lab_appoitment').addClass('hide');
  $('#rad_appoitment').addClass('hide');
  $('#walkin_popup').removeClass('hide');
   $('.overlay_div').addClass('hide');
}


function nurse_appoitment(){
  $('#nurse_appoitment').removeClass('hide');
  $('#nurse_appoitment').css({
    zIndex: 1200
  })
  $('#patient_popup').addClass('hide');
  $('.overlay_div').removeClass('hide');
}
function _close_all_patient_appoitments() {
  $('#patient_popup').removeClass('hide');
  $('#nurse_appoitment').addClass('hide');
  $('.overlay_div').addClass('hide');
}


function _show_patient_transfer_popup() {
  $('#patient_popup').removeClass('hide');
  $('.overlay_div').removeClass('hide');
}
function close_show_patient_transfer_popup() {
  $('#patient_popup').addClass('hide');
  $('.overlay_div').addClass('hide');
  };












 
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
  var family_card_id =$('#accept').val();
 
  var vgender;
  var vkgender;

  if (gender1) {
      vgender = 'Male';

  } else if (gender2) {
      vgender = 'Female';
  }

  if (kgender1) {
      vkgender = 'Male';
  } else if (kgender2) {
      vkgender = 'Female';
  }
  $('#yes_checkbox').prop('disabled', true)
if($('#gender1').is(':checked')){
  $('#gender2').prop('disabled', true); 
}else{
  $('#gender2').prop('disabled', false); 
}

  var hospital_plan = $('#select_box').val();



  

if((fullname=='')||(phonenumber=='')||(dob=='')||(address=='')||(vgender=='') ||(kname=='') ||(krelationship=='') ||(kaddress=='') ||(kphonenumber=='') ||(vkgender=='') ||(occupation=='')||(past_obsterics=='') ||(sexual_history=='')||(past_disease=='')||(family_disease=='') ||(past_surgery=='')||(medical_history=='')||(health_history=='') || (hospital_plan =="")){
  $('.alert_div').removeClass('hide');
  $('.alert_div').html('<div></div> USER ERROR! <i class="bi-exclamation-triangle"></i><br /><span>Fill All Fields.</span>').fadeIn(500).delay(5000).fadeOut(500);
  }else{
   //////////////// get btn text ////////////////
       $('#proceed-btn').html('PROCESSING...');
       document.getElementById('proceed-btn').disabled=true;
////////////////////////////////////////////////	
  
    var action = 'add_patient';		 
        var dataString ='action='+ action+'&fullname='+ fullname + '&phonenumber='+ phonenumber +'&dob='+ dob+'&address='+ address+'&gender='+ vgender+'&kname='+ kname+'&krelationship='+ krelationship+'&kaddress='+ kaddress+'&kphonenumber='+ kphonenumber+'&kgender='+ vkgender+'&occupation='+ occupation+'&past_obsterics='+ past_obsterics+'&sexual_history='+ sexual_history+'&family_disease='+ family_disease+'&past_disease='+ past_disease+ '&past_surgery='+ past_surgery+'&medical_history='+ medical_history + '&health_history' + health_history +'&hospital_plan='+ hospital_plan + '&family_card_id=' + family_card_id;
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
                  $('.alert_div').removeClass('hide');
                  $('alert_div').html('<div></div> REGISTRATION ERROR! <i class="bi-exclamation-triangle"></i><br /><span>Email Address Cannot Be Used</span>').fadeIn(500).delay(5000).fadeOut(500);

                  $('.alert_div').removeClass('hide');
                  $('.alert_div').html(`<div>PATIENT PHONE NUMBER IS ALREADY REGISTERED <i class="bi-exclamation-triangle"></i></div>`).fadeIn(500).delay(5000).fadeOut(100);
              }else{ //user suspended
                    $('#success-div').html('<div><i class="bi-check"></i></div> STAFF REGISTERED SUCCESSFULLY').fadeIn(500).delay(5000).fadeOut(100);
                  $('.alert_div').removeClass('hide');
                  $('.alert_div').addClass('successful');
                  $('.alert_div').html(`<div>Registration Successful </div> <br/> This patient's ID is  ${fpatient_id} `).fadeIn(500).delay(5000).fadeOut(100);
                    getLatestImage(fpatient_id);
                   
              }
              $('#proceed-btn').html('<i class="bi-check2"></i> SUBMIT');
              document.getElementById('proceed-btn').disabled=false;
          } 
      });
}
}	




function sendImageData(imageDataURL) {
  // Prepare the image data to be sent to the server
  let formData = new FormData();
  formData.append('image', imageDataURL);

  // Send the image data to the server via AJAX
  fetch('config/upload_image.php', {
    method: 'POST',
    body: formData
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Failed to move image');
    }
    return response.json(); // Return the JSON data
  })
  .then(data => {
    // Handle the server response
    console.log('Image moved successfully:', data);
    // Alert the result received from the server
    // var result = data ; // Convert object to string and then alert it
    // Update UI or perform other actions
    // _upload_profile_pix(result);

  })
  .catch(error => {
    console.error('Error moving image:', error);
    // Handle error appropriately
  });
}



function getLatestImage(fpatient_id) {
  $.ajax({
    url: 'config/get_latest_image.php', // Path to your PHP script
    type: 'GET',
    dataType: 'json',
    success: function(response) {
      if (response.latest_image) {
        var latestImage = response.latest_image;
        var imagePath = '../../uploaded_files/profile_pix/patient/' + latestImage; // Construct the full path to the latest image
        _upload_profile_pix(fpatient_id,latestImage);
        // Do something with the latest image path
        // console.log('Latest image:', imagePath);
      } else {
        console.log('No images found.');
      }
    },
    error: function(xhr, status, error) {
      console.error('Error retrieving latest image:', error);
    }
  });
}





function _upload_profile_pix(fpatient_id,latestImage) {
  var action = 'update_profile_pix';
  var id =  fpatient_id;
  // alert(latestImage);

  if (!latestImage) {
      console.error("No file selected.");
      return;
  }

  var form_data = new FormData();
  form_data.append('capturedImage', latestImage);
  form_data.append('action', action);
  form_data.append('id', id);

  $.ajax({
      url: "config/code.php",
      type: "POST",
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,
      success: function(html) {
          $('#success-div').html('<div><i class="bi-check"></i></div> PROFILE PICTURE UPDATED SUCCESSFULLY').fadeIn(500).delay(5000).fadeOut(100);
          $('#passport').val('');
          location.reload(true);
      },
      error: function(xhr, status, error) {
          console.error("Error uploading image:", error);
      }
  });
}

function create_family_card() {
  // $('#generation_alert').html('GENERATING ID...');
  $('.family_plan_section').addClass('hide');
  $('#generating_id').removeClass('hide');
  $('#generating_id').addClass('pending');
  $('#generating_id').text('GENERATING ID....');
  setTimeout(function(){
    $('#generating_id').addClass('hide');
    $('#generating_id').removeClass('hide');
    $('#generating_id').addClass('successful');
    $('#generating_id').html('GENERATED ID<i class="bi-check"></i>').fadeIn(500).delay(5000).fadeOut(100);
  }, 3000);


    $('#_create_card').click(function(event) {
        // Prevent the default action to manage it manually
        event.preventDefault();

        // Check if the checkbox was not already checked
        if (!$(this).is(':checked')) {
            // Manually check the checkbox
            $(this).prop('checked', true);

            // Call your function that handles the ID generation
            // create_family_card();
        }
    });

  var action = 'create_family_card'; // Define the action variable

  // Create a FormData object and append the action
  var form_data = new FormData();
  form_data.append('action', action);

  // Make the AJAX request
  $.ajax({
    url: "config/code.php",
    type: "POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    success: function(response) {
      // Parse the JSON response
      var result = JSON.parse(response);

      // Set the value of the accept input field to the generated ID
      var accept = document.getElementById('accept');
      
      accept.value = result.result; // Access the 'result' property of the parsed response

      // Update UI to indicate ID generation
  // Show the first div for 3 seconds
  $('#generating_id').removeClass('hide');
 
      // $('#generation_alert').html('ID GENERATED <i class="bi-check2"></i>');

  
    },
    error: function(xhr, status, error) {
      console.error("Error creating family card:", error);
    }
  });
}



function check_family_card_validity() {
  const inputField = document.getElementById('family_card_id');
  const resultDiv = document.getElementById('result');

  inputField.addEventListener('keyup', function(event) {
      const inputData = event.target.value.trim();
      if (inputData !== '') {
          const xhr = new XMLHttpRequest();
          xhr.open('GET', `config/family_card_validation.php?input=${inputData}`, true);
          xhr.onload = function() {
              if (xhr.status === 200) {
                  const response = JSON.parse(xhr.responseText);
                  if (response.message === "AVAILABLE") {
                      resultDiv.textContent = response.message;
                      $('#proceed-btn').html('BOOK');
                      $('#proceed-btn').prop('disabled', false);
                  } else {
                    resultDiv.textContent = response.message;
                      // console.error('Family card not available.');
                      $('#proceed-btn').html('INSERT CORRECT FAMILY CARD');
                      $('#proceed-btn').prop('disabled', true);
                  }
              } else {
                  console.error('Request failed. Status:', xhr.status);
                  $('#proceed-btn').html('INSERT CORRECT FAMILY CARD');
                  $('#proceed-btn').prop('disabled', true);
              }
          };
          xhr.onerror = function() {
              console.error('Request failed. Status:', xhr.status);
              $('#proceed-btn').html('INSERT CORRECT FAMILY CARD');
              $('#proceed-btn').prop('disabled', true);
          };
          xhr.send();
      } else {
          resultDiv.textContent = '';
      }
  });
}



function check_family_card_users(){
  $('#users_checker').html('CHECKING...');
  $('#users_checker').prop('disabled', false);
  var family_card_id = $('#family_card_id').val(); // Assuming family_card_id is an input field
  
  var action = 'check_for_users'; // Define the action variable

  // Create a FormData object and append the action
  var form_data = new FormData();
  form_data.append('action', action);
  form_data.append('family_card_id', family_card_id);

  // Make the AJAX request
  $.ajax({
    url: "config/code.php",
    type: "POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    success: function(response) {
      // Parse the JSON response
      var result = JSON.parse(response);

      // Check the number of users returned
      var users = result.users;
      switch(users) {
        case 0:
          // alert("No users associated with the family card.");
          $('.alert_div').removeClass('hide');
          $('.overlay_div').removeClass('hide');
          $('.alert_div').text('No users associated with this family card.');
          setTimeout(function(){
            $('.alert_div').addClass('hide');
            $('.overlay_div').addClass('hide');
            // $('#no_checkbox').prop('disabled', false); 
            // $('#yes_checkbox').prop('checked', true); 
          }, 3000)
          break;
        case 1:
          alert("THREE users left.");
          $('#users_checker').prop('disabled', false);
          $('#users_checker').html('Check for users');
          break;
        case 2:
          alert("TWO users left.");
          $('#users_checker').prop('disabled', false);
          $('#users_checker').html('Check for users');
          break;
        case 3:
          alert("ONE user left.");
          $('#users_checker').prop('disabled', false);
          $('#users_checker').html('Check for users');
          break;
        case 4:
          alert("This card is saturated.");
          $('#users_checker').html('THIS CARD IS SATURATED');
          $('#users_checker').prop('disabled', true);
          $('#proceed-btn').html('THE FAMILY CARD USERS IS OPIMIZED');
          $('#proceed-btn').prop('disabled', true);
          break;
        default:
          alert("Unexpected number of users returned.");
      }
    },
    error: function(xhr, status, error) {
      console.error("Error checking card users:", error);
    }
  });
}






////////////////////////CAMERA FOR WALKIN PATIENT
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
    let imageDataURL2 = canvasElement2.toDataURL('image/png');

    // Display the captured image
    capturedImageElement2.src = imageDataURL2;
    capturedImageElement2.style.display = 'block';

    // Stop the camera stream
    stopCamera2();
    sendImageData2(imageDataURL2);
  }
  
}

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
          var plans = data;
          var selectBox = document.getElementById("select_box");
          selectBox.innerHTML = "";
          plans.forEach(function(plan) {
              var option = document.createElement("option");
              option.text = plan.name; // Use plan name
              option.value = plan.id; // Use plan ID
              selectBox.appendChild(option);
          });
      },
      error: function(xhr, status, error) {
          console.error("Error fetching hospital plan data:", error);
      }
  });

  var selectBox = document.getElementById("select_box");
  selectBox.addEventListener("change", function() {
      var selectedOption = this.value;
      // Get the selected option element
      var selectedOptionElement = this.options[this.selectedIndex];
      // Set the ID attribute of the selected option
      selectedOptionElement.id = selectedOption;
      if (selectedOption === "ph0002") {
          checkIfFamilyPlan();
      } else {
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







function sendImageData2(imageDataURL2) {
  // Prepare the image data to be sent to the server
  let formData = new FormData();
  formData.append('image', imageDataURL2);

  // Send the image data to the server via AJAX
  fetch('config/upload_image2.php', {
    method: 'POST',
    body: formData
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Failed to move image');
    }
    return response.json(); // Return the JSON data
  })
  .then(data => {
    // Handle the server response
    console.log('Image moved successfully:', data);
    // Alert the result received from the server
    // var result = data ; // Convert object to string and then alert it
    // Update UI or perform other actions
    // _upload_profile_pix(result);

  })
  .catch(error => {
    console.error('Error moving image:', error);
    // Handle error appropriately
  });
}


function getLatestImage2(fpatient_id2) {
  $.ajax({
    url: 'config/get_latest_image2.php', // Path to your PHP script
    type: 'GET',
    dataType: 'json',
    success: function(response) {
      if (response.latest_image) {
        var latestImage = response.latest_image;
        var imagePath = '../../uploaded_files/profile_pix/walkin_patient/' + latestImage; // Construct the full path to the latest image
        _upload_profile_pix2(fpatient_id2,latestImage);
        // Do something with the latest image path
        // console.log('Latest image:', imagePath);
      } else {
        console.log('No images found.');
      }
    },
    error: function(xhr, status, error) {
      console.error('Error retrieving latest image:', error);
    }
  });
}


function _upload_profile_pix2(fpatient_id2,latestImage) {
  var action = 'update_profile_pix2';
  var id =  fpatient_id2;
  // alert(latestImage);

  if (!latestImage) {
      console.error("No file selected.");
      return;
  }

  var form_data = new FormData();
  form_data.append('walkin_in_section_capturedImage', latestImage);
  form_data.append('action', action);
  form_data.append('id', id);

  $.ajax({
      url: "config/code.php",
      type: "POST",
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,
      success: function(html) {
          $('#success-div').html('<div><i class="bi-check"></i></div> PROFILE PICTURE UPDATED SUCCESSFULLY').fadeIn(500).delay(5000).fadeOut(100);
          $('#passport').val('');
          location.reload(true);
      },
      error: function(xhr, status, error) {
          console.error("Error uploading image:", error);
      }
  });
}



function _add_patient2() {
  var wpatient_name = $('#wpatient_name').val();
  var wphonenumber = $('#wphonenumber').val();
  var wdob = $('#wdob').val();
  var gender1 = $('#wgender1').is(':checked');
  var gender2 = $('#wgender2').is(':checked');
  var waddress = $('#waddress').val();
 
  var vgender;

  if (gender1) {
      vgender = 'Male';
  } else if (gender2) {
      vgender = 'Female';
  }
  

if((wpatient_name=='')||(wphonenumber=='')||(wdob=='')||(waddress=='')||(vgender=='')){
  $('.alert_div').removeClass('hide');
  $('.alert_div').html('<div> USER ERROR! <br/><span>Fill All fields</span> <i class="bi-exclamation-triangle"></i></div>').fadeIn(500).delay(5000).fadeOut(100);

  }else{
   //////////////// get btn text ////////////////
       $('#wproceed-btn').html('PROCESSING...');
       //TOMIWA A QUESTION
       document.getElementById('wproceed-btn').disabled=true;
////////////////////////////////////////////////	
  
    var action = 'add_patient2';		 
        var dataString ='action='+ action+'&wpatient_name='+ wpatient_name + '&wphonenumber='+ wphonenumber +'&wdob='+ wdob+'&waddress='+ waddress+'&gender='+ vgender;
        $.ajax({
        type: "POST",
        url: "config/code.php",
        data: dataString,
        cache: false,
        dataType: 'json',
        cache: false,
        success: function(data){
                var scheck = data.check;
                var  fpatient_id2 = data.patient_id;
                var wphonenumber = data.wphonenumber;
                
                if(scheck==0){ //user Active
                  $('#warning-div').html('<div><i class="bi-exclamation-triangle"></i></div> REGISTRATION ERROR!<br /><span>Email Address Cannot Be Used</span>').fadeIn(500).delay(5000).fadeOut(100);
                  window.alert("Patient's phonenumber is already registered");
              }else{ //user suspended
                    $('#success-div').html('<div><i class="bi-check"></i></div> STAFF REGISTERED SUCCESSFULLY').fadeIn(500).delay(5000).fadeOut(100);
                    // _get_page('active-staff','active-staff');
                    // alert_close();
                    $('.alert_div').removeClass('hide');
                    $('.alert_div').addClass('successful');
                    $('.alert_div').html(`<div>Registration Successful <br/>This patients ID is ${fpatient_id2}</div>`).fadeIn(500).delay(5000).fadeOut(100);
                    getLatestImage2(fpatient_id2);
                   
              }
              $('#wproceed-btn').html('<i class="bi-check2"></i> SUBMIT');
              document.getElementById('wproceed-btn').disabled=false;
          } 
      });
}
}	

