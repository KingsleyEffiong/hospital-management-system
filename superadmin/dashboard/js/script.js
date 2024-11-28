
function _get_page(page){
    $('#more-info').html('<div class="ajax-loader"><img src="all-images/images/ajax-loader.gif"/></div>').fadeIn('fast');
    action='get_page';
    var dataString ='action='+ action+'&page='+ page;
    $.ajax({
    type: "POST",
    url: "config/code.php",
    data: dataString,
    cache: false,
    success: function(html){
        $('#more-info').html(html);
    }
    });
}



function _next_page(next_id) {
$('.login-div').hide();
$('#'+next_id).fadeIn(1000);
}




function _expand_link(ids){
    //  $('#'+divid).toggle(500);
      $('#'+ids+'-li').toggle('slow');
}
 
   
function _expand_div(ids){
//  $('#'+divid).toggle(500);
    $('#'+ids+'-lis').toggle('slow');
}
 




function alert_close(){
    $('.overlay-div-in').html('').fadeOut(200);
}



$(function() {
    view = {
       UpdatePreview: function(obj){
          if (!window.FileReader){
             // do nothing
          }else{
          var reader= new FileReader();
          var target= null;
          reader.onload = function(e){
             target = e.target || e.srcElement;
          $('#my_passport').prop("src", target.result);
          };
                reader.readAsDataURL(obj.files[0]);
       }
    }
    };
});


$(function() {
    staff = {
       UpdatePreview: function(obj){
          if (!window.FileReader){
             // do nothing
          }else{
          var reader= new FileReader();
          var target= null;
          reader.onload = function(e){
             target = e.target || e.srcElement;
          $('#passport_staff').prop("src", target.result);
          };
                reader.readAsDataURL(obj.files[0]);
       }
    }
    };
});


$(function(){
    Test = {
        UpdatePreview: function(obj){
          // if IE < 10 doesn't support FileReader
          if(!window.FileReader){
             // don't know how to proceed to assign src to image tag
          } else {
			  _upload_profile_pix();
             var reader = new FileReader();
             var target = null;

             reader.onload = function(e) {
              target =  e.target || e.srcElement;
               $("#passport1,#passport2,#passport3").prop("src", target.result);
             };
              reader.readAsDataURL(obj.files[0]);
          }
        }
    };
});



function updateTime() {
    const timerElement = document.getElementById("timer");
    const now = new Date();

    // Format time as HH:MM:SS
    const time = now.toLocaleTimeString('en-GB'); // 24-hour format
    // Format date as DD-MM-YYYY
    const date = now.toLocaleDateString('en-GB').split('/').join('-'); // Replacing '/' with '-'

    timerElement.textContent = `${time} ${date}`;
}








//     function _update_user_profile(staff_id){
//         var fullname = $('#fullname').val();
//         var email = $('#email').val();
//         var phonenumber = $('#phonenumber').val();  
//        // var role_id = $('#role_id').val();
//         var status_id = $('#status_id').val();
//         if((fullname=='')||(email=='')||(phonenumber=='')||(status_id=='')){
//             $('#warning-div').html('<div><i class="bi-exclamation-triangle"></i></div> USER ERROR!<br /><span>Fill the neccessary Fields  to continue</span>').fadeIn(500).delay(5000).fadeOut(100);
//                 }else{
                

//             $('#update-user-btn').html('Updating...');
//             document.getElementById('update-user-btn').disabled=true;

//         var action ='update_user_profile';
//         var dataString ='action='+ action+'&staff_id='+ staff_id+'&fullname='+ fullname+'&email='+ email+'&phonenumber='+ phonenumber+'&status_id='+ status_id+'&passport='+ passport;
//          $.ajax({
//             type: "POST",
//             url: "config/code.php",
//             data: dataString,
//             cache: false, 
//             success: function(){
//               $('#success-div').html('<div><i class="bi-check"></i></div> PROFILE UPDATED SUCCESSFULLY').fadeIn(500).delay(5000).fadeOut(100);
//               _user_profile('dashboard',staff_id);
            
//             $('#update-user-btn').html('<i class="bi-check2"></i> SUBMIT');
//             document.getElementById('update-user-btn').disabled=false;
//         }
//     });
// }
// }	


