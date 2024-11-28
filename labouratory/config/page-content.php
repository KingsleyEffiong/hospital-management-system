

<?php include "../../backend/config/connection.php";



$patient_id = $_POST['patient_id'];
$appointment_id = $_POST['appointment_id'];

 

    // Fetch patient details using your _get_patient_details function
    $fetch_patient_profile = $callclass->_get_patient_details($conn, $patient_id);

    // Decode the JSON response
    $patient_profile_array = json_decode($fetch_patient_profile, true);

    if ($patient_profile_array) {
        // Extract patient details from the response
        $sn = $patient_profile_array['sn'];
        $patient_name = $patient_profile_array['fullname'];
        $email = $patient_profile_array['email'];
        $gender = $patient_profile_array['gender'];
        $dateofbirth = $patient_profile_array['dateofbirth'];
        $address = $patient_profile_array['address'];
        $phonenumber = $patient_profile_array['phonenumber'];
        $status_id = $patient_profile_array['status_id'];
        $category_id = $patient_profile_array['category_id'];
        $date = $patient_profile_array['date'];
        $last_login = $patient_profile_array['last_login'];
        $passport = $patient_profile_array['patient_passport'];
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

        // // Prepare the HTML content to be sent back as the response
        // $html_response = '<div class="all_sections_input">';
        // // Construct HTML content with patient details
        // // ...
        // $html_response .= '</div>';

        // // Send the HTML response back to the client
        // echo $html_response;
    } else {
        // Send an error message back if patient details not found
        echo '<p>Error: Patient details not found</p>';
    }


?>





