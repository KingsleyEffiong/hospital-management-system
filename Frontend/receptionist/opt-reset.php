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
        <p>Hi, Please kindly enter your O.T.P which was sent to you</p>
        <form id="passwordSubmit">
            <div class='form-control'>
                <input type='text' id="text" name="text" autoComplete='off'/>
                <label for='text'>Enter O.T.P</label>
            </div>
         <h3>Create a New password!</h3>
            <div class='form-control'>
                <input type="password" id="password" name="spass" autocomplete="off">
                <label for="password">Enter new password</label>
          
            </div>
            <input name="action" value="login" type="hidden" />
           
             <div class='form-control'>
                <input type="password" id="confirmPassword" required autocomplete="off">
                <label for="confirmPassword" name="confirmPassword">Confirm new password</label>
            </div> 
            <button type="submit"  class='btn' id="submission">Reset Password</button>
           
        </form>
    </div>
  </div>
  <script src="js/signin-form-validation.js"></script>
</body>
</html>