<?php include '../backend/config/connection.php'?>



<?php
if ($s_staff_id != '') {
?>
    <script>
        window.location.href = "dashboard.php";
    </script>
<?php

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Super Admin Login</title>
  <?php include 'meta.php' ?> 
</head>
<body>
<?php $page = 'login';?>

    <section class="login-section">



        <div class="_staff_login">
            <i class="cube bi bi-hospital"></i>
            <i class="cube bi bi-hospital"></i>
            <i class="cube bi bi-hospital"></i>
            <i class="cube bi bi-hospital"></i>
            <i class="cube bi bi-hospital"></i>
            <div class="adverts">
                    Advertisments
            </div>
        </div>


        <div class="admin_section">
                <i class="cube_admin bi bi-hospital"></i>
                <i class="cube_admin bi bi-hospital"></i>
                <i class="cube_admin bi bi-hospital"></i>
                <i class="cube_admin bi bi-hospital"></i>
                <i class="cube_admin bi bi-hospital"></i>
            <div class="admin_container">
                <div class="_admin_contents">
                <h3>Admin Login</h3>
                <form action="<?php echo $website_url?>/config/code.php" id="aloginform" enctype="multipart/form-data" method="post">
                    <div class="_form_control">
                        <label for="email">Email</label>
                        <i class="bi bi-envelope-open"></i>
                        <input type="email" name="email" id="admin_email" value="">
                    </div>
                    <div class="_form_control">
                        <label for="password">Password</label>
                        <i class="bi bi-key"></i>
                        <i class="bi bi-eye show_password hide" id="show_admin_password" onclick="show_admin_password()"></i>
                        <i class="bi bi-eye-slash lock_password" id="lock_admin_password" onclick="show_admin_password()"></i>
                        <input type="password" id="admin_password" value="" name="spass" autocomplete="off" >
                    </div>
                    <input name="action" value="alogin" type="hidden">
                    <div class="_fingerprint_authentication">
                        <i class="bi bi-fingerprint"></i>
                        <span>FingerPrint Authentication</span>
                    </div>
                    <button type="button" class="btn" id="login_btn" onclick="s_sign_in()">Login</button>
                    <input type="hidden" name="action" value="alogin"/>
                </form>
            </div>
            <div class="admin_alert hide" id="admin_verification">
                <span>Verification Successful <i class="bi bi-hand-thumbs-up-fill"></i></span>
            </div>
            <div class="admin_alert vf hide">
                <span>Verification Failed <i class="bi bi-emoji-frown"></i></span>
            </div>
            </div>
        </div>
    </section>


   
</body>
</html>