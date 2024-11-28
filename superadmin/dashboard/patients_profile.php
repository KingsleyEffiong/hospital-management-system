<!-- ?php include '../../backend/config/connection.php'?> -->
<?php include '../../../backend/config/code.php'?>

<?php include '../../backend/dashboardconfig/session-validation.php';
include '../../../backend/config/search.php'?>



<?php


$patient_id = $_POST['patient_id'];


// $case == 'patient_profile_page';

// if (isset($_POST['patient_id'])) {
//     $patient_id = $_POST['patient_id'];
//     // Now you can use $patient_id in your PHP code

//     echo json_encode(array('patient_id' => $patient_id));
// } else {
//     $response = ['result' => 'error', 'message' => 'No patient_id received'];
//     echo json_encode($response);
// }





    
$fetch_patient_profile = $callclass->_get_patient_details($conn, $patient_id);

$patient_profile_array = json_decode($fetch_patient_profile, true);

if ($patient_profile_array) {
    $sn = $patient_profile_array['sn'];
    $fullname = $patient_profile_array['fullname'];
    $email = $patient_profile_array['email'];
    $gender = $patient_profile_array['gender'];
    $dateofbirth = $patient_profile_array['dateofbirth'];
    $address = $patient_profile_array['address'];
    $phonenumber = $patient_profile_array['phonenumber'];
    $status_id = $patient_profile_array['status_id'];
    $category_id = $patient_profile_array['category_id'];
    $date = $patient_profile_array['date'];
    $last_login = $patient_profile_array['last_login'];
    $passport = $patient_profile_array['passport'];
    ///next of kin
    $kname = $patient_profile_array['kname'];
    $kgender = $patient_profile_array['kgender'];
    $kphonenumber = $patient_profile_array['kphonenumber'];
    $krelationship = $patient_profile_array['krelationship'];
    $kaddress = $patient_profile_array['kaddress'];





    $occupation = $patient_profile_array['occupation'];
    $past_obsterics = $patient_profile_array['past_obsterics'];
    $medical_history = $patient_profile_array['medical_history'];
    $sexual_history = $patient_profile_array['sexual_history'];
    $past_disease = $patient_profile_array['past_disease'];
    $family_disease = $patient_profile_array['family_disease'];
    $past_surgery = $patient_profile_array['past_surgery'];

} else {
    $fullname=  "error";
    // Handle the case where the patient details were not found.
    // You might want to return an error message or take other appropriate action.
}

    $fetch_status = $callclass->_get_status_details($conn, $status_id);
    $status_array = json_decode($fetch_status, true);
    
    if ($status_id) {
        $status_name = $status_array['status_name'];
    } else {
        // Handle the case where status details were not found.
        // You might want to return an error message or take other appropriate action.
    }




    // $fetch_category = $callclass->_get_category_details($conn, $category_id);

    // Check if the category details were successfully retrieved
    if ($fetch_category !== false) {
        $category_array = json_decode($fetch_category, true);
    
        // Check if category_name exists in the response
        if (isset($category_array['category_name'])) {
            $category_name = $category_array['category_name'];
        } else {
            // Handle the case where category_name was not found in the response.
            // You might want to return an error message or take other appropriate action.
        }
    } else {
        // Handle the case where category details were not found.
        // You might want to return an error message or take other appropriate action.
    }
 ?>


<!-- end of php declarations -->












<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/patients-profile.css">
    <link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="../../awesome-font/css/font-awesome.min.css" type="text/css" rel="stylesheet"/>
    <script src ="js/patient.js"></script>
    <script src="js/jquery-v3.6.1.min.js"></script>

    <title>Patients Profiles</title>
</head>
<body>

