
<?php if($page == 'logins') { ?>
    <select name="logins" id="logins" class="select_staffs">
        <option value="all">Select your Role</option>
        <option value="doctor" onclick="_next_page('next_2');">Doctor Login</option>
        <option value="health_record" onclick="_next_page('next_3');">Health Record & Infomation Manager Login</option>
        <option value="nurse" onclick="_next_page('next_13');">Nurse Login</option>
        <option value="matanity" onclick="_next_page('next_6');">Matanity Manager Login</option>
        <option value="emergency" onclick="_next_page('next_9');">Emergency Manager Login</option>
        <option value="radiology" onclick="_next_page('next_12');">Radiologist Login</option>
        <option value="labouratory" onclick="_next_page('next_4');">labouratory Login</option>
        <option value="intensive_care" onclick="_next_page('next_15');">Intensive Care Manager Login</option>
        <option value="staff_manager" onclick="_next_page('next_5');">Staff Manager Login</option>
        <option value="surgical_suite" onclick="_next_page('next_8');">Surgical Suite Manager Login</option>
        <option value="account_manager" onclick="_next_page('next_7');">Account Manager Login</option>
        <option value="morgue_manager" onclick="_next_page('next_11');">Morgue Manager Login</option>
        <option value="phamacist" onclick="_next_page('next_10');">Pharmacist Manager Login</option>
        <option value="post_anesthesia_unit" onclick="_next_page('next_14');">Post Anesthesia Unit Manager Login</option>
    </select>
    </div>

    <div id="doctor-container"></div>
    <div id="nurse-container"></div>
    <div id="recep-container"></div>
    <div id="lab-container"></div>
    <div id="staff_manager-container"></div>
    <div id="martanity-container"></div>
    <div id="radiologist-container"></div>
    <div id="account_manager-container"></div>
    <div id="surgical_suite_manager-container"></div>
    <div id="emergency_manager-container"></div>
    <div id="pharmacist-container"></div>
    <div id="morgue_manager-container"></div>
    <div class="overlay"></div>
    <!--Animation-->
<div class="loading-overlay"></div>


<?php 

// doctor starts here 
 
 ($page =='doctor_login');


if($s_staff_id != '') {
?>
    <script>
        window.location.href = "<?php echo $website_url?>/doctor";
    </script>
 <?php } ?>
    <div class="fill-form-div login-div hidden" id="next_2">
        <div class="doctor-login">
            <!-- Close icon for the login form -->
            <i class="bi bi-x-square close" id='close-icon-doctor' onclick="cancel();"></i>
            <!-- Title for the login form -->
            <h3 class="login-form-h1">Login (Doctor)</h3>
            <!-- Doctor login form -->
            <form action="config/code.php" id="doctor_loginform" enctype="multipart/form-data" method="post">
                <!-- Email field -->
                <div class="_form_control">
                    <label for='email'>Email</label>
                    <i class="bi-envelope"></i>
                    <input type="email" id="doctor_email" name="email" autoComplete='off'/>
                </div>
                <!-- ID field -->
                <div class="_form_control">
                    <label for='number'>Your ID</label>
                    <i class="bi-key"></i>
                    <input type="text" id="doctor_id" name="number" autoComplete='off'/>
                </div>
                <!-- Password field -->
                <div class="_form_control">
                    <label for='password'>Password</label>
                    <i class="bi-lock"></i>
                    <i class="bi bi-eye show_password hide" id="show_staff_password" onclick="show_staff_password()"></i>
                    <i class="bi bi-eye-slash lock_password" id="lock_staff_password" onclick="show_staff_password()"></i>
                    <input type="password"class="all_password" id="doctor_password" name="password" autoComplete='off'/>
                </div>
                <!-- Hidden input for the action -->
                <input name="action" value="doctor_login" type="hidden"/>
                <!-- Login button -->
                <button type="button" class="btn" id="doctor_login_btn" title="Login" onclick="_doctor_sign_in();">Login</button>
            </form>
        </div>

    </div>

    <!-- record -->
    <?php  ($page=='record_login')  ?>
    
    <div class="fill-form-div login-div hidden" id="next_3">
            <div class="recep-login">
            <!-- Close icon for the login form -->
            <i class="bi bi-x-square close" id='close-icon-nurse' onclick="cancel();"></i>
            <!-- Title for the login form -->
            <h3 class="login-form-h1">Login (Health Records and Information)</h3>
            <!-- Receptionist login form -->
            <form action="config/code.php" id="loginform" enctype="multipart/form-data" method="post">
                <!-- Email field -->
                <div class="_form_control">
                    <label for='email'>Email</label>
                    <i class="bi-envelope"></i>
                    <input type='email' id="email" name="email" autoComplete='off'/>
                </div>
                <!-- ID field -->
                <div class="_form_control">
                    <label for='number'>Your ID</label>
                    <i class="bi-key"></i>
                    <input type="text" id="user_id" name="user_id" autoComplete='off'/>
                </div>
                <!-- Password field -->
                <div class="_form_control">
                    <label for='password'>Password</label>
                    <i class="bi-lock"></i>
                    <i class="bi bi-eye show_password hide" id="show_staff_password" onclick="show_staff_password()"></i>
                    <i class="bi bi-eye-slash lock_password" id="lock_staff_password" onclick="show_staff_password()"></i>
                    <input type="password" id="password" name="spass" autocomplete="off" class="all_password" >
                </div>
                <!-- Hidden input for the action -->
                <input name="action" value="record_login" type="hidden" />
                <!-- Login button -->
                <button type="button" class="btn" id="login_btn" title="Login" onclick="_sign_in();">Login</button>  
            </form>
        </div>

    </div>


    <!-- lab - -->


            <?php if ($page=='lab_login') 
            
       ?>

    <div class="fill-form-div login-div hidden" id="next_4">
        <div class="lab-login">
            <!-- Close icon for the login form -->
            <i class="bi bi-x-circle" id='close-icon-lab' onclick="cancel();"></i>
            <!-- Title for the login form -->
            <h3 class="login-form-h1">Login (Lab Scientist)</h3>
            <!-- Lab scientist login form -->
            <form action="config/code.php" id="lab_loginform" enctype="multipart/form-data" method="post">
                <!-- Email field -->
                <div class="form-control">
                    <label for='email'>Email</label>
                    <i class="fa fa-address-book"></i>
                    <input type='email' id="lab_scientist_email" name="email" autoComplete='off'/>
                </div>
                <!-- ID field -->
                <div class="form-control">
                    <label for='number'>Your ID</label>
                    <i class="fa fa-key"></i>
                    <input type="text" name="number" id="lab_scientist_id" autoComplete='off'/> 
                </div>
                <!-- Password field -->
                <div class="form-control">
                    <label for='password'>Password</label>
                    <i class="fa fa-lock"></i>
                    <input type="password" id="lab_scientist_password" name="spass" autocomplete="off">
                </div>
                <input name="action" value="lab_login" type="hidden" />
                <!-- Login button -->
                <button type="button" id="lab_login_btn" title="Login" onclick="lab_sign_in()" class="btn">Login</button>
            </form>
        </div>

    </div>



 <!-- staff Manager - -->

        <?php if ($page=='staffM_login') ?>
        <div class="fill-form-div login-div" id="next_5">
            <div class="staff_manager-login hidden">
            <!-- Close icon for the login form -->
            <i class="bi bi-x-circle" id='close-icon-staff_manager' onclick="cancel();"></i>
            <i class="fa fa-times-circle"></i>
            <!-- Title for the login form -->
            <h1 class="login-form-h1">Login (Staff Manager)</h1>
            <!-- Staff manager login form -->
            <form action="../backend/config/code.php" id="loginform" enctype="multipart/form-data" method="post">
                <!-- Email field -->
                <div class="form-control">
                    <label for='email'>Email</label>
                    <i class="fa fa-address-book"></i>
                    <input type='email' id="semail" name="email" autoComplete='off'/>
                </div>
                <!-- ID field -->
                <div class="form-control">
                    <label for='number'>Your ID</label>
                    <i class="fa fa-key"></i>
                    <input type="text" name="number" autoComplete='off'/> 
                </div>
                <!-- Password field -->
                <div class="form-control">
                    <label for='password'>Password</label>
                    <i class="fa fa-lock"></i>
                    <input type="password" id="password" name="spass" autocomplete="off">
                </div>
                <!-- Login button -->
                <button type="button" id="login_btn" title="Login" onclick="isStaff_manager_active()" class="btn">Login</button>
            </form>
        </div>

    </div>




 <!-- martanity - -->


    <?php if ($page=='martanity_login') ?>
    <div class="fill-form-div login-div" id="next_6">
        <div class="martanity-login hidden">
        <!-- Close icon for the login form -->
        <i class="bi bi-x-circle" id='close-icon-martanity' onclick="cancel();"></i>
        <!-- Title for the login form -->
        <h1 class="login-form-h1">Login (Martanity)</h1>
        <!-- Martanity login form -->
            <form action="../backend/config/code.php" id="loginform" enctype="multipart/form-data" method="post">
                <!-- Email field -->
                <div class="form-control">
                    <label for='email'>Email</label>
                    <i class="fa fa-address-book"></i>
                    <input type='email' id="email" name="email" autoComplete='off'/>
                </div>
                <!-- ID field -->
                <div class="form-control">
                    <label for='number'>Your ID</label>
                    <i class="fa fa-key"></i>
                    <input type="text" name="number" autoComplete='off'/> 
                </div>
                <!-- Password field -->
                <div class="form-control">
                    <label for='password'>Password</label>
                    <i class="fa fa-lock"></i>
                    <input type="password" id="password" name="spass" autocomplete="off">
                </div>
                <!-- Login button -->
                <button type="button" id="login_btn" title="Login" onclick="isMartinity_active()" class="btn">Login</button>
            </form>
        </div>

    </div>




 <!-- account_manager  - -->


    <?php if ($page=='account_manager_login') ?>
    <div class="fill-form-div login-div" id="next_7">
        <div class="account_manager-login hidden">
        <i class="bi bi-x-circle"  id='close-icon-account_manager' onclick="cancel();"></i>
        <h1 class="login-form-h1">Login (Account Manager)</h1>
            <form>
                <div class="form-control">
                <label for='email'>Email</label>
                <i class="fa fa-address-book"></i>
                <input type="email" name="email" autoComplete='off'/> 
                </div>

                <div class="form-control">
                <label for='number'>Your ID</label>
                <i class="fa fa-key"></i>
                <input type="number" name="number" autoComplete='off'/> 
                </div>

                <div class="form-control">
                <label for='password'>Password</label>
                <i class="fa fa-lock"></i>
                <input type="password" name="password" autoComplete='off'/> 
                </div>
                <button type="button" class="btn" onClick="isAccount_manager_active()">Login</button>
            <form>
        </div>
    </div>



 <!-- surgical_suite_manager  - -->

    <?php if ($page=='surgical_suite_manager_login') ?>
    <div class="fill-form-div login-div" id="next_8">
            <div class="surgical_suite_manager-login hidden">
            <!-- Close icons for the login form -->
            <i class="bi bi-x-circle" id='close-icon-surgical_suite_manager' onclick="cancel();"></i>
            <i class="fa fa-times-circle" id='close-icon-surgical_suite_manager'></i>
            <!-- Title for the login form -->
            <h1 class="login-form-h1">Login (Surgical Suite Manager)</h1>
            <!-- Surgical Suite Manager login form -->
            <form>
                <!-- Email field -->
                <div class="form-control">
                    <label for='email'>Email</label>
                    <i class="fa fa-address-book"></i>
                    <input type="email" name="email" autoComplete='off'/> 
                </div>
                <!-- ID field -->
                <div class="form-control">
                    <label for='number'>Your ID</label>
                    <i class="fa fa-key"></i>
                    <input type="number" name="number" autoComplete='off'/> 
                </div>
                <!-- Password field -->
                <div class="form-control">
                    <label for='password'>Password</label>
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" autoComplete='off'/> 
                </div>
                <!-- Login button -->
                <button type="button" class="btn" onClick="isSurgical_suite_active()">Login</button>
            </form>
        </div>

    </div>



 <!-- emergency_manager -- -->

    <?php if ($page=='emergency_manager_login') ?>
    <div class="fill-form-div login-div" id="next_9">
            <div class="emergency_manager-login hidden">
            <!-- Close icon for the login form -->
            <i class="bi bi-x-circle" id='close-icon-emergency_manager' onclick="cancel();"></i>
            <!-- Title for the login form -->
            <h1 class="login-form-h1">Login (Emergency Manager)</h1>
            <!-- Emergency Manager login form -->
            <form>
                <!-- Email field -->
                <div class="form-control">
                    <label for='email'>Email</label>
                    <i class="fa fa-address-book"></i>
                    <input type="email" name="email" autoComplete='off'/> 
                </div>
                <!-- ID field -->
                <div class="form-control">
                    <label for='number'>Your ID</label>
                    <i class="fa fa-key"></i>
                    <input type="number" name="number" autoComplete='off'/> 
                </div>
                <!-- Password field -->
                <div class="form-control">
                    <label for='password'>Password</label>
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" autoComplete='off'/> 
                </div>
                <!-- Login button -->
                <button type="button" class="btn" onClick="isEmergency_manager_active()">Login</button>
            </form>
        </div>

    </div>


<!-- pharmacist -- -->

    <?php if ($page=='pharmacist_login') ?>
    <div class="fill-form-div login-div" id="next_10">
            <div class="pharmacist-login hidden">
            <!-- Close icon for the login form -->
            <i class="bi bi-x-circle" id='close-icon-pharmacist' onclick="cancel();"></i>
            <!-- Title for the login form -->
            <h1 class="login-form-h1">Login (Pharmacist)</h1>
            <!-- Pharmacist login form -->
            <form>
                <!-- Email field -->
                <div class="form-control">
                    <label for='email'>Email</label>
                    <i class="fa fa-address-book"></i>
                    <input type="email" name="email" autoComplete='off'/> 
                </div>
                <!-- ID field -->
                <div class="form-control">
                    <label for='number'>Your ID</label>
                    <i class="fa fa-key"></i>
                    <input type="number" name="number" autoComplete='off'/> 
                </div>
                <!-- Password field -->
                <div class="form-control">
                    <label for='password'>Password</label>
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" autoComplete='off'/> 
                </div>
                <!-- Login button -->
                <button type="button" class="btn" onClick="open_pharmacy_login_form()">Login</button>
            </form>
        </div>
    </div>



<!--  morgue_manager -- -->

    <?php if ($page=='morgue_manager_login') ?>
    <div class="fill-form-div login-div" id="next_11">
            <div class="morgue_manager-login hidden">
            <!-- Close icon for the login form -->
            <i class="bi bi-x-circle" id='close-icon-morgue_manager' onclick="cancel();"></i>
            <!-- Title for the login form -->
            <h1 class="login-form-h1">Login (Morgue Manager)</h1>
            <!-- Morgue Manager login form -->
            <form>
                <!-- Email field -->
                <div class="form-control">
                    <label for='email'>Email</label>
                    <i class="fa fa-address-book"></i>
                    <input type="email" name="email" autoComplete='off'/> 
                </div>
                <!-- ID field -->
                <div class="form-control">
                    <label for='number'>Your ID</label>
                    <i class="fa fa-key"></i>
                    <input type="number" name="number" autoComplete='off'/> 
                </div>
                <!-- Password field -->
                <div class="form-control">
                    <label for='password'>Password</label>
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" autoComplete='off'/> 
                </div>
                <!-- Login button -->
                <button type="button" class="btn" onClick="open_morgue_page()">Login</button>
            </form>
        </div>

    </div>



<!-- - radiologist -- -->

    <?php if ($page=='radiologist_login') ?>
    <div class="fill-form-div login-div" id="next_12">
            <div class="radiologist-login hidden">
            <!-- Close icon for the login form -->
            <i class="bi bi-x-circle" id='close-icon-radiologist' onclick="cancel();"></i>
            <!-- Title for the login form -->
            <h1 class="login-form-h1">Login (Radiologist)</h1>
            <!-- Radiologist login form -->
            <form>
                <!-- Email field -->
                <div class="form-control">
                    <label for='email'>Email</label>
                    <i class="fa fa-address-book"></i>
                    <input type="email" name="email" autoComplete='off'/> 
                </div>
                <!-- ID field -->
                <div class="form-control">
                    <label for='number'>Your ID</label>
                    <i class="fa fa-key"></i>
                    <input type="number" name="number" autoComplete='off'/> 
                </div>
                <!-- Password field -->
                <div class="form-control">
                    <label for='password'>Password</label>
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" autoComplete='off'/> 
                </div>
                <!-- Login button -->
                <button type="button" class="btn" onClick="isRadiologist_active()">Login</button>
            </form>
        </div>

    </div>



 <!-- nurse -- -->

    <?php if ($page=='nurse_login') ?>
    <div class="fill-form-div login-div" id="next_13">
            <div class="nurse-login hidden">
            <!-- Close icon for the login form -->
            <i class="bi bi-x-circle" id='close-icon-nurse' onclick="cancel();"></i>
            <!-- Title for the login form -->
            <h1 class="login-form-h1">Login (Nurse)</h1>
            <!-- Nurse login form -->
            <form action="config/code.php" id="nurse_loginform" enctype="multipart/form-data" method="post">
                <!-- Email field -->
                <div class="form-control">
                    <label for='email'>Email</label>
                    <i class="fa fa-address-book"></i>
                    <input type="email" id="nurse_email"name="email" autoComplete='off'/> 
                </div>
                <!-- ID field -->
                <div class="form-control">
                    <label for='number'>Your ID</label>
                    <i class="fa fa-key"></i>
                    <input type="text" id="nurse_id" name="number" autoComplete='off'/> 
                </div>
                <!-- Password field -->
                <div class="form-control">
                    <label for='password'>Password</label>
                    <i class="fa fa-lock"></i>
                    <input type="password" id="nurse_password" name="password" autoComplete='off'/> 
                </div>
                 <!-- Hidden input for the action -->
                 <input name="action" value="nurse_login" type="hidden"/>
                <!-- Login button -->
                <button type="button" class="btn" id="nurse_login_btn" title="Login" onclick="_nurse_sign_in();">Login</button>
            </form>
        </div>

    </div>

<?php } ?>