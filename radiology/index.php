<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raiology</title>
    <link rel="stylesheet" href="style/dashboard.css">
    <link rel="stylesheet" href="style/icons-1.10.2/font/bootstrap-icons.css">
    <link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
        
<!--- START OF SIDEBAR AND NAVBAR-->
<div class="navbar">
        <div class="display__date">
        </div>
          <div class="profile">
            <div class="profile_account hide">
            <img id="image_profile_account" src="../Images/24b23c44ac34e5a0fb80978cd976604c.jpg" alt="">
            <span>Doc. Henculus White</span>
            <button class="btn_submit">Upload Image</button>
           </div>

            <div class="image">
            <img src="../Images/24b23c44ac34e5a0fb80978cd976604c.jpg" alt="userImage"/>
            <div class="active_on"></div>
            </div>
            <span>Dr. Mike</span>
            <i class="bi bi-caret-down-fill" onclick="displayUserProfile()"></i>
                 </div>
                </div>

    <div class="sidebar">
    <div class="sidebar__header"></div>
    <div class="sidebar-body">
      <ul>
        <li class="links active" onclick="appoitment_list_section()">
          <span>Available appoitments</span>
        </li>
        <li class="links" onclick="approved_appoitment__section()">
          <span>Accepted appoitments</span>
        </li>
        <li onclick="document.getElementById('logoutform').submit();" id="logout_link" class="links">
          <span>Logout</span>
          <form method="post" action="../config/code.php" id="logoutform">
            <input type="hidden" name="action" value="logout"/>
          </form>
        </li>
      </ul>
    </div>
  </div>
                 <!--- END OF SIDEBAR AND NAVBAR-->

                 <!--- START OF AVAILABLE APPOITMENT AND APPROVED APPOITMENT SECTION-->
                 <div class="appoitment_section">
            <div class="patient_list_div">
            <div class="search_bar_container">
                <h3>Appoitment details</h3>
                <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search here">
                </div>
                    <table>
                                            <thead>
                                                <tr>
                                                    <td>S/N</td>
                                                    <td>PASSPORT</td>
                                                    <td>Patient Name</td>
                                                    <td>Patient ID</td>
                                                    <td>Date</td>
                                                    <td>Time</td>
                                                    <td>Accept</td>
                                                    <td>Reject</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td>1</td>
                                                <td>
                                                        <img src="" alt="">
                                                </td>
                                                <td>Kingsley effiong</td>
                                                <td>PAT0001</td>
                                                <td>23/09/2000</td>
                                                <td>23:00</td>
                                              <td>
                                              <button class="accept-btn" type="button" onclick="show_radiology_input()">Accept</button>
                                              </td>
                                              <td>
                                              <button class="reject-btn">Reject</button>
                                              </td>
                                              </tr>
                                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>


<div class="approved_appoitment hide">  
<div class="patient_list_div">
            <div class="search_bar_container">
                <h3>Approved appoitments</h3>
                <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search here">
                </div>
                <table>
                                            <thead>
                                                <tr>
                                                    <td>S/N</td>
                                                    <td>PASSPORT</td>
                                                    <td>Patient Name</td>
                                                    <td>patient id</td>
                                                    <td>Status</td>
                                                    <td>Delete Patient</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td>1</td>
                                                <td>
                                                        <img src="" alt="">
                                                </td>
                                                <td>Kingsley effiong</td>
                                                <td>PAT0001</td>
                                                <td>Pending transaction</td>
                                        <td><i class="bi bi-x-square"></i></td>
                                              </tr>
                                            </tbody>
                                            <tbody>
                                              <tr>
                                                <td>1</td>
                                                <td>
                                                        <img src="" alt="">
                                                </td>
                                                <td>Kingsley effiong</td>
                                                <td>PAT0001</td>
                                                <td>
                                                        <button class="accept-btn" onclick="uploadResult()">Upload test result</button>
                                                </td>
                                        <td>
                                                <i class="bi bi-x-square"></i>
                                        </td>
                                              </tr>
                                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>
   <!--- END OF AVAILABLE APPOITMENT AND APPROVED APPOITMENT SECTION-->

                       <!--- START OF RADILOGY INPUT-->