<div class="content">
            <div  class="patient-navbar">
                <i class="fa fa-long-arrow-left t" id='back-arrow-patientslist' onClick='backWardArrow()'></i>
                <h1><?php echo $fullname ?> PROFILE</h1>
            </div>
            <!--timer-->
            <div class="container-timer">
                <div class="timer-box-content">
                <div class="timer-box" id="timer">5</div>
                <div class="timer-box">22</div>
                <div class="timer-box">16</div>
                <div class="timer-box">23</div>
            </div>
            <h3 class="timer-text">Days Hours Mins Secs</h3>
        </div>
            <div class="all_input">
        <div class="patient_info">
            <h3>Patient Personal Information</h3> 
             <i class="fa fa-plus" id="info_open"></i> 
             <i class="fa fa-minus" id="info_close"></i>
         </div>
         <div class="info-accordion info-hidden" id="info">
            <div class="info_details">
             <i class="fa fa-user-circle-o"></i>
            <h2>BIO DATA</h2>
        </div>
            <div class="flex-info1">
                <h4 class="info">FULL NAME:</h4>
                <h4 class="info"><?php echo $fullname?> </h4>
            </div>
                <div class="flex-info1">
                    <h4 class="info">GENDER:</h4>
                    <h4 class="info"><?php echo $gender?></h4>
                </div>
                <div class="flex-info1">
                    <h4 class="info">DATE OF BIRTH:</h4>
                    <h4 class="info"><?php echo $dateofbirth?></h4>
                </div>
                <div class="flex-info1">
                    <h4 class="info">HOME ADDRESS:</h4>
                    <h4 class="info"><?php echo $address?></h4>
                </div>
                <div class="flex-info1">
                    <h4 class="info">PHONE NUMBER:</h4>
                    <h4 class="info"><?php echo $phonenumber?></h4>
                </div><br>
                    <div class="info_details">
                <i class="fa fa-user-circle-o"></i>
                <h2>NEXT OF KINS</h2>
            </div>
                <div class="flex-info1">
                    <h4 class="info">FULL NAME:</h4>
                    <h4 class="info"><?php echo $kname?></h4>
                </div>
                <div class="flex-info1">
                    <h4 class="info">GENDER:</h4>
                    <h4 class="info"><?php echo $kgender?></h4>
                </div>
                <div class="flex-info1">
                    <h4 class="info">HOME ADDRESS:</h4>
                    <h4 class="info"><?php echo $kaddress?></h4>
                </div>
                <div class="flex-info1">
                    <h4 class="info">PHONE NUMBER:</h4>
                    <h4 class="info"><?php echo $kphonenumber?></h4>
                </div>
                <div class="flex-info1">
                    <h4 class="info">RELATIONSHIP:</h4>
                    <h4 class="info"><?php echo $krelationship ?></h4>
                </div>
            <div class="info_details">
            <i class="fa fa-history"></i> 
            <h2>SOCIAL HISTORY</h2>
        </div>
                <div class="flex-info1">
                    <h4 class="info">Present Occupation:</h4>
                    <h4 class="info"><?php echo $occupation ?></h4>
                </div>
                <div class="info_details">
                <i class="fa fa-hdd-o "></i> 
            <h2>PAST OBSTERICS</h2>
        </div>
                <div class="flex-info1">
                    <h4 class="info"><?php echo $past_obsterics ?></h4>
                </div>
                <div class="info_details">
                <i class="fa fa-hospital-o"></i> 
            <h2>MEDICAL HISTORY</h2>
        </div>
                <div class="flex-info1">
                    <h4 class="info"><?php echo $medical_history ?></h4>
                </div>
                <div class="info_details">
                <i class="fa fa-user-circle"></i> 
            <h2>SEXUAL HISTORY</h2>
        </div>  
                <div class="flex-info1">
                    <h4 class="info"><?php echo $sexual_history ?></h4>
                </div>
                <div class="info_details">
                <i class="fa fa-tachometer"></i> 
            <h2>PAST DISEASE</h2>
        </div>  
                <div class="flex-info1">
                    <h4 class="info"><?php echo $past_disease ?></h4>
                </div>
                <div class="info_details">
                <i class="fa fa-tachometer"></i> 
            <h2>FAMILY DISEASE</h2>
        </div>
                <div class="flex-info1">
                    <h4 class="info"><?php echo $family_disease ?></h4>
                </div>
                <div class="info_details">
                <i class="fa fa-thermometer-0 (alias)"></i> 
            <h2>PAST SURGERY</h2>
        </div>
                <div class="flex-info1">
                    <h4 class="info"><?php echo $past_surgery ?></h4>
                </div>
