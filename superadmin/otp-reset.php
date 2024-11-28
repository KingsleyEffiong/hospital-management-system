
<!-- ?php include '../../backend/config/connection.php';?> -->

<?php
$page=='reset_password';
            $profile_query=mysqli_query($conn, "SELECT * FROM staff_tab WHERE staff_id='$staff_id' ");
            while($fetch_query=mysqli_fetch_array($profile_query)){
            $staff_id=$fetch_query['staff_id'];
            $fullname=$fetch_query['fullname'];
            $email=$fetch_query['email'];
            $phonenumber=$fetch_query['phonenumber']
                                
?>
  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>OTP RESET</title>
</head>
<body>
    
  <div class="container-3">
    <div class="form-container-3">
        <h2>PLEASE RESET PASSWORD</h2>
        <p>Hi,<?php echo $fullname?>  Please kindly enter your O.T.P which was sent to your mail(<?php echo $email?>)</p>
        
            <div class='form-control'>
                <input  type="OTP" name="otp"  input id="cotp" title-div="Enter OTP" autoComplete='off'/>
                <label for='text'>Enter O.T.P</label>
            </div>
            <h3>Create a New password</h3>
            <div class='form-control'>
                <input type="password"  id="r_password" name="createpassword" title="Confirm Password"  autocomplete="off"/>
                <label for="password">Enter new password</label>
          
            </div>
           
             <div class='form-control'>
                <input type="password" required autocomplete="off" type="password" id="r_cpassword" name="confirmpassword" title="Confirm Password"/>
                <label for="confirmPassword" name="confirmPassword">Confirm new password</label>
            </div> 
            <button type="button"  title="Reset" id="finish-reset-btn" onclick="_finish_reset_password('<?php echo $staff_id;?>');"  class='btn'>Reset Password</button>
           
        
    </div>
  </div>
  <script src="../../backend/js/scripts.js"></script>
    <script src="../../backend/js/jquery-v3.6.1.min.js"></script>
  <!-- <script src="signin-form-validation.js"></script> -->
</body>
<?php  }?> 
</html>