<div class="radiology_input hide">
<div class="radiology_container">
                 <!--- INPUT 1-->
      <div class="radiography" onClick="show_radiography_form()">
        <h3>X-ray (Radiography)</h3>
        <i class="bi bi-plus-lg" id="radiography_plus_icon"></i>
        <i class="bi bi-dash-lg"  id="radiography_minus_icon"></i>
      </div>
      <form class="radiography_form hide">
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Chest X-ray (CXR)</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="5000" class="checkbox_cal">
          <label for="">Abdominal X-ray</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="15000" class="checkbox_cal">
          <label for="">Skeletal X-ray</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Dental X-ray</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Barium Swallow</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Fluoroscopy</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Voiding Cystourethrogram (VCUG)</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Intravenous Pyelogram (IVP)</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Mammography</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Bone X-ray (Bone Radiography)</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Sinus X-ray (Paranasal Sinus Radiography)</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">X-ray Arthrogram</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Hysterosalpingography (HSG)</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Cervical Spine X-ray</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Thoracic Spine X-ray</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Lumbar Spine X-ray</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">X-ray for Foreign Body Detection</label>
        </div>
      </form>

              <!--- INPUT 2-->
      <div class="tomography_scan" onClick="show_tomography_scan_form()">
        <h3>Computed Tomography (CT) Scan</h3>
        <i class="bi bi-plus-lg" id="tomography_scan_plus_icon"></i>
        <i class="bi bi-dash-lg"  id="tomography_scan_minus_icon"></i>
      </div>
      <form class="tomography_scan_form hide">
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Head CT</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="5000" class="checkbox_cal">
          <label for="">Chest CT</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="15000" class="checkbox_cal">
          <label for="">Abdominal CT</label>Cardiac CT
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Whole-body CT</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Cardiac CT</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">CT Angiography (CTA)</label>
        </div>
      </form>

              <!--- INPUT 3-->
      <div class="magnetic" onClick="show_magnetic_form()">
        <h3>Magnetic Resonance Imaging (MRI)</h3>
        <i class="bi bi-plus-lg" id="magnetic_plus_icon"></i>
        <i class="bi bi-dash-lg"  id="magnetic_minus_icon"></i>
    </div>
    <form class="magnetic_form hide">
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Brain MRIT</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="5000" class="checkbox_cal">
          <label for="">Spine MRI</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="15000" class="checkbox_cal">
          <label for="">Abdominal MRIT</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Pelvic MRI</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Joint MRI</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Cardiac MRI</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Functional MRI (fMRI)</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Magnetic Resonance Angiography (MRA)</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Breast MRI</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Breast MRI</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Musculoskeletal MRI</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Whole-body MRI</label>
        </div>
      </form>

                                <!--- INPUT 4-->
      <div class="ultrasound" onClick="show_ultrasound_form()">
        <h3>Ultrasound (Sonography)</h3>
        <i class="bi bi-plus-lg" id="ultrasound_plus_icon"></i>
        <i class="bi bi-dash-lg"  id="ultrasound_minus_icon"></i>
    </div>
    <form class="ultrasound_form hide">
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Abdominal Ultrasound</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="5000" class="checkbox_cal">
          <label for="">Pelvic Ultrasound</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="15000" class="checkbox_cal">
          <label for="">Obstetric Ultrasound</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Breast Ultrasound</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Vascular Ultrasound</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Renal Ultrasound</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Thyroid Ultrasound</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Testicular Ultrasound</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Musculoskeletal Ultrasound</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Transcranial Doppler Ultrasound</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Echocardiography (Cardiac Ultrasound)</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Carotid Ultrasound</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Transvaginal Ultrasound</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Transrectal Ultrasound</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Abdominal Aortic Ultrasound</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Pelvic Floor Ultrasound</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Endorectal Ultrasound</label>
        </div>
      </form>

                                <!--- INPUT 5-->
      <div class="nuclear" onClick="show_nuclear_form()">
        <h3>Nuclear Medicine Imaging</h3>
        <i class="bi bi-plus-lg" id="nuclear_plus_icon"></i>
        <i class="bi bi-dash-lg"  id="nuclear_minus_icon"></i>
    </div>
    <form class="nuclear_form hide">
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Positron Emission Tomography (PET) Scan</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="5000" class="checkbox_cal">
          <label for="">Bone Scintigraphy (Bone Scan)</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="15000" class="checkbox_cal">
          <label for="">Thyroid Scan</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Renal Scintigraphy</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Gallium Scan</label>
        </div>
      </form>

                          <!--- INPUT 6-->
      <div class="fluoroscopy" onClick="show_fluoroscopy_form()">
        <h3>Fluoroscopy</h3>
        <i class="bi bi-plus-lg" id="fluoroscopy_plus_icon"></i>
        <i class="bi bi-dash-lg"  id="fluoroscopy_minus_icon"></i>
    </div>
    <form class="fluoroscopy_form hide">
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Angiography</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Discography</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Gastrointestinal Fluoroscopy</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Arthrography</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Myelographyy</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Arthrography</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Cholangiographyy</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Cystographyy</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Hysterosalpingography (HSG)</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Lumbar Puncture (Fluoroscopic Guidance)</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Sinus Fluoroscopy</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="5000" class="checkbox_cal">
          <label for="">Swallowing Studies</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="15000" class="checkbox_cal">
          <label for="">Catheter Placements</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Joint Injections</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="1500" class="checkbox_cal">
          <label for="">Barium Studies</label>
        </div>
      </form>

                                      <!--- INPUT 7-->
      <div class="mammography" onClick="show_mammography_form()">
        <h3>Mammography</h3>
        <i class="bi bi-plus-lg" id="mammography_plus_icon"></i>
        <i class="bi bi-dash-lg"  id="mammography_minus_icon"></i>
    </div>
    <form class="mammography_form hide">
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Screening Mammography</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Diagnostic Mammography</label>
        </div>
      </form>
      <div class="interventional_radiology" onClick="show_interventional_radiology_form()">
        <h3>Interventional Radiology Procedures</h3>
        <i class="bi bi-plus-lg" id="interventional_radiology_plus_icon"></i>
        <i class="bi bi-dash-lg"  id="interventional_radiology_minus_icon"></i>
    </div>
    <form class="interventional_radiology_form hide">
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Angiography</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Embolization</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Biopsies (various types)</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Drainage Procedures</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Stent Placement</label>
        </div>
      </form>

                                      <!--- INPUT 8-->
      <div class="magnetic_resonance" onClick="show_magnetic_resonance_form()">
        <h3>Magnetic Resonance Angiography (MRA)</h3>
        <i class="bi bi-plus-lg" id="magnetic_resonance_plus_icon"></i>
        <i class="bi bi-dash-lg"  id="magnetic_resonance_minus_icon"></i>
    </div>
    <form class="magnetic_resonance_form hide">
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Head and Neck MRA</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Abdominal and Pelvic MRA</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Peripheral MRA</label>
        </div>
      </form>

                                <!--- INPUT 9-->
      <div class="dual_energy" onClick="show_dual_energy_form()">
        <h3>Dual-Energy X-ray Absorptiometry (DEXA or DXA) Scan</h3>
        <i class="bi bi-plus-lg" id="dual_energy_plus_icon"></i>
        <i class="bi bi-dash-lg"  id="dual_energy_minus_icon"></i>
    </div>
    <form class="dual_energy_form hide">
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Bone Mineral Density (BMD) Scan</label>
        </div>
      </form>
      <div class="chest_x_ray" onClick="show_chest_x_ray_form()">
        <h3>Chest X-ray</h3>
        <i class="bi bi-plus-lg" id="chest_x_ray_plus_icon"></i>
        <i class="bi bi-dash-lg"  id="chest_x_ray_minus_icon"></i>
    </div>
    <form class="chest_x_ray_form hide">
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Routine Chest X-ray</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Portable Chest X-ray</label>
        </div>
      </form>

                    <!--- INPUT 10-->
      <div class="myelography" onClick="show_myelography_form()">
        <h3>Myelography</h3>
        <i class="bi bi-plus-lg" id="myelography_plus_icon"></i>
        <i class="bi bi-dash-lg"  id="myelography_minus_icon"></i>
    </div>
    <form class="myelography_form hide">
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Spinal Cord Imaging</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Spinal Cord Imaging</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Cervical Myelography</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Thoracic Myelography</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Lumbar Myelography</label>
        </div>
      </form>

                          <!--- INPUT 11-->
      <div class="arthrography" onClick="show_arthrography_form()">
        <h3>Arthrography</h3>
        <i class="bi bi-plus-lg" id="arthrography_plus_icon"></i>
        <i class="bi bi-dash-lg"  id="arthrography_minus_icon"></i>
    </div>
    <form class="arthrography_form hide">
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Joint Imaging with Contrast</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Shoulder Arthrogram</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Knee Arthrogram</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Hip Arthrogram</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Wrist Arthrogram</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Ankle Arthrogram</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Temporomandibular Joint (TMJ) Arthrogram</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Elbow Arthrogram</label>
        </div>
      </form>

                          <!--- INPUT 12-->
      <div class="hysterosalpingography" onClick="show_hysterosalpingography_form()">
        <h3>Hysterosalpingography (HSG)</h3>
        <i class="bi bi-plus-lg" id="hysterosalpingography_plus_icon"></i>
        <i class="bi bi-dash-lg"  id="hysterosalpingography_minus_icon"></i>
    </div>
    <form class="hysterosalpingography_form hide">
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Hysterosalpingogram (HSG)</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Uterine Cavity Assessment</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Fallopian Tube Assessment</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Tubal Patency Evaluation</label>
        </div>
      </form>

                                <!--- INPUT 13-->
      <div class="cholangiography" onClick="show_cholangiography_form()">
        <h3>Cholangiography</h3>
        <i class="bi bi-plus-lg" id="cholangiography_plus_icon"></i>
        <i class="bi bi-dash-lg"  id="cholangiography_minus_icon"></i>
    </div>
    <form class="cholangiography_form hide">
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Percutaneous Transhepatic Cholangiography (PTC)</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Endoscopic Retrograde Cholangiopancreatography (ERCP)</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Magnetic Resonance Cholangiopancreatography (MRCP)</label>
        </div>
      </form>

                                <!--- INPUT 14-->
      <div class="angiography" onClick="show_angiography_form()">
        <h3>CT Angiography (CTA)</h3>
        <i class="bi bi-plus-lg" id="angiography_plus_icon"></i>
        <i class="bi bi-dash-lg"  id="angiography_minus_icon"></i>
    </div>
    <form class="angiography_form hide">
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Head and Neck CTA</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Chest CTA</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Abdominal and Pelvic CTA</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Peripheral CTA</label>
        </div>
      </form>

                          <!--- INPUT 15-->
      <div class="functional_mri" onClick="show_functional_mri_form()">
        <h3>Functional MRI (fMRI)</h3>
        <i class="bi bi-plus-lg" id="functional_mri_plus_icon"></i>
        <i class="bi bi-dash-lg"  id="functional_mri_minus_icon"></i>
    </div>
    <form class="functional_mri_form hide">
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Brain Function Mapping</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Cognitive Function Assessment</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Language Processing Evaluation</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Memory Assessment</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Pain Response Mapping</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Emotional Response Evaluation</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Motor Function Mapping</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Visual Processing Studies</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Auditory Processing Studies</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Task-Based fMRI</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Resting-State fMRI</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Connectivity Studies</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Decision-Making Assessment</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Social Cognition Studies</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Executive Function Evaluation</label>
        </div>
      </form>

                                <!--- INPUT 16-->
      <div class="cardiac_imaging" onClick="show_cardiac_imaging_form()">
        <h3>Cardiac Imaging</h3>
        <i class="bi bi-plus-lg" id="cardiac_imaging_plus_icon"></i>
        <i class="bi bi-dash-lg"  id="cardiac_imaging_minus_icon"></i>
    </div>
    <form class="cardiac_imaging_form hide">
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Cardiac Magnetic Resonance Imaging (Cardiac MRI)</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Cardiac Computed Tomography (Cardiac CT)</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Echocardiography</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Nuclear Stress Test</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Cardiac Catheterization</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Coronary Angiography</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Myocardial Perfusion Imaging</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Doppler Ultrasound</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Transesophageal Echocardiogram (TEE)</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Cardiac Positron Emission Tomography (Cardiac PET)</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Cardiac Magnetic Resonance Angiography (Cardiac MRA)</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Stress Echocardiogram</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Decision-Making Assessment</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Social Cognition Studies</label>
        </div>
        <div class="form_control">
          <input type="checkbox" value="4000" class="checkbox_cal">
          <label for="">Executive Function Evaluation</label>
        </div>
      </form>
      <button id="btn" class="save" onClick="show_test_booking()">Book</button>