// function _upload_profile_pix(){
// 		var action = 'update_profile_pix';
//         var file_data = $('#passport').prop('files')[0];
// 		if (file_data==''){}else{ 
//         var form_data = new FormData();                  
//         form_data.append('passport', file_data);
//         form_data.append('action', action);
//         $.ajax({
//             url: "config/code.php",
//             type: "POST",
//             data: form_data,
//             contentType: false,
//             cache: false,
//             processData:false,
//             success: function(html){
// 		    $('#success-div').html('<div><i class="bi-check"></i></div> PROFILE PICTURE UPDATED SUCCESSFULLY').fadeIn(500).delay(5000).fadeOut(100);
//             $('#passport').val('');
// 			}
//         });
// 		}
// }



// ////////////////patient


// function showTable(category) {
//     var tables = document.getElementsByClassName("category-table");

//     // Hide the "All" table
//     var allTable = document.getElementById('All');
//     if (allTable) {
//         allTable.style.display = 'none';
//     }

//     // Hide all other tables
//     for (var i = 0; i < tables.length; i++) {
//         if (tables[i].id !== category) {
//             tables[i].style.display = 'none';
//         }
//     }

//     // Show the selected table
//     var selectedTable = document.getElementById(category);
//     if (selectedTable) {
//         selectedTable.style.display = 'table';
//     }
// }



// function _fetch_patient_list() {
    

//     const search_term = document.getElementById("search_term").value;
//     const searchResultsBody = document.getElementById("searchResultsBody");

//     // Clearing the existing search results
//     searchResultsBody.innerHTML = "";

//     //  an AJAX request to fetch search results
//     fetch('../../../backend/config/search.php?search_term=' + search_term)
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok');
//             }
//             return response.json();
//         })
//         .then(data => {
//             // Filtering patients based on the search term
//             const searchTerm = search_term.toLowerCase();
//             const filteredPatients = data.filter(patient => (
//                 patient.sn.toLowerCase().includes(searchTerm) ||
//                 patient.patient_id.toLowerCase().includes(searchTerm) ||
//                 patient.fullname.toLowerCase().includes(searchTerm) ||
//                 patient.email.toLowerCase().includes(searchTerm) ||
//                 patient.phonenumber.toLowerCase().includes(searchTerm) ||
//                 patient.date.toLowerCase().includes(searchTerm) ||
//                 patient.status_id.toLowerCase().includes(searchTerm) ||
//                 patient.last_login.toLowerCase().includes(searchTerm)
//             ));




//     // Displaying search results in the table
//     filteredPatients.forEach(patient => {
//     const row = searchResultsBody.insertRow();
//     row.insertCell(0).textContent = patient.sn;
//     row.insertCell(1).textContent = patient.patient_id;
//     row.insertCell(2).textContent = patient.fullname;
//     // row.insertCell(3).textContent = patient.email;
//     row.insertCell(3).textContent = patient.phonenumber;
//     row.insertCell(4).textContent = patient.date;

//     const statusCell = row.insertCell(5);
//     const icon = document.createElement("i");
//     icon.className = "fa fa-circle"; // Replace with the desired Font Awesome icon class

//     if (patient.status_id === "1") {
//         icon.style.color = "rgb(0, 255, 0)";
//     } else if (patient.status_id === "2") {
//         icon.style.color = "rgb(255, 226, 0";
//     }

//     statusCell.appendChild(icon);
// });

//     })
//     .catch(error => {
//         console.error('Error during AJAX request:', error);
//     });
// }





// ////////////////////////////////////////////////



// // function _next_page(next_id) {
// //     $('.login-div').hide();
// //     $('#'+next_id).fadeIn(1000);
// //     }






// // function next_page(patient_id) {
// //     var spatient_id = patient_id.getAttribute('data-patient-id');
// //     var action = 'patients_page';
// //     var dataString = 'action=' + action + '&patient_id=' + spatient_id;

