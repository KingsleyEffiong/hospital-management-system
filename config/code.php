
<?php include '../backend/config/connection.php';?>


<?php
// <!-- for checking action and page  -->
  	$action=$_POST['action'];
	  switch ($action){
	  
	case 'get_page':
	$page=$_POST['page'];
	include 'index.php';
	break;


	  
 	case 'login_check': // for user login
		$email=trim($_POST['email']);
	///	$temp_password=trim(($_POST['password']));
		$password=trim(($_POST['password']));
		$user_id=trim(($_POST['user_id']));

			$query=mysqli_query($conn,"SELECT * FROM staff_tab WHERE `email`='$email' AND `password`='$password' AND `staff_id` = '$user_id'");
			$usercount = mysqli_num_rows($query);
			if ($usercount>0){
				$usersel=mysqli_fetch_array($query);
				$staff_id=$usersel['staff_id'];
				$status_id=$usersel['status_id'];
				
					if ($status_id==1){
						$check=1; ///// account is active

						
					}else if($status_id==2){
						$check=2; ///// account is suspended
						
					}else {
						$check=0;
					}
			}else{
				$check=0;
			}
							
			echo json_encode(array("check" => $check, )); 
	break;


	case 'login': // login from index
		$userquery = mysqli_query ($conn,"SELECT * FROM `staff_tab` WHERE email = '$email' AND `password` = '$spass' AND status_id=1") ;
				$usersel=mysqli_fetch_array($userquery);
				$staff_id=$usersel['staff_id'];
				$_SESSION['staff_id'] = $staff_id;
				$s_staff_id=$_SESSION['staff_id'];
				mysqli_query($conn,"UPDATE `staff_tab` SET last_login=NOW() WHERE staff_id='$s_staff_id'") or die("cannot update") ; //// update last login
							
		?>
					<script>

						window.parent(location="../frontend/receptionist/index.php");
					</script>
		<?php
			
	break;


	case 'proceed_reset_password':
		$email=$_POST['email'];
		/////////// confirm user exitence//////////////////////////////////
		$query=mysqli_query($conn,"SELECT * FROM staff_tab WHERE email='$email'");
				$checkemail=mysqli_num_rows($query);
				if ($checkemail>0){
				  $fetch=mysqli_fetch_array($query);
					$staff_id= $fetch['staff_id'];
					$status_id= $fetch['status_id'];
					if ($status_id==1){
						$check=1; /// user  Active
					}else if($status_id==2){
						$check=2; /// user Suspended
				}else{
					$check=0; /// user Not Exist
				}

			}else{
				$check=0; /// user Not Exist
			}
		  ////////sending json///////////////////////////
				  echo json_encode(array("check" => $check,"staff_id" => $staff_id)); 
	break;

	case 'reset_password':
		$staff_id=$_POST['staff_id'];		  
		$user_array=$callclass->_get_staff_details($conn, $staff_id);
		$u_array = json_decode($user_array, true);
		$fullname= $u_array[0]['fullname'];
		$email= $u_array[0]['email'];
  
		  $otp = rand(111111,999999);
		  ////////////////update user OTP///////////////
		  mysqli_query($conn,"UPDATE staff_tab SET otp='$otp' WHERE staff_id ='$staff_id'") or die("cannot update staff_tab");
		  ////////////////send OTP through email///////////////
		//   $mail_to_send='send_reset_password_otp';
		//   require_once('mail/mail.php');
		$page=$action;
	 require_once('../../frontend/superadmin/otp-reset.php');
	 ?>
	<!-- <script>
	 	window.parent(location="../frontend/otp-reset.php");
 	</script> -->
 <?php 
	
	break;


	case 'resend_otp':
		$staff_id=$_POST['staff_id'];		  
		$user_array=$callclass->_get_staff_details($conn, $staff_id);
		$u_array = json_decode($user_array, true);
		$fullname= $u_array[0]['fullname'];
		$email= $u_array[0]['email'];
		
		$otp = rand(111111,999999);
		////////////////update user OTP///////////////
		mysqli_query($conn,"UPDATE staff_tab SET otp='$otp' WHERE staff_id ='$staff_id'")or die("cannot update staff_tab");
		////////////////send OTP true email///////////////
		//$mail_to_send='send_reset_password_otp';
		// require_once('../../frontend/otp-reset.php');
	break;	


	case 'finish_reset_password':
		$staff_id=trim($_POST['staff_id']);
		$password=($_POST['password']);
		$otp=trim($_POST['otp']); 
		
		$fetch=$callclass->_get_staff_details($conn, $staff_id);
		$array = json_decode($fetch, true);
		$fullname=$array[0]['fullname'];
		$db_otp=$array[0]['otp'];
		$role_id=$array[0]['role_id'];
		
		  if ($otp==$db_otp){ ///// check 1
		  mysqli_query($conn,"UPDATE staff_tab SET password='$password' WHERE staff_id='$staff_id'")or die (mysqli_error($conn));
		  $check=1;
		  }else{						
		  $check=0;
		  }
		  echo json_encode(array("check" => $check)); 
	  break;
  
	   case 'password_reset_completed':
		$page=$action;
	  	require_once('index.php');
	  break;


	  
	case 'fetch_patient':
		$staff_id=$_POST['staff_id'];		  
		$user_array=$callclass->_get_staff_details($conn, $staff_id);
		$u_array = json_decode($user_array, true);
		$fullname= $u_array[0]['fullname'];
		$email= $u_array[0]['email'];
		
		// $otp = rand(111111,999999);
		// ////////////////update user OTP///////////////
		mysqli_query($conn,"SELECT * FROM patient_tab WHERE patient_id ='$patient_id'")or die("cannot select patient_tab");
		////////////////send OTP true email///////////////
		//$mail_to_send='send_reset_password_otp';
		// require_once('../../frontend/otp-reset.php');
	break;	






	case 'patients_page':
		$patient_id = $_POST['patient_id'];
	
		$userquery = mysqli_query($conn, "SELECT * FROM `patient_tab` WHERE patient_id = '$patient_id'") or die("cant select");
		$usersel = mysqli_fetch_array($userquery);
		$check = $usersel['patient_id'];

		echo json_encode(array('check' => $check));		
	break;
	



	





	case 'patients_profile_page':
		$patient_id = $_POST['patient_id'];
	
		$puserquery = mysqli_query($conn, "SELECT * FROM `patient_tab` WHERE patient_id = $patient_id") or die("cant select");
		$pusersel = mysqli_fetch_array($puserquery);
		$check = $pusersel['patient_id'];

		echo $check;
	
		echo json_encode(array('check' => $check));
		break;
	



	



	case 'add_staff': 
		$fullname=trim(strtoupper($_POST['fullname']));
		$email=$_POST['email'];
		$phonenumber=$_POST['phonenumber'];
		$role_id=$_POST['role_id'];
		$status_id=$_POST['status_id'];
		
		$email_query=mysqli_query($conn, "SELECT * FROM staff_tab WHERE `email`='$email'");
        $check_query_count=mysqli_num_rows($email_query);

        if(($check_query_count>0)){	
			$check=0;//// invalid Email.
             }else{
				$check=1;
			

		///////////////////////geting sequence//////////////////////////
		$sequence=$callclass->_get_sequence_count($conn, 'STF');
		$array = json_decode($sequence, true);
		$no= $array[0]['no'];
		//$num= $array[0]['num'];
		$staff_id='STF'.$no;
		
	
			mysqli_query($conn,"INSERT INTO `staff_tab`
			(`staff_id`, `fullname`, `email`, `phonenumber`, `role_id`, `status_id`, `date`, `last_login`) VALUES 
			('$staff_id', '$fullname', '$email', '$phonenumber', '$role_id', '$status_id', NOW(), NOW())")or die (mysqli_error($conn));
		/////////// get alert//////////////////////////////////
		}
		echo json_encode(array("check" => $check)); 
	break;	














}




?>