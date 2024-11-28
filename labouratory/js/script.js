
///////////////////////////////////////
// Modal window
const modal = document.querySelector('.modal');

function openModal(modalId) {
  const modal = document.getElementById(modalId);
  
  // Create and append overlay
  const overlay = document.createElement('div');
  overlay.className = "overlay";
  overlay.onclick = () => closeModal(modalId); // Close modal when overlay is clicked
  document.querySelector('body').appendChild(overlay);
  
  // Show modal
  modal.classList.remove('hidden');
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  
  // Hide modal
  modal.classList.add('hidden');
  
  // Remove overlay
  const overlay = document.querySelector('.overlay');
  if (overlay) {
    overlay.remove();
  }
}

//////////////////////////////////////
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
     
     //PROFILE IMAGE
     function displayUserProfile(){
        document.querySelector(".profile_account").classList.toggle("hide");
    };

    
function appoitment_list_section(){
    $(".appoitment_section").removeClass('hide')
    $(".lab_input").addClass("hide");
    $('.approved_appoitment').addClass('hide')
}

function approved_appoitment__section(){
    $('.approved_appoitment').removeClass('hide')
    $('.appoitment_section').addClass('hide')
    $('.lab_input').addClass('hide')
}

function uploadResult(){
$('.result').removeClass('hide')
$('.lab_input').removeClass('hide')
$('.lab_container').addClass('hide')
}
function closeResult(){
    $('.result').addClass('hide')
$('.lab_input').addClass('hide')
$('.lab_container').addClass('hide')
}


    //Disable all checkboxes
        const checkboxes = document.querySelectorAll(".checkbox");
        checkboxes.forEach(function(checkbox){
        checkbox.checked = false;
        });

            //Update the table with the test inputs and price
        function update_table(){
                const tableBody = document.getElementById('dataTable').getElementsByTagName('tbody')[0];
                
                tableBody.innerHTML = "";
                const checkboxes = document.querySelectorAll(".checkbox");
                checkboxes.forEach(function(checkbox){
                        if(checkbox.checked){
                        var newRow = tableBody.insertRow();
                        var cell1 = newRow.insertCell(0);
                         cell1.textContent = checkbox.parentNode.textContent.trim().replace(/[^a-zA-Z\s]/g, '');
                        var cell2 = newRow.insertCell(1);
                        cell2.textContent = checkbox.value;
                        }
                })
        }

function updateSum() {
    let sum = 0;
    const checkboxes = document.querySelectorAll(".checkbox");
    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            sum += parseInt(checkbox.value, 10);
        }
    })
    let testSum = document.querySelector("#totalLabTest");
    testSum.textContent = `₦ ${new Intl.NumberFormat('en-NG').format(sum)}`;
}


checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', () => {
        update_table(); 
        updateSum();  
    });
});



function uncheckLabTest(){
        const checkboxs = document.querySelectorAll(".checkbox");
        checkboxs.forEach(function(checkbox){
              checkbox.checked = false;
                })
}


function showtestBooking(){
    openModal('test--booking');
    updateSum();
    update_table();
}
function collapseTestBooking(){
    closeModal('test--booking');
}

   







//Lab  Inputs
//For immunoassay_section Dropdown
function form1(){
    document.querySelector(".form1").classList.toggle("hidden");
document.querySelector("#open_id_1").style.display = "none";
document.querySelector("#close_id_1").style.display = "block";
    if(document.querySelector(".form1").classList.contains("hidden")){
        document.querySelector("#close_id_1").style.display = "none";
        document.querySelector("#open_id_1").style.display = "block";
    }
};

//For immunoassay_section Dropdown
function form2 () {
    document.querySelector(".form2").classList.toggle("hidden");
    document.querySelector("#open_id_2").style.display = "none";
    document.querySelector("#close_id_2").style.display = "block";
    if(document.querySelector(".form2").classList.contains("hidden")){
        document.querySelector("#close_id_2").style.display = "none";
        document.querySelector("#open_id_2").style.display = "block";
    }
};