// //     $.ajax({
// //         type: "POST",
// //         url: "../../backend/config/code.php",
// //         data: dataString,
// //         dataType: 'json',
// //         cache: false,
// //         success: function(data) {
// //             alert(data);
// //             var scheck = data.check;
// //             if (scheck === spatient_id) {
// //                 // window.alert("User is active");
// //                 window.alert(spatient_id);
// //                 console.log(patient_id);
// //                // window.location.href = "patients_profile.php"; // Redirect after success
// //                window.location.href = "patients_profile.php?patient_id=" + spatient_id;

// //             } else if (scheck === 'suspended') {
// //                 window.alert("User account is suspended");
// //             } else {
// //                 window.alert("Invalid email address");
// //             }
// //         },
// //         error: function(jqXHR, textStatus, errorThrown) {
// //             // Handle AJAX request errors
// //             console.error("AJAX Error: " + textStatus, errorThrown);
// //             window.alert("An error occurred during the request");
// //         }
// //     });




// function next_page(patient_id) {
//     var spatient_id = patient_id.getAttribute('data-patient-id');
//     var action = 'patients_profile';

//     // Create a form dynamically
//     var form = document.createElement('form');
//     form.method = 'post';
//     form.action = 'patients_profile.php';

//     // Creates a hidden input field for patient_id
//     var input = document.createElement('input');
//     input.type = 'hidden';
//     input.name = 'patient_id';
//     input.value = spatient_id;

//     // Append the input to the form
//     form.appendChild(input);

//     // Append the form to the body and submit it
//     document.body.appendChild(form);
//     form.submit();
// }








// ////////////patient_profile



// let firstTimerTextChange = document.querySelector('#timer');
// firstTimerTextChange.style.color = '#ff0000';
 

// //DROPDOWN FOR LABOURATORY EXAMINATION


// //PATIENT PERSONAL INFORMATION
//  const patientInfo = document.querySelector(".patient_info")
//  const info_open = document.querySelector("#info_open");
//  const info_close = document.querySelector("#info_close");
//  const info = document.querySelector("#info");

//      patientInfo.addEventListener("click", function(){
//      info.classList.toggle("info-hidden");
//      info_open.style.display = "none";
//      info_close.style.display = "block";
 
//          if(info.classList.contains("info-hidden")){
//              info_open.style.display = "block";
//              info_close.style.display = "none";
//          }
//      })


//      //LABOURATORY 
//  const labInfo = document.querySelector(".lab_info")
//  const lab_open = document.querySelector("#lab_open");
//  const lab_close = document.querySelector("#lab_close");
//  const lab_input = document.querySelector(".lab_input");

//  labInfo.addEventListener("click", function(){
//      lab_input.classList.toggle("hidden");
//      lab_open.style.display = "none";
//      lab_close.style.display = "block";
 
//          if(lab_input.classList.contains("hidden")){
//              lab_open.style.display = "block";
//              lab_close.style.display = "none";
//          }
//      })



// //Lab 


// //For immunoassay_section Dropdown
// const immunoassay_section = document.querySelector(".immunoassay")
// const immunoassay_open_icon1 = document.querySelector("#open_id_1")
// const immunoassay_close_icon1 = document.querySelector("#close_id_1")
// const form1 = document.querySelector(".form1");

// immunoassay_section.addEventListener("click",()=>{
//  form1.classList.toggle("hidden");
//  immunoassay_open_icon1.style.display = "none";
//  immunoassay_close_icon1.style.display = "block";
//  if(form1.classList.contains("hidden")){
//      immunoassay_close_icon1.style.display = "none";
//      immunoassay_open_icon1.style.display = "block";
//  }
// })

// //For immunoassay_section Dropdown
// const clinical_chemistry_section = document.querySelector(".clinical_chemistry")
// const clinical_chemistry_open_icon1 = document.querySelector("#open_id_2")
// const clinical_chemistry_close_icon1 = document.querySelector("#close_id_2")
// const form2 = document.querySelector(".form2");

// clinical_chemistry_section.addEventListener("click",()=>{
//  form2.classList.toggle("hidden");
//  clinical_chemistry_open_icon1.style.display = "none";
//  clinical_chemistry_close_icon1.style.display = "block";
//  if(form2.classList.contains("hidden")){
//      clinical_chemistry_close_icon1.style.display = "none";
//      clinical_chemistry_open_icon1.style.display = "block";
//  }
// })
// //For thyroid_section Dropdown
// const thyroid_section = document.querySelector(".thyroid")
// const thyroid_open_icon1 = document.querySelector("#open_id_3")
// const thyroid_close_icon1 = document.querySelector("#close_id_3")
// const form3 = document.querySelector(".form3");