</div>
<!--- END OF RADIOLOGY INPUT-->

<!--- START OF TEST BOOKING SECTION-->
<div class="test_booking hide">
<i class="bi bi-x-square" onclick="hide_test_booking()"></i>
<h3>Test Booking</h3>
<table id="dataTable">
        <thead>
                <td>Test </td>
                <td>Amount</td>
        </thead>
        <tbody>
        </tbody>
</table>
<div class="total">
        <p>Total</p>
        <p id="total">0.000.00</p>
</div>
<button class="btn">Book Now</button>
</div>
<div class="overlay hide"></div>
<!--- END OF TEST BOOKING SECTION-->


<!--- START OF TEST RESULT UPLOAD-->
<div class="result hide">
<i class="bi bi-x-square" onclick="closeResult()"></i>
<h3>RADIOLOGY RESULT</h3>
<div class="profile_div">
<div class="profile_name">
<h3>Princess Esther</h3>
<h3>PAT0002</h3>
</div>
<div class="img_div">
<img src ="../Images/24cc97ebee8475a31c597fdb32b32d3a.jpg"></img>
</img>
</div>
</div>
<div class="result_for_diagnosis_and_complaint_upload">
        <div class="flex_control">
        <label>Diagnosis</label>
        <input type= "text"></input>
        </div>
        <div class="flex_control">
        <label>Complaints</label>
        <textarea col="10" row="10"></textarea>
        </div>
        <div class="flex_control">
        <label>Upload Test Result</label>
        <input type= "file"></input>
        </div>
</div>
<button>Submit</button>
</div>
<!--- END OF TEST RESULT UPLOAD-->
</div>
  <!---SCRIPTS-->
        <script src="js/script.js"></script>
        <script src="js/jquery-v3.6.1.min.js"></script>
</body>
</html>