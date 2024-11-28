
<?php include '../../backend/config/connection.php';?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Forgotten Password</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body id="next_2">
    

    <div class="container-2">
        <div class="form-container-2">
            <h2>PLEASE RESET PASSWORD</h2>
                <div class='form-control'>
                    <input type='email' type="email" name="resetemail" id="reset_password_email" autoComplete='off'/>
                        
                    <!-- <input class="input-field" type="email" name="resetemail" placeholder="Enter your Email" id="reset_password_email"/><br><br> -->
                    <!-- <button class="btn" type="button"  title="Next" id="reset_pwd_btn" onclick="_proceed_reset_password()"> PROCEED <i class="bi-arrow-right"></i></button> -->


                    <label for='email'>Enter your Email</label>
                </div>
                <!--<a href="./otp-reset.php">-->    <button type="button"  type="button"  title="Next" id="reset_pwd_btn" onclick="_proceed_reset_password()" class='btn-2'>Proceed   <i class="fa fa-arrow-right"></i></button>  <!--</a>-->
                <p class='text'> Already have an account
                 <a href='index.php' class="password-link">Log In</a>
                </p>
            </form>
        </div>
      </div>


    <script src="../../backend/js/scripts.js"></script>
    <script src="../../backend/js/jquery-v3.6.1.min.js"></script>
</body>
</html>