// thyroid_section.addEventListener("click",()=>{
//  form3.classList.toggle("hidden");
//  thyroid_open_icon1.style.display = "none";
//  thyroid_close_icon1.style.display = "block";
//  if(form3.classList.contains("hidden")){
//      thyroid_close_icon1.style.display = "none";
//      thyroid_open_icon1.style.display = "block";
//  }
// })

// //For tumor_section Dropdown
// const tumor_section = document.querySelector(".tumor")
// const tumor_open_icon1 = document.querySelector("#open_id_4")
// const tumor_close_icon1 = document.querySelector("#close_id_4")
// const form4 = document.querySelector(".form4");

// tumor_section.addEventListener("click",()=>{
//  form4.classList.toggle("hidden");
//  tumor_open_icon1.style.display = "none";
//  tumor_close_icon1.style.display = "block";
//  if(form4.classList.contains("hidden")){
//      tumor_close_icon1.style.display = "none";
//      tumor_open_icon1.style.display = "block";
//  }
// })

// //For blood_section Dropdown
// const blood_section = document.querySelector(".blood")
// const blood_open_icon1 = document.querySelector("#open_id_5")
// const blood_close_icon1 = document.querySelector("#close_id_5")
// const form5 = document.querySelector(".form5");

// blood_section.addEventListener("click",()=>{
//  form5.classList.toggle("hidden");
//  blood_open_icon1.style.display = "none";
//  blood_close_icon1.style.display = "block";
//  if(form5.classList.contains("hidden")){
//      blood_close_icon1.style.display = "none";
//      blood_open_icon1.style.display = "block";
//  }
// })
// //For food_section Dropdown
// const food_section = document.querySelector(".food")
// const food_open_icon1 = document.querySelector("#open_id_6")
// const food_close_icon1 = document.querySelector("#close_id_6")
// const form6 = document.querySelector(".form6");

// food_section.addEventListener("click",()=>{
//  form6.classList.toggle("hidden");
//  food_open_icon1.style.display = "none";
//  food_close_icon1.style.display = "block";
//  if(form6.classList.contains("hidden")){
//      food_close_icon1.style.display = "none";
//      food_open_icon1.style.display = "block";
//  }
// })

// //For microbiology_section Dropdown
// const microbiology_section = document.querySelector(".microbiology")
// const microbiology_open_icon1 = document.querySelector("#open_id_7")
// const microbiology_close_icon1 = document.querySelector("#close_id_7")
// const form7= document.querySelector(".form7");

// microbiology_section.addEventListener("click",()=>{
//  form7.classList.toggle("hidden");
//  microbiology_open_icon1.style.display = "none";
//  microbiology_close_icon1.style.display = "block";
//  if(form7.classList.contains("hidden")){
//      microbiology_close_icon1.style.display = "none";
//      microbiology_open_icon1.style.display = "block";
//  }
// })

// //For histopathology Dropdown
// const histopathology_section = document.querySelector(".histopathology")
// const histopathology_open_icon1 = document.querySelector("#open_id_8")
// const histopathology_close_icon1 = document.querySelector("#close_id_8")
// const form8= document.querySelector(".form8");

// histopathology_section.addEventListener("click",()=>{
//  form8.classList.toggle("hidden");
//  histopathology_open_icon1.style.display = "none";
//  histopathology_close_icon1.style.display = "block";
//  if(form8.classList.contains("hidden")){
//      histopathology_close_icon1.style.display = "none";
//      histopathology_open_icon1.style.display = "block";
//  }
// })
// //For haematology Dropdown
// const haematology_section = document.querySelector(".haematology")
// const haematology_open_icon1 = document.querySelector("#open_id_9")
// const haematology_close_icon1 = document.querySelector("#close_id_9")
// const form9= document.querySelector(".form9");