//For thyroid_section Dropdown
function form3(){
    document.querySelector(".form3").classList.toggle("hidden");
    document.querySelector("#open_id_3").style.display = "none";
    document.querySelector("#close_id_3").style.display = "block";
    if(document.querySelector(".form3").classList.contains("hidden")){
        document.querySelector("#close_id_3").style.display = "none";
        document.querySelector("#open_id_3").style.display = "block";
    }
};


//For tumor_section Dropdown
function form4() {

    document.querySelector(".form4").classList.toggle("hidden");
    document.querySelector("#open_id_4").style.display = "none";
    document.querySelector("#close_id_4").style.display = "block";
    if(document.querySelector(".form4").classList.contains("hidden")){
        document.querySelector("#close_id_4").style.display = "none";
        document.querySelector("#open_id_4").style.display = "block";
    }
};


//For blood_section Dropdown
function form5(){
    document.querySelector(".form5").classList.toggle("hidden");
    document.querySelector("#open_id_5").style.display = "none";
    document.querySelector("#close_id_5").style.display = "block";
    if(document.querySelector(".form5").classList.contains("hidden")){
        document.querySelector("#close_id_5").style.display = "none";
        document.querySelector("#open_id_5").style.display = "block";
    }
};


//For food_section Dropdown
function form6(){
    document.querySelector(".form6").classList.toggle("hidden");
    document.querySelector("#open_id_6").style.display = "none";
    document.querySelector("#close_id_6").style.display = "block";
    if(document.querySelector(".form6").classList.contains("hidden")){
        document.querySelector("#close_id_6").style.display = "none";
        document.querySelector("#open_id_6").style.display = "block";
    }
};

//For microbiology_section Dropdown
function form7(){
    document.querySelector(".form7").classList.toggle("hidden");
    document.querySelector("#open_id_7").style.display = "none";
    document.querySelector("#close_id_7").style.display = "block";
    if(document.querySelector(".form7").classList.contains("hidden")){
        document.querySelector("#close_id_7").style.display = "none";
        document.querySelector("#open_id_7").style.display = "block";
    }
};


//For histopathology Dropdown
function form8(){
    document.querySelector(".form8").classList.toggle("hidden");
    document.querySelector("#open_id_8").style.display = "none";
    document.querySelector("#close_id_8").style.display = "block";
    if(document.querySelector(".form8").classList.contains("hidden")){
        document.querySelector("#close_id_8").style.display = "none";
        document.querySelector("#open_id_8").style.display = "block";
    }
};

//For haematology Dropdown
function form9(){
    document.querySelector(".form9").classList.toggle("hidden");
    document.querySelector("#open_id_9").style.display = "none";
    document.querySelector("#close_id_9").style.display = "block";
    if(document.querySelector(".form9").classList.contains("hidden")){
        document.querySelector("#close_id_9").style.display = "none";
        document.querySelector("#open_id_9").style.display = "block";
    }
};

function bookNow() {
    var action = 'bookLabouratoryTest';
    var dataTable = document.querySelector("#dataTable tbody");
    var totalLabTestElement = document.getElementById('totalLabTest');
    var patient_id = document.getElementById('patient_id').value;  
    var totalLabTest = totalLabTestElement.textContent || totalLabTestElement.innerText;
    var appointment_id = document.getElementById('appointment_id').value;
    console.log(totalLabTest);
    var tests = {};

    dataTable.querySelectorAll('tr').forEach(function(row) {
        var test = row.cells[0].textContent;
        var amount = row.cells[1].textContent;
        tests[test] = amount;
    });

    var data = { 
        action: action, 
        totalAmount: totalLabTest, 
        tests: tests,
        patient_id: patient_id,
        appointment_id: appointment_id,
    };

    $.ajax({
        type: 'POST',
        url: "config/code.php",
        data: data,
        cache: false,
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                alert("Lab test booked");
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', status, error);
            console.log('Response:', xhr.responseText);
        },
    });
}