<div class="display">






        <!--- START OF LABOURATORY INPUT-->
        <div class="lab_input ">
                <div class="lab_container">
                                <!--- INPUT 1-->
                <div class="immunoassay" onClick="form1()">
                <h3>Immunoassay Single Tests</h3>
                <i class="bi bi-plus-lg" id="open_id_1"></i>
                <i class="bi bi-dash-lg" id="close_id_1"></i>
                </div>
                <form action="" class="form1 hidden">
                <div class="form_control">
                        <input type="checkbox" value="3000" class="checkbox">
                        <label for="">Pregnancy Test (hCG)</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="2000" class="checkbox">
                        <label for="">HIV Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="1000" class="checkbox">
                        <label for="">Hepatitis B Surface Antigen (HBsAg)</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="2000" class="checkbox">
                        <label for="">Thyroid Stimulating Hormone (TSH) Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="2000" class="checkbox">
                        <label for="">Troponin Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">IgE Allergy Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="5000" class="checkbox">
                        <label for="">Anti-Nuclear Antibody (ANA) Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Drug Screening Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="6000" class="checkbox">
                        <label for="">C-reactive Protein (CRP) Test </label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="6000" class="checkbox">
                        <label for="">Rheumatoid Factor (RF) Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">D-dimer Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Insulin Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Cortisol Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Digoxin Test</label>
                </div>
                </form>

                                <!--- INPUT 2-->
                <div class="clinical_chemistry" onClick="form2()">
                <h3>Clinical Chemistry</h3>
                <i class="bi bi-plus-lg" id="open_id_2"></i>
                <i class="bi bi-dash-lg" id="close_id_2"></i>
                </div>
                <form action="" class="form2 hidden">
                <div class="form_control">
                        <input type="checkbox" value="3000" class="checkbox">
                        <label for="">Full electrolytes</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Sodium</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="1000" class="checkbox">
                        <label for="">Potassium</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="2000" class="checkbox">
                        <label for="">Bicarbonate</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="2000" class="checkbox">
                        <label for="">Chloride</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Urea</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="5000" class="checkbox">
                        <label for="">Electrolytes & urea (e & u)</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Creatinine</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="6000" class="checkbox">
                        <label for="">Diabetes screening</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="6000" class="checkbox">
                        <label for="">Hba 1c</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Urinalysis</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Fasting blood sugar (fbs)</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Random blood sugar</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">2-hr pp blood sugar</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="2000" class="checkbox">
                        <label for="">Kidney function test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Liver function test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Glycaemic Studies</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Lipid Profile (Full)</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="6000" class="checkbox">
                        <label for="">Renal Function Test</label>
                </div>
                </form>

                                <!--- INPUT 3-->
                <div class="thyroid" onClick="form3()">
                <h3>Thyroid function test</h3>
                <i class="bi bi-plus-lg" id="open_id_3"></i>
                <i class="bi bi-dash-lg" id="close_id_3"></i>
                </div>
                <form action="" class="form3 hidden">
                <div class="form_control">
                        <input type="checkbox" value="3000" class="checkbox">
                        <label for="">Thyroid Stimulating Hormone (TSH) Test </label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Free Thyroxine (FT4) Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="1000" class="checkbox">
                        <label for="">Total Thyroxine (T4) Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="2000" class="checkbox">
                        <label for="">Free Triiodothyronine (FT3) Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="2000" class="checkbox">
                        <label for="">Total Triiodothyronine (T3) Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Thyroid Peroxidase Antibodies (TPOAb) Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="5000" class="checkbox">
                        <label for="">Thyroglobulin Antibodies (TgAb) Test</label>
                </div>
                </form>
                                        <!--- INPUT 4-->
                <div class="tumor" onClick="form4()">
                <h3>Tumor markers</h3>
                <i class="bi bi-plus-lg" id="open_id_4"></i>
                <i class="bi bi-dash-lg" id="close_id_4"></i>
                </div>
                <form action="" class="form4 hidden">
                <div class="form_control">
                        <input type="checkbox" value="3000" class="checkbox">
                        <label for="">Prostate-Specific Antigen (PSA) Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Carcinoembryonic Antigen (CEA) Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="1000" class="checkbox">
                        <label for="">Alpha-Fetoprotein (AFP) Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="2000" class="checkbox">
                        <label for="">CA 125 Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="2000" class="checkbox">
                        <label for="">CA 19-9 Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">CA 15-3 Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="5000" class="checkbox">
                        <label for="">Beta-2 Microglobulin (B2M) Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Human Chorionic Gonadotropin (hCG) Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="6000" class="checkbox">
                        <label for="">Thyroglobulin Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="6000" class="checkbox">
                        <label for="">Neuron-Specific Enolase (NSE) Test</label>
                </div>
                </form>
                                        <!--- INPUT 5-->
                <div class="blood" onClick="form5()">
                <h3>Blood banking</h3>
                <i class="bi bi-plus-lg" id="open_id_5"></i>
                <i class="bi bi-dash-lg" id="close_id_5"></i>
                </div>
                <form action="" class="form5 hidden">
                <div class="form_control">
                        <input type="checkbox" value="3000" class="checkbox">
                        <label for="">Blood Typing (ABO and Rh)</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Crossmatching</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="1000" class="checkbox">
                        <label for="">Direct Antiglobulin Test (DAT)</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="2000" class="checkbox">
                        <label for="">Indirect Antiglobulin Test (IAT) </label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="2000" class="checkbox">
                        <label for="">Antibody Screen</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Blood Donor Screening</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="5000" class="checkbox">
                        <label for="">Blood Component Separation </label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Platelet Function Assay</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="6000" class="checkbox">
                        <label for="">Coagulation Factor Assays /label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="6000" class="checkbox">
                        <label for="">Hemoglobin Electrophoresis</label>
                </div>
                </form>
                                        <!--- INPUT 6-->
                <div class="food" onClick="form6()">
                <h3>Food handler test</h3>
                <i class="bi bi-plus-lg" id="open_id_6"></i>
                <i class="bi bi-dash-lg" id="close_id_6"></i>
                </div>
                <form action="" class="form6 hidden">
                <div class="form_control">
                        <input type="checkbox" value="3000" class="checkbox">
                        <label for="">Fecal Coliform Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Salmonella Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="1000" class="checkbox">
                        <label for="">Staphylococcus aureus Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="2000" class="checkbox">
                        <label for="">Escherichia coli (E. coli) Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="2000" class="checkbox">
                        <label for="">Hepatitis A Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Norovirus Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="5000" class="checkbox">
                        <label for="">Listeria Test </label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Shigella Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="6000" class="checkbox">
                        <label for="">Campylobacter Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="6000" class="checkbox">
                        <label for="">Total Plate Count (TPC) Test</label>
                </div>
                </form>

                                        <!--- INPUT 7-->
                <div class="microbiology" onClick="form7()">
                <h3>Microbiology and parasitology</h3>
                <i class="bi bi-plus-lg" id="open_id_7"></i>
                <i class="bi bi-dash-lg" id="close_id_7"></i>
                </div>
                <form action="" class="form7 hidden">
                <div class="form_control">
                        <input type="checkbox" value="3000" class="checkbox">
                        <label for="">Gram Stain</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">SAcid-Fast Stain</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="1000" class="checkbox">
                        <label for="">Culture and Sensitivity (C&S)</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="2000" class="checkbox">
                        <label for="">Blood Culture </label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="2000" class="checkbox">
                        <label for="">Urine Culture </label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Fungal Culture</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="5000" class="checkbox">
                        <label for="">Parasitological Examination</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Widal Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="6000" class="checkbox">
                        <label for="">Rapid Strep Test</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="6000" class="checkbox">
                        <label for="">Giemsa Stain </label>
                </div>
                </form>

                                        <!--- INPUT 8-->
                <div class="histopathology" onClick="form8()">
                <h3>Histopathology</h3>
                <i class="bi bi-plus-lg" id="open_id_8"></i>
                <i class="bi bi-dash-lg" id="close_id_8"></i>
                </div>
                <form action="" class="form8 hidden">
                <div class="form_control">
                        <input type="checkbox" value="3000" class="checkbox">
                        <label for="">Biopsy</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Frozen Section</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="1000" class="checkbox">
                        <label for="">Fine Needle Aspiration (FNA)</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="2000" class="checkbox">
                        <label for="">Immunohistochemistry (IHC) </label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="2000" class="checkbox">
                        <label for="">Hematoxylin and Eosin (H&E) Stain </label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Special Stains</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="5000" class="checkbox">
                        <label for="">Immunofluorescence /label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">In Situ Hybridization (ISH)</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="6000" class="checkbox">
                        <label for="">Tumor Grading </label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="6000" class="checkbox">
                        <label for="">Tumor Markers in Histopathology</label>
                </div>
                </form>
                                        <!--- INPUT 10-->
                <div class="haematology" onClick="form9()">
                <h3>Haematology</h3>
                <i class="bi bi-plus-lg" id="open_id_9"></i>
                <i class="bi bi-dash-lg" id="close_id_9"></i>
                </div>
                <form action="" class="form9 hidden">
                <div class="form_control">
                        <input type="checkbox" value="3000" class="checkbox">
                        <label for="">Complete Blood Count (CBC) </label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Hemoglobin Electrophoresis</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="1000" class="checkbox">
                        <label for="">Erythrocyte Sedimentation Rate (ESR) </label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="2000" class="checkbox">
                        <label for="">Coagulation Studies </label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value ="2000" class="checkbox">
                        <label for="">Peripheral Blood Smear </label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="0" class="checkbox">
                        <label for="">Reticulocyte Count</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="5000" class="checkbox">
                        <label for="">Blood Film Examination </label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="8000" class="checkbox">
                        <label for="">Bone Marrow Aspiration </label>
                </div>
                <div class="form_control">
                        <input type="checkbox" id="platelet" value="6000" class="checkbox">
                        <label for="">Platelet Count (#6,000)</label>
                </div>
                <div class="form_control">
                        <input type="checkbox" value="12000" class="checkbox">
                        <label for="">Bleeding Time and Clotting Time</label>
                </div>
                </form>
                <button id="btn" class="save" onclick="showtestBooking()">Book</button>
        </div>
</div>
<div class="overlay hidden"></div>   


        <div class="modal hidden" id="test--booking">
                <button class="btn--close-modal" onclick="closeModal('test--booking'); uncheckLabTest()">&times;</button>

                        <h2 class="modal__header">
                        Book 
                        <span class="highlight">labouartory test</span>
                        </h2>
                        <table id="dataTable">
                        <thead>
                                <td>Test </td>
                                <td>Amount</td>
                        </thead>
                        <tbody>
                        </tbody>
                </table>
                <div class="totalprice">
                        <p>Total</p>
                        <p id="totalLabTest"></p>
                        <input type="hidden" value="<?php echo $patient_id ?>" id="patient_id"/>
                        <input type="hidden" value="<?php echo $appointment_id ?>" id="appointment_id"/>
                        
                </div>
                <button onclick="bookNow()">Book Now</button>
                <button onclick="collapseTestBooking()">Add more test</button>
        </div>
        <!-- <div class="overlay hidden"></div>  -->



        </div>
       