// haematology_section.addEventListener("click",()=>{
//  form9.classList.toggle("hidden");
//  haematology_open_icon1.style.display = "none";
//  haematology_close_icon1.style.display = "block";
//  if(form9.classList.contains("hidden")){
//      haematology_close_icon1.style.display = "none";
//      haematology_open_icon1.style.display = "block";
//  }
// })

// const disabledCheckbox = ()=>{
//  const checkboxes = document.querySelectorAll('input[type="checkbox"]');

//     checkboxes.forEach(function(checkbox){
//      checkbox.disabled = true;
//     })

// }
// disabledCheckbox()



// //Complaints Section
// const complaint = document.querySelector(".complain");
// const complaint_section = document.querySelector(".complaint-section ");
// const complaint_section_icon_plus = document.querySelector("#complaint_icon_plus");
// const complaint_section_icon_minus = document.querySelector("#complaint_icon_minus");
// const check_1 = document.querySelector("#check1")
// const check_2 = document.querySelector("#check2")



// complaint.addEventListener("click", function(){
// complaint_section.classList.toggle("hidden");
// complaint_section_icon_plus.style.display = "none";
// complaint_section_icon_minus.style.display = "block";
// if(complaint_section.classList.contains("hidden")){
//  complaint_section_icon_plus.style.display = "block";
// complaint_section_icon_minus.style.display = "none";
// }
// })         
// const readOnlyInput = ()=>{
//  const complainInput = document.querySelectorAll(".complaint-input");
//  complainInput.forEach(function(complaint){
//     complaint.readOnly = true;
//   complaint.value = "Testing";
//  })
 
// }
// readOnlyInput()



// // form input
// //System Review dropdown
// const system = document.querySelector(".system");
// const system_review_section = document.querySelector(".system_review-section");
// const system_review_section_icon_plus = document.querySelector("#system_icon_plus");
// const system_review_section_icon_minus = document.querySelector("#system_icon_minus");



// system.addEventListener("click", function(){
// system_review_section.classList.toggle("hidden");
// system_review_section_icon_plus.style.display = "none";
// system_review_section_icon_minus.style.display = "block";
// if(system_review_section.classList.contains("hidden")){
//  system_review_section_icon_plus.style.display = "block";
//  system_review_section_icon_minus.style.display = "none";
// }
// }) 

// // For General Dropdown
// const general_dropdown = document.querySelector(".drop-down1");
// const showForm1 = document.querySelector(".gen_form1");
// const closeIcon1 = document.querySelector("#close_1");
// const openIcon1 = document.querySelector("#open_1");

// general_dropdown.addEventListener("click", function(){
//  showForm1.classList.toggle("hidden");
//  closeIcon1.style.display = "block";
//  openIcon1.style.display = "none";
//  if(showForm1.classList.contains("hidden")){
//      closeIcon1.style.display = "none";
//      openIcon1.style.display = "block";
//  }
// });


// //For Skin Dropdown
// const skin_dropdown = document.querySelector(".drop-down2");
// const showForm2 = document.querySelector(".skin_form2");
// const closeIcon2 = document.querySelector("#close_2");
// const openIcon2 = document.querySelector("#open_2");

// skin_dropdown.addEventListener("click", function(){
//  showForm2.classList.toggle("hidden");
//  closeIcon2.style.display = "block";
//  openIcon2.style.display = "none";
//  if(showForm2.classList.contains("hidden")){
//      closeIcon2.style.display = "none";
//      openIcon2.style.display = "block";
//  }
// });

// //For EndoCrine Dropdown
// const endocrine_dropdown = document.querySelector(".drop-down3");
// const showForm3 = document.querySelector(".endo_form3");
// const closeIcon3 = document.querySelector("#close_3");
// const openIcon3 = document.querySelector("#open_3");

// endocrine_dropdown.addEventListener("click", function(){
//  showForm3.classList.toggle("hidden");
//  closeIcon3.style.display = "block";
//  openIcon3.style.display = "none";
//  if(showForm3.classList.contains("hidden")){
//      closeIcon3.style.display = "none";
//      openIcon3.style.display = "block";
//  }
// });