</div>
<div class="lab_info">
            <h3>Labouratory Examination</h3> 
             <i class="fa fa-plus" id="lab_open"></i> 
             <i class="fa fa-minus" id="lab_close"></i>
         </div>
         <div class="lab_input hidden">
       <div class="immunoassay">
      <span>Immunoassay Single Tests</span>
      <i class="fa fa-plus" id="open_id_1"></i>
        <i class="fa fa-minus" id="close_id_1"></i>
       </div>
       <form action="" class="form1 hidden">
        <div class="form_control">
                <input type="checkbox">
                <label for="">Pregnancy Test (hCG) (#3,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">HIV Test</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Hepatitis B Surface Antigen (HBsAg) (#1,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Thyroid Stimulating Hormone (TSH) Test (#2,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Troponin Test (#2,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">IgE Allergy Test</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Anti-Nuclear Antibody (ANA) Test(#5,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Drug Screening Test</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">C-reactive Protein (CRP) Test (#6,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Rheumatoid Factor (RF) Test (#6,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">D-dimer Test</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Insulin Test</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Cortisol Test</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Digoxin Test</label>
        </div>
       </form>

       <div class="clinical_chemistry">
      <span>Clinical Chemistry</span>
      <i class="fa fa-plus" id="open_id_2"></i>
        <i class="fa fa-minus" id="close_id_2"></i>
       </div>
       <form action="" class="form2 hidden">
        <div class="form_control">
                <input type="checkbox">
                <label for="">Full electrolytes (#3,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Sodium</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for=""black;ck;tassium (#1,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Bicarbonate (#2,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Chloride (#2,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Urea</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Electrolytes & urea (e & u) (#5,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Creatinine</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Diabetes screening (#6,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Hba 1c (#6,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Urinalysis</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Fasting blood sugar (fbs)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Random blood sugar</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">2-hr pp blood sugar</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Kidney function test (#2,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Liver function test</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Glycaemic Studies</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Lipid Profile (Full)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Renal Function Test (#6,000)</label>
        </div>
       </form>
       <div class="thyroid">
      <span>Thyroid function test</span>
      <i class="fa fa-plus" id="open_id_3"></i>
        <i class="fa fa-minus" id="close_id_3"></i>
       </div>
       <form action="" class="form3 hidden">
        <div class="form_control">
                <input type="checkbox">
                <label for="">Thyroid Stimulating Hormone (TSH) Test (#3,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Free Thyroxine (FT4) Test</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Total Thyroxine (T4) Test (#1,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Free Triiodothyronine (FT3) Test (#2,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Total Triiodothyronine (T3) Test (#2,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Thyroid Peroxidase Antibodies (TPOAb) Test</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Thyroglobulin Antibodies (TgAb) Test(#5,000)</label>
        </div>
       </form>
       <div class="tumor">
      <span>Tumor markers</span>
      <i class="fa fa-plus" id="open_id_4"></i>
        <i class="fa fa-minus" id="close_id_4"></i>
       </div>
       <form action="" class="form4 hidden">
        <div class="form_control">
                <input type="checkbox">
                <label for="">Prostate-Specific Antigen (PSA) Test (#3,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Carcinoembryonic Antigen (CEA) Test</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Alpha-Fetoprotein (AFP) Test (#1,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">CA 125 Test (#2,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">CA 19-9 Test (#2,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">CA 15-3 Test</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Beta-2 Microglobulin (B2M) Test (#5,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Human Chorionic Gonadotropin (hCG) Test</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Thyroglobulin Test (#6,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Neuron-Specific Enolase (NSE) Test(#6,000)</label>
        </div>
       </form>
       <div class="blood">
      <span>Blood banking</span>
      <i class="fa fa-plus" id="open_id_5"></i>
        <i class="fa fa-minus" id="close_id_5"></i>
       </div>
       <form action="" class="form5 hidden">
        <div class="form_control">
                <input type="checkbox">
                <label for="">Blood Typing (ABO and Rh) (#3,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Crossmatching</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Direct Antiglobulin Test (DAT) (#1,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Indirect Antiglobulin Test (IAT) (#2,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Antibody Screen (#2,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Blood Donor Screening</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Blood Component Separation (#5,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Platelet Function Assay</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Coagulation Factor Assays (#6,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Hemoglobin Electrophoresis (#6,000)</label>
        </div>
       </form>
       <div class="food">
      <span>Food handler test</span>
      <i class="fa fa-plus" id="open_id_6"></i>
        <i class="fa fa-minus" id="close_id_6"></i>
       </div>
       <form action="" class="form6 hidden">
        <div class="form_control">
                <input type="checkbox">
                <label for="">Fecal Coliform Test (#3,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Salmonella Test</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Staphylococcus aureus Test (#1,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Escherichia coli (E. coli) Test (#2,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Hepatitis A Test (#2,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Norovirus Test</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Listeria Test (#5,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Shigella Test</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Campylobacter Test (#6,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">otal Plate Count (TPC) Test (#6,000)</label>
        </div>
       </form>
       <div class="microbiology">
      <span>Microbiology and parasitology</span>
      <i class="fa fa-plus" id="open_id_7"></i>
        <i class="fa fa-minus" id="close_id_7"></i>
       </div>
       <form action="" class="form7 hidden">
        <div class="form_control">
                <input type="checkbox">
                <label for="">Gram Stain (#3,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">SAcid-Fast Stain</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Culture and Sensitivity (C&S) (#1,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Blood Culture (#2,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Urine Culture (#2,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Fungal Culture</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Parasitological Examination (#5,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Widal Test</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Rapid Strep Test (#6,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Giemsa Stain (#6,000)</label>
        </div>
       </form>
       <div class="histopathology">
      <span>Histopathology</span>
      <i class="fa fa-plus" id="open_id_8"></i>
        <i class="fa fa-minus" id="close_id_8"></i>
       </div>
       <form action="" class="form8 hidden">
        <div class="form_control">
                <input type="checkbox">
                <label for="">Biopsy (#3,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Frozen Section</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Fine Needle Aspiration (FNA) (#1,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Immunohistochemistry (IHC) (#2,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Hematoxylin and Eosin (H&E) Stain (#2,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Special Stains</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Immunofluorescence (#5,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">In Situ Hybridization (ISH)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Tumor Grading (#6,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Tumor Markers in Histopathology (#6,000)</label>
        </div>
       </form>
       <div class="haematology">
      <span>Haematology</span>
      <i class="fa fa-plus" id="open_id_9"></i>
        <i class="fa fa-minus" id="close_id_9"></i>
       </div>
       <form action="" class="form9 hidden">
        <div class="form_control">
                <input type="checkbox">
                <label for="">Complete Blood Count (CBC) (#3,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Hemoglobin Electrophoresis</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Erythrocyte Sedimentation Rate (ESR) (#1,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Coagulation Studies (#2,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Peripheral Blood Smear (#2,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Reticulocyte Count</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Blood Film Examination (#5,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Bone Marrow Aspiration</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Platelet Count (#6,000)</label>
        </div>
        <div class="form_control">
                <input type="checkbox">
                <label for="">Bleeding Time and Clotting Time (#6,000)</label>
        </div>
       </form>
       </div>
       <div class="complain">
    <h3>Complaints</h3>
    <i class="fa fa-plus" id="complaint_icon_plus"></i>
    <i class="fa fa-minus" id="complaint_icon_minus"></i>
   </div>
   <div class="complaint-section hidden">
        <form action="">
            <div class="complaint_form-control">
            <label for="major_complaints">Major Complaints & Duration</label>
            <input type="text" class="complaint-input">
            </div>
            <div class="complaint_form-control">
            <label for="major_complaints">History of Presenting Complaints</label>
            <input type="text" class="complaint-input">
            </div>
            <div class="complaint_form-control">
            <label for="major_complaints">Family & Social History</label>
            <input type="text" class="complaint-input">
            </div>
            <div class="complaint_form-control">
            <label for="major_complaints">Past Surgical/Medical History</label>
            <input type="text"  class="complaint-input">
            </div>
</div>
        </form>
          <!--Start of the System & Review section--->
          <div class="system">
    <h3>System Review and Symptom</h3>
    <i class="fa fa-plus" id="system_icon_plus"></i>
    <i class="fa fa-minus" id="system_icon_minus"></i>
   </div>
               <div class="system_review-section hidden">
        <div class="drop-down1">
            <span>General</span>
            <i class="fa fa-minus" id="close_1"></i>
            <i class="fa fa-plus" id="open_1"></i>
        </div>
            <form action="" class="gen_form1 hidden">
                <div class="form-control">
                <label for="headache">Headache</label>
                <div class="radio">
                <input type="radio" id="yes" name="h1" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="h1" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Fatigue?</label>
                <div class="radio">
                <input type="radio" id="yes" name="f1" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="f1" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Overall Weekness?</label>
                <div class="radio">
                <input type="radio" id="yes" name="o1" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="01" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Change in appetite?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ca1" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ca1" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Change in weight</label>
                <div class="radio">
                <input type="radio" id="yes" name="cw1" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="cw1" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Fever</label>
                <div class="radio">
                <input type="radio" id="yes" name="fv1" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="fv1" />
                <label for="no">No</label>
                </div>
  </div>
  </form>
  <div class="drop-down2">
            <span>Skin</span>
            <i class="fa fa-minus" id="close_2"></i>
            <i class="fa fa-plus" id="open_2"></i>
        </div>
        <form action="" class="skin_form2 hidden">
                <div class="form-control">
                <label for="headache">Change in mole(s)?</label>
                <div class="radio">
                <input type="radio" id="yes" name="cm" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="cm" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Hair or nail changes?</label>
                <div class="radio">
                <input type="radio" id="yes" name="h/n" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="h/n" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Color or texture change ?</label>
                <div class="radio">
                <input type="radio" id="yes" name="c/t" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="c/t" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Itching or Rashes ?</label>
                <div class="radio">
                <input type="radio" id="yes" name="i/r" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="i/r" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Sores </label>
                <div class="radio">
                <input type="radio" id="yes" name="s" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="s" />
                <label for="no">No</label>
                </div>
  </div>
  </form>
  <div class="drop-down3">
            <span>Endocrine</span>
            <i class="fa fa-minus" id="close_3"></i>
            <i class="fa fa-plus" id="open_3"></i>
        </div>
        <form action="" class="endo_form3 hidden">
                <div class="form-control">
                <label for="headache">Enlarging glove or hat size?</label>
                <div class="radio">
                <input type="radio" id="yes" name="e/hs" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="e/hs" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Excessive thirst?</label>
                <div class="radio">
                <input type="radio" id="yes" name="et" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="et" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Salt craving ?</label>
                <div class="radio">
                <input type="radio" id="yes" name="sc" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="sc" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Lost of Sexual drive (libido)?</label>
                <div class="radio">
                <input type="radio" id="yes" name="lsd" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="lsd" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Heat or cold intolerance?</label>
                <div class="radio">
                <input type="radio" id="yes" name="hci" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="hci" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Thyriod enlargement?</label>
                <div class="radio">
                <input type="radio" id="yes" name="te" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="te" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Abnormal growth?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ag"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ag"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Increased appetite?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ia"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ia"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Increased urine production?</label>
                <div class="radio">
                <input type="radio" id="yes" name="iup"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="iup"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Thyriod trouble?</label>
                <div class="radio">
                <input type="radio" id="yes" name="tr"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="tr"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Excessive swearing?</label>
                <div class="radio">
                <input type="radio" id="yes" name="es"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="es"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Diabetes?</label>
                <div class="radio">
                <input type="radio" id="yes" name="d"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="d"/>
                <label for="no">No</label>
                </div>
  </div>
  </form>
  <div class="drop-down4">
            <span>Hematopoietic</span>
            <i class="fa fa-minus" id="close_4"></i>
            <i class="fa fa-plus" id="open_4"></i>
        </div>
        <form action="" class="hermato_form4 hidden">
                <div class="form-control">
                <label for="headache">Chemotherapy Management for Hematopoietic Disorders?</label>
                <div class="radio">
                <input type="radio" id="yes" name="cmhd" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="cmhd" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Radiation therapy integration for Hermatopoietic condition?</label>
                <div class="radio">
                <input type="radio" id="yes" name="rtihc" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="rtihc" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Immunotherapy traking for Hermatopoietic disorder ?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ithd" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ithd" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Steam cell transplantation?</label>
                <div class="radio">
                <input type="radio" id="yes" name="sct" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="sct" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Anticoagulant medication?</label>
                <div class="radio">
                <input type="radio" id="yes" name="am" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="am" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Iron chelation?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ic" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ic" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Hematopoietic growth?</label>
                <div class="radio">
                <input type="radio" id="yes" name="hg"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="hg"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Blood tranfusion?</label>
                <div class="radio">
                <input type="radio" id="yes" name="bt"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="bt"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Erthropoletin?</label>
                <div class="radio">
                <input type="radio" id="yes" name="etin"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="etin"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Granalocyte colony-stimulation?</label>
                <div class="radio">
                <input type="radio" id="yes" name="gcs"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="gcs"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Intravenous immunogubullin?</label>
                <div class="radio">
                <input type="radio" id="yes" name="imin"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="imin"/>
                <label for="no">No</label>
                </div>
  </div>
  </form>
  <div class="drop-down5">
            <span>Muscoskeletal</span>
            <i class="fa fa-minus" id="close_5"></i>
            <i class="fa fa-plus" id="open_5"></i>
        </div>
        <form action="" class="mus_form5 hidden">
                <div class="form-control">
                <label for="headache">Physical therapy?</label>
                <div class="radio">
                <input type="radio" id="yes" name="pt" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="pt" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Occupational therapy?</label>
                <div class="radio">
                <input type="radio" id="yes" name="occpt" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="occpt" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Orthopedic consultion ?</label>
                <div class="radio">
                <input type="radio" id="yes" name="oc" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="oc" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Pain medication?</label>
                <div class="radio">
                <input type="radio" id="yes" name="pm" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="pm" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Join aspiration?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ja" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ja" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Muscle relaxant?</label>
                <div class="radio">
                <input type="radio" id="yes" name="mr" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="mr" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Surgical intervention?</label>
                <div class="radio">
                <input type="radio" id="yes" name="si"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="si"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Anti-inflammation?</label>
                <div class="radio">
                <input type="radio" id="yes" name="anti-in"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="anti-in"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Assistive?</label>
                <div class="radio">
                <input type="radio" id="yes" name="assistive"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="assistive"/>
                <label for="no">No</label>
                </div>
  </div>
  </form>
  <div class="drop-down6">
            <span>Head & Neck</span>
            <i class="fa fa-minus" id="close_6"></i>
            <i class="fa fa-plus" id="open_6"></i>
        </div>
        <form action="" class="head_neck_form6 hidden">
                <div class="form-control">
                <label for="headache">Symptom for head and neck issue?</label>
                <div class="radio">
                <input type="radio" id="yes" name="shni" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="shni" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Record ear, nose, throat (ENT) exams?</label>
                <div class="radio">
                <input type="radio" id="yes" name="rente" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="rente" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Head and neck cancers ?</label>
                <div class="radio">
                <input type="radio" id="yes" name="hnc" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="hnc" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Dental and oral health?</label>
                <div class="radio">
                <input type="radio" id="yes" name="doh" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="doh" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Speech and swallowing assesment?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ssa" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ssa" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Biopsies for neck masses?</label>
                <div class="radio">
                <input type="radio" id="yes" name="bnm" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="bnm" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Thyriod function tests?</label>
                <div class="radio">
                <input type="radio" id="yes" name="tft"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="tft"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Salivary gland disorders?</label>
                <div class="radio">
                <input type="radio" id="yes" name="sgd"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="sgd"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">TMJ evaluations?</label>
                <div class="radio">
                <input type="radio" id="yes" name="tmj"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="tmj"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">imaging for skull and bones?</label>
                <div class="radio">
                <input type="radio" id="yes" name="is&b"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="is&b"/>
                <label for="no">No</label>
                </div>
  </div>
  </form>
  <div class="drop-down7">
            <span>Ears, Nose, Sinuses, Mouth & Throat</span>
            <i class="fa fa-minus" id="close_7"></i>
            <i class="fa fa-plus" id="open_7"></i>
        </div>
        <form action="" class="ear_nose_form7 hidden">
                <div class="form-control">
                <label for="headache">Hearing loss?</label>
                <div class="radio">
                <input type="radio" id="yes" name="hl" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="hl" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Tinnitus Evalution?</label>
                <div class="radio">
                <input type="radio" id="yes" name="te" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="te" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Ear pain?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ep" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ep" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Ear discharge?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ed" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ed" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Nasal congestion?</label>
                <div class="radio">
                <input type="radio" id="yes" name="nc" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="nc" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Sinus discharge?</label>
                <div class="radio">
                <input type="radio" id="yes" name="sd" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="sd" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Allergic Rhinitis?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ar"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ar"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Oral pain?</label>
                <div class="radio">
                <input type="radio" id="yes" name="op"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="op"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Throat pain?</label>
                <div class="radio">
                <input type="radio" id="yes" name="tp"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="tp"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Dysphagia?</label>
                <div class="radio">
                <input type="radio" id="yes" name="dysphagia"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="dysphagia"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Mouth Lessions?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ml"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ml"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Voice changes?</label>
                <div class="radio">
                <input type="radio" id="yes" name="vc"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="vc"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Halitosis(Bad breath)?</label>
                <div class="radio">
                <input type="radio" id="yes" name="halitosis"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="halitosis"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Gag reflex?</label>
                <div class="radio">
                <input type="radio" id="yes" name="gr"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="gr"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Oral thrush?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ot"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ot"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Tonsillitis?</label>
                <div class="radio">
                <input type="radio" id="yes" name="Tonsillitis"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="Tonsillitis"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Hoarseness?</label>
                <div class="radio">
                <input type="radio" id="yes" name="Hoarseness"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="Hoarseness"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Oral  cancer?</label>
                <div class="radio">
                <input type="radio" id="yes" name="oral_cancer"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="oral_cancer"/>
                <label for="no">No</label>
                </div>
</div>
                <div class="form-control">
                <label for="headache">Recurrent Sore Throat?</label>
                <div class="radio">
                <input type="radio" id="yes" name="rsc"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="rsc"/>
                <label for="no">No</label>
                </div>
  </div>
  </form>
  <div class="drop-down8">
            <span>Breast</span>
            <i class="fa fa-minus" id="close_8"></i>
            <i class="fa fa-plus" id="open_8"></i>
        </div>
        <form action="" class="breast_form8 hidden">
                <div class="form-control">
                <label for="headache">Breast Disorder?</label>
                <div class="radio">
                <input type="radio" id="yes" name="bd" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="bd" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Surgical Invervention monitoring for breast condition?</label>
                <div class="radio">
                <input type="radio" id="yes" name="simbc" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="simbc" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Hormone replacement?</label>
                <div class="radio">
                <input type="radio" id="yes" name="hr" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="hr" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Breast imaging follow-up?</label>
                <div class="radio">
                <input type="radio" id="yes" name="bifu" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="bifu" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Reconstructive surgery?</label>
                <div class="radio">
                <input type="radio" id="yes" name="rs" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="rs" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Breast pain?</label>
                <div class="radio">
                <input type="radio" id="yes" name="bp" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="bp" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Nutritional?</label>
                <div class="radio">
                <input type="radio" id="yes" name="n"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="n"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Pschosicial Intergration?</label>
                <div class="radio">
                <input type="radio" id="yes" name="pi"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="pi"/>
                <label for="no">No</label>
                </div>
  </div>
  </form>
  <div class="drop-down9">
            <span>Respiratory</span>
            <i class="fa fa-minus" id="close_9"></i>
            <i class="fa fa-plus" id="open_9"></i>
        </div>
        <form action="" class="res_form9 hidden">
                <div class="form-control">
                <label for="headache">Respiratory symptom?</label>
                <div class="radio">
                <input type="radio" id="yes" name="rs" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="rs" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Pulmonary function test?</label>
                <div class="radio">
                <input type="radio" id="yes" name="pft" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="pft" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Chest X-ray imaging?</label>
                <div class="radio">
                <input type="radio" id="yes" name="cxi" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="cxi" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Oxygen therapy?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ot" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ot" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Ventilator?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ventilator" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ventilator" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Bronchoscopy?</label>
                <div class="radio">
                <input type="radio" id="yes" name="bronchoscopy" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="bronchoscopy" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Pneumonia?</label>
                <div class="radio">
                <input type="radio" id="yes" name="pneumonia"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="pneumonia"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Asthma action?</label>
                <div class="radio">
                <input type="radio" id="yes" name="aa"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="aa"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Respiratory infection?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ri"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ri"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">COPD?</label>
                <div class="radio">
                <input type="radio" id="yes" name="copd"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="copd"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Spiometer test?</label>
                <div class="radio">
                <input type="radio" id="yes" name="st"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="st"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Smoking cessation?</label>
                <div class="radio">
                <input type="radio" id="yes" name="sc"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="sc"/>
                <label for="no">No</label>
                </div>
  </div>
  </form>
  <div class="drop-down10">
            <span>Cardiovascular</span>
            <i class="fa fa-minus" id="close_10"></i>
            <i class="fa fa-plus" id="open_10"></i>
        </div>
        <form action="" class="car_form10 hidden">
                <div class="form-control">
                <label for="headache">Cardiovascular condition?</label>
                <div class="radio">
                <input type="radio" id="yes" name="cardiovascular_condition" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="cardiovascular_condition" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Bood pressure?</label>
                <div class="radio">
                <input type="radio" id="yes" name="bp" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="bp" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Cholesterol Level?</label>
                <div class="radio">
                <input type="radio" id="yes" name="cl" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="cl" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Antiplatelet?</label>
                <div class="radio">
                <input type="radio" id="yes" name="antiplatelet" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="antiplatelet" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Beta-Blocker?</label>
                <div class="radio">
                <input type="radio" id="yes" name="bb" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="bb" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Angiotensin-converting enzyme (ACE) inhibitor?</label>
                <div class="radio">
                <input type="radio" id="yes" name="acei" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="acei" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Anticoagulant?</label>
                <div class="radio">
                <input type="radio" id="yes" name="anticoagulant"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="anticoagulant"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Cardiac?</label>
                <div class="radio">
                <input type="radio" id="yes" name="c"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="c"/>
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Heart failure & Diuretic?</label>
                <div class="radio">
                <input type="radio" id="yes" name="hf&d"/>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="hf&d"/>
                <label for="no">No</label>
                </div>
  </div>
  </form>
  <div class="drop-down11">
            <span>Gastrointestinal</span>
            <i class="fa fa-minus" id="close_11"></i>
            <i class="fa fa-plus" id="open_11"></i>
</div>
<form action="" class="gas_form11 hidden">
                <div class="form-control">
                <label for="headache">Gastrointestinal symptom?</label>
                <div class="radio">
                <input type="radio" id="yes" name="gastrointestinal_symptom" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="gastrointestinal_symptom" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Endoscopy?</label>
                <div class="radio">
                <input type="radio" id="yes" name="endoscopy" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="endoscopy" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Colonoscopy?</label>
                <div class="radio">
                <input type="radio" id="yes" name="colonoscopy" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="colonoscopy" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Radiology Issue?</label>
                <div class="radio">
                <input type="radio" id="yes" name="ri" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="ri" />
                <label for="no">No</label>
                </div>
  </div>
                <div class="form-control">
                <label for="headache">Gastrointestinal disorder?</label>
                <div class="radio">
                <input type="radio" id="yes" name="gd" />
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="gd" />
                <label for="no">No</label>
                </div>
  </div>
  </form>
  </div>
  <div class="patient_vitals">
            <h3>Vitals</h3> 
             <i class="fa fa-plus" id="vitals_open"></i> 
             <i class="fa fa-minus" id="vitals_close"></i>
         </div>
         <div class="show_vitals hidden">
         <div class="impatient_vital">
                <h3>Impatient Vitals</h3>
         </div>
         <div class="table_div">
                <table>
                        <thead>
                        <th>24/7</th>
                        <th>Temp(C)</th>
                        <th>BP(mmHg)</th>
                        <th>Pulse(bp/m)</th>
                        <th>Resp.(cm)</th>
                        <th>Spo2(%)</th>
                        <th>Weight(kg)</th>
                        <th>Intake(m/s)</th>
                        <th>Output</th>
                        <th>BMI</th>
                        </thead>
                        <tbody>
                                <td>
                                        <span class="date_time_vital">1st Jan. 2024</span>
                                        <span class="date_time_vital" >2:30pm</span>
                                </td>
                                <td>36</td>
                                <td>120/60</td>
                                <td>60</td>
                                <td>16</td>
                                <td>97</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                        </tbody>
                        <tbody>
                                <td>
                                        <span class="date_time_vital">2nd Jan. 2024</span>
                                        <span class="date_time_vital" >4.10pm</span>
                                </td>
                                <td>36</td>
                                <td>120/60</td>
                                <td>60</td>
                                <td>16</td>
                                <td>97</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                        </tbody>
                        <tbody>
                                <td>
                                        <span class="date_time_vital">18th Feb. 2024</span>
                                        <span class="date_time_vital" >11.00am</span>
                                </td>
                                <td>36</td>
                                <td>120/60</td>
                                <td>60</td>
                                <td>16</td>
                                <td>97</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                        </tbody>
                </table>
         </div>
         <div class="outpatient_vital">
                <h3>Outpatient Vitals</h3>
         </div>
         <div class="table_div">
                <table>
                        <thead>
                        <th>Every visit</th>
                        <th>Temp(C)</th>
                        <th>BP(mmHg)</th>
                        <th>Pulse(bp/m)</th>
                        <th>Resp.(cm)</th>
                        <th>Weight(kg)</th>
                        </thead>
                        <tbody>
                                <td>
                                        <span class="date_time_vital">7th Mar. 2024</span>
                                        <span class="date_time_vital" >9:30pm</span>
                                </td>
                                <td>36</td>
                                <td>120/60</td>
                                <td>16</td>
                                <td>97</td>
                                <td>0</td>
                        </tbody>
                        <tbody>
                                <td>
                                        <span class="date_time_vital">22nd July. 2024</span>
                                        <span class="date_time_vital" >.5.00pm</span>
                                </td>
                                <td>36</td>
                                <td>120/60</td>
                                <td>16</td>
                                <td>97</td>
                                <td>0</td>
                        </tbody>
                        <tbody>
                                <td>
                                        <span class="date_time_vital">4th Aug. 2024</span>
                                        <span class="date_time_vital" >1.00am</span>
                                </td>
                                <td>36</td>
                                <td>120/60</td>
                                <td>16</td>
                                <td>97</td>
                                <td>0</td>
                        </tbody>
                </table>
         </div>
         <div class="antenatal_vital">
                <h3>Antenatal</h3>
         </div>
         <div class="table_div">
                <table>
                        <thead>
                        <th>Every visit</th>
                        <th>LMP</th>
                        <th>EDO</th>
                        <th>Gravida</th>
                        <th>Parity</th>
                        <th>Recent FP</th>
                        <th>Infertility</th>
                        <th>Paternal BG</th>
                        <th>Paternal Gen</th>
                        <th>Date</th>
                        </thead>
                        <tbody>
                                <td>
                                        <span class="date_time_vital">7th Mar. 2024</span>
                                        <span class="date_time_vital" >9:30pm</span>
                                </td>
                                <td>Unknown</td>
                                <td>Thu 8 Jun</td>
                                <td>1</td>
                                <td>Nill</td>
                                <td>Nill</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>Tue 15 Nov 2024</td>
                        </tbody>
                        <tbody>
                        <td>
                                        <span class="date_time_vital">7th Mar. 2024</span>
                                        <span class="date_time_vital" >9:30pm</span>
                                </td>
                                <td>Unknown</td>
                                <td>Thu 8 Jun</td>
                                <td>1</td>
                                <td>Nill</td>
                                <td>Nill</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>Tue 15 Nov 2024</td>
                        </tbody>
                        <tbody>
                        <td>
                                        <span class="date_time_vital">7th Mar. 2024</span>
                                        <span class="date_time_vital" >9:30pm</span>
                                </td>
                                <td>Unknown</td>
                                <td>Thu 8 Jun</td>
                                <td>1</td>
                                <td>Nill</td>
                                <td>Nill</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>Tue 15 Nov 2024</td>
                        </tbody>
                </table>
         </div>
         <div class="antenatal_vital">
                <h3>Postnatal</h3>
         </div>
         <div class="table_div">
                <table>
                        <thead>
                        <th>Every visit</th>
                        <th>LMP</th>
                        <th>EDO</th>
                        <th>Gravida</th>
                        <th>Parity</th>
                        <th>Recent FP</th>
                        <th>Infertility</th>
                        <th>Paternal BG</th>
                        <th>Paternal Gen</th>
                        <th>Date</th>
                        </thead>
                        <tbody>
                                <td>
                                        <span class="date_time_vital">7th Mar. 2024</span>
                                        <span class="date_time_vital" >9:30pm</span>
                                </td>
                                <td>Unknown</td>
                                <td>Thu 8 Jun</td>
                                <td>1</td>
                                <td>Nill</td>
                                <td>Nill</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>Tue 15 Nov 2024</td>
                        </tbody>
                        <tbody>
                        <td>
                                        <span class="date_time_vital">7th Mar. 2024</span>
                                        <span class="date_time_vital" >9:30pm</span>
                                </td>
                                <td>Unknown</td>
                                <td>Thu 8 Jun</td>
                                <td>1</td>
                                <td>Nill</td>
                                <td>Nill</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>Tue 15 Nov 2024</td>
                        </tbody>
                        <tbody>
                        <td>
                                        <span class="date_time_vital">7th Mar. 2024</span>
                                        <span class="date_time_vital" >9:30pm</span>
                                </td>
                                <td>Unknown</td>
                                <td>Thu 8 Jun</td>
                                <td>1</td>
                                <td>Nill</td>
                                <td>Nill</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>Tue 15 Nov 2024</td>
                        </tbody>
                </table>
         </div>
         </div>
         <div class="treatment_prescribtion">
            <h3>Treatment and Prescribtion</h3> 
             <i class="fa fa-plus" id="treatment_prescribtion_open"></i> 
             <i class="fa fa-minus" id="treatment_prescribtion_close"></i>
         </div>
         <div class="table_div_treatment_prescribion hidden">
                <table>
                        <thead>
                        <th>Drugs</th>
                        <th>Strength</th>
                        <th>Mode</th>
                        <th>Administration</th>
                        <th>Dos</th>
                        <th>Unit</th>
                        <th>Frequency</th>
                        <th>Duration</th>
                        <th>Remark</th>
                        <th>Qty</th>
                        <th>Cost</th>
                        </thead>
                        <tbody>
                                <td>Paracetamol</td>
                                <td>25mg</td>
                                <td>Injection</td>
                                <td>IM</td>
                                <td>10</td>
                                <td>3</td>
                                <td>24/hours</td>
                                <td>3</td>
                                <td>Good</td>
                                <td>200</td>
                                <td>$30,000</td>
                        </tbody>

                        <thead>
                        <th>Drugs</th>
                        <th>Strength</th>
                        <th>Mode</th>
                        <th>Dos</th>
                        <th>Unit</th>
                        <th>Frequency</th>
                        <th>Duration</th>
                        <th>Remark</th>
                        <th>Qty</th>
                        <th>Cost</th>
                        </thead>
                        <tbody>
                                <td>Amaten</td>
                                <td>50mg</td>
                                <td>Caplsule</td>
                                <td>10</td>
                                <td>3</td>
                                <td>24/hours</td>
                                <td>3</td>
                                <td>Good</td>
                                <td>200</td>
                                <td>$20,000</td>
                        </tbody>
                </table>
         </div>
         <div class="diagnosis">
            <h3>Diagnosis</h3> 
             <i class="fa fa-plus" id="diagnosis_open"></i> 
             <i class="fa fa-minus" id="diagnosis_close"></i>
         </div>
         <div class="table_div_diagnosis hidden">
         </div>
   </div>
           
             
        <!--End of the System & Review section--->
        <script src ="js/patients-profile.js"></script>
</body>
</html>