// //For Hematopioetic Dropdown
// const hematopioetice_dropdown = document.querySelector(".drop-down4");
// const showForm4 = document.querySelector(".hermato_form4");
// const closeIcon4 = document.querySelector("#close_4");
// const openIcon4 = document.querySelector("#open_4");

// hematopioetice_dropdown.addEventListener("click", function(){
//  showForm4.classList.toggle("hidden");
//  closeIcon4.style.display = "block";
//  openIcon4.style.display = "none";
//  if(showForm4.classList.contains("hidden")){
//      closeIcon4.style.display = "none";
//      openIcon4.style.display = "block";
//  }
// });
// //For Muscoskeletal Dropdown
// const muscoskeletal_dropdown = document.querySelector(".drop-down5");
// const showForm5 = document.querySelector(".mus_form5");
// const closeIcon5 = document.querySelector("#close_5");
// const openIcon5 = document.querySelector("#open_5");

// muscoskeletal_dropdown.addEventListener("click", function(){
//  showForm5.classList.toggle("hidden");
//  closeIcon5.style.display = "block";
//  openIcon5.style.display = "none";
//  if(showForm5.classList.contains("hidden")){
//      closeIcon5.style.display = "none";
//      openIcon5.style.display = "block";
//  }
// });

// //For head & neck Dropdown
// const head_neck_dropdown = document.querySelector(".drop-down6");
// const showForm6 = document.querySelector(".head_neck_form6");
// const closeIcon6 = document.querySelector("#close_6");
// const openIcon6 = document.querySelector("#open_6");

// head_neck_dropdown.addEventListener("click", function(){
//  showForm6.classList.toggle("hidden");
//  closeIcon6.style.display = "block";
//  openIcon6.style.display = "none";
//  if(showForm6.classList.contains("hidden")){
//      closeIcon6.style.display = "none";
//      openIcon6.style.display = "block";
//  }
// });

// //For Ears, Nose, Sinuses, Mouth & Throat Dropdown
// const ear_nose_sinuses_mouth_throat_dropdown = document.querySelector(".drop-down7");
// const showForm7 = document.querySelector(".ear_nose_form7");
// const closeIcon7 = document.querySelector("#close_7");
// const openIcon7 = document.querySelector("#open_7");

// ear_nose_sinuses_mouth_throat_dropdown.addEventListener("click", function(){
//  showForm7.classList.toggle("hidden");
//  closeIcon7.style.display = "block";
//  openIcon7.style.display = "none";
//  if(showForm7.classList.contains("hidden")){
//      closeIcon7.style.display = "none";
//      openIcon7.style.display = "block";
//  }
// });

// //For Breast Dropdown
// const breast_dropdown = document.querySelector(".drop-down8");
// const showForm8 = document.querySelector(".breast_form8");
// const closeIcon8 = document.querySelector("#close_8");
// const openIcon8 = document.querySelector("#open_8");

// breast_dropdown.addEventListener("click", function(){
//  showForm8.classList.toggle("hidden");
//  closeIcon8.style.display = "block";
//  openIcon8.style.display = "none";
//  if(showForm8.classList.contains("hidden")){
//      closeIcon8.style.display = "none";
//      openIcon8.style.display = "block";
//  }
// });

// //For Respiratory Dropdown
// const respiratory_dropdown = document.querySelector(".drop-down9");
// const showForm9 = document.querySelector(".res_form9");
// const closeIcon9 = document.querySelector("#close_9");
// const openIcon9 = document.querySelector("#open_9");

// respiratory_dropdown.addEventListener("click", function(){
//  showForm9.classList.toggle("hidden");
//  closeIcon9.style.display = "block";
//  openIcon9.style.display = "none";
//  if(showForm9.classList.contains("hidden")){
//      closeIcon9.style.display = "none";
//      openIcon9.style.display = "block";
//  }
// });
// //For Cardiovascular Dropdown
// const cardiovascular_dropdown = document.querySelector(".drop-down10");
// const showForm10 = document.querySelector(".form10");
// const closeIcon10 = document.querySelector("#close_10");
// const openIcon10 = document.querySelector("#open_10");

// cardiovascular_dropdown.addEventListener("click", function(){
//  showForm10.classList.toggle("hidden");
//  closeIcon10.style.display = "block";
//  openIcon10.style.display = "none";
//  if(showForm10.classList.contains("hidden")){
//      closeIcon10.style.display = "none";
//      openIcon10.style.display = "block";
//  }
// });
// //For Gastrointestinal Dropdown
// const gastrointestinal_dropdown = document.querySelector(".drop-down11");
// const showForm11= document.querySelector(".form11");
// const closeIcon11= document.querySelector("#close_11");
// const openIcon11 = document.querySelector("#open_11");

// gastrointestinal_dropdown.addEventListener("click", function(){
//  showForm11.classList.toggle("hidden");
//  closeIcon11.style.display = "block";
//  openIcon11.style.display = "none";
//  if(showForm11.classList.contains("hidden")){
//      closeIcon11.style.display = "none";
//      openIcon11.style.display = "block";
//  }
// });



// //BACK ARROW TO THE DASHBOARD
// function backWardArrow(){
//  var urlBackwardArrow = 'patients.php';
//  window.parent(location=(urlBackwardArrow));

// }
 
// const testInput = ()=>{
//  const test13 = document.querySelector(".test")
//  test13.value = "Hello, world!"
//  complaint.value = test13
// }


// //VITALS
// const patients_vitals = document.querySelector(".patient_vitals");
// const open_icon_for_patient = document.querySelector("#vitals_open")
// const close_icon_for_patient = document.querySelector("#vitals_close");
// const showVitals = document.querySelector(".show_vitals")

// patients_vitals.addEventListener("click", ()=>{
//  showVitals.classList.toggle("hidden");
//  open_icon_for_patient.style.display = "none";
//  close_icon_for_patient.style.display = "block";
//  if(showVitals.classList.contains("hidden")){
//      open_icon_for_patient.style.display = "block";
//      close_icon_for_patient.style.display = "none";
//  }
// })


// ///TREATMENT AND PRESCIBTION

// const treatment_prescribtion = document.querySelector(".treatment_prescribtion");
// const treatment_prescribtion_open = document.querySelector("#treatment_prescribtion_open");
// const treatment_prescribtion_close = document.querySelector("#treatment_prescribtion_close");
// const table_div_treatment_prescribion = document.querySelector(".table_div_treatment_prescribion")

// treatment_prescribtion.addEventListener("click",()=>{
//  table_div_treatment_prescribion.classList.toggle("hidden");
//  treatment_prescribtion_close.style.display="block";
//  treatment_prescribtion_open.style.display="none";
//  if(table_div_treatment_prescribion.classList.contains("hidden")){
//      treatment_prescribtion_close.style.display="none";
//      treatment_prescribtion_open.style.display="block";
//  }

// })

// ///DIAGNOSIS


// const diagnosis = document.querySelector(".diagnosis");
// const diagnosis_open = document.querySelector("#diagnosis_open");
// const diagnosis_close = document.querySelector("#diagnosis_close");
// const table_div_diagnosis = document.querySelector(".table_div_diagnosis")

// diagnosis.addEventListener("click",()=>{
//  table_div_diagnosis.classList.toggle("hidden");
//  diagnosis_close.style.display="block";
//  diagnosis_open.style.display="none";
//  if(table_div_diagnosis.classList.contains("hidden")){
//      diagnosis_close.style.display="none";
//      diagnosis_open.style.display="block";
//  }

// })
 
// ////////////////////////////////////////////////////


// //////////////tomzy's script 


// function patients_profile_page(patient_id) {
//  // var patient_id = row.getAttribute('data-patient-id');
//  var action = 'patients_page';
//  var dataString = 'action=' + action + '&patient_id=' + patient_id;

//  $.ajax({
//      type: "POST",
//      url: "../../../backend/config/code.php",
//      data: dataString,
//      dataType: 'json',
//      cache: false,
//      success: function(data) {
//          // Handle the response from the server
//          // You can use the 'patient_id' sent from the server if needed
//          var receivedPatientId = data.patient_id;
//          console.log(receivedPatientId);
//      },
//      error: function(jqXHR, textStatus, errorThrown) {
//          // Handle AJAX request errors
//          console.error("AJAX Error: " + textStatus, errorThrown);
//      }
//  });
// }

















    












    