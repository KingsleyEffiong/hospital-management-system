
<?php include '../backend/config/connection.php';?>


<?php
// <!-- for checking action and page  -->
  	$action=$_POST['action'];
	  switch ($action){
	  
	case 'get_page':
	$page=$_POST['page'];
	include 'index.php';
	break;
	

	default :
			
	break;


	case 'alogin_check': // for user login
		$email=trim($_POST['email']);
	///	$temp_password=trim(($_POST['password']));
		$password=trim(($_POST['password']));
			$query=mysqli_query($conn,"SELECT * FROM staff_tab WHERE `email`='$email' AND `password`='$password'");
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


	case 'alogin': // login from index
		$userquery = mysqli_query ($conn,"SELECT * FROM `staff_tab` WHERE email = '$email' AND `password` = '$spass' AND status_id=1");
				$usersel=mysqli_fetch_array($userquery);
				$staff_id=$usersel['staff_id'];
				$_SESSION['staff_id'] = $staff_id;
				$s_staff_id=$_SESSION['staff_id'];
				mysqli_query($conn,"UPDATE `staff_tab` SET last_login=NOW() WHERE staff_id='$s_staff_id'"); //// update last login
				sleep(1);
		?>
					<script>
					window.parent(location="../Frontend/superadmin/dashboard.php");
					</script>
		<?php
			
	break;







	  
 	case 'record_login_check': // for user login
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


	case 'record_login': // login from index
		$userquery = mysqli_query ($conn,"SELECT * FROM `staff_tab` WHERE email = '$email' AND `password` = '$spass' AND status_id=1") ;
				$usersel=mysqli_fetch_array($userquery);
				$staff_id=$usersel['staff_id'];
				$_SESSION['staff_id'] = $staff_id;
				$s_staff_id=$_SESSION['staff_id'];
				mysqli_query($conn,"UPDATE `staff_tab` SET last_login=NOW() WHERE staff_id='$s_staff_id'") or die("cannot update") ; //// update last login
							
		?>
					<script>

						window.parent(location="../Health_Records_and_Information/");
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


	  case 'logout':
		session_destroy();
		?>
		<script>
			window.alert("Logging Out");
		window.parent(location="../");
		</script>
		<?php
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
	



	



			/////////////////////doctors


			
			case 'doctor_login_check': // for doctor login
				$doctor_email=trim($_POST['doctor_email']);
			///	$temp_password=trim(($_POST['password']));
				$doctor_password=trim(($_POST['doctor_password']));
				$doctor_id=trim(($_POST['doctor_id']));

					$query=mysqli_query($conn,"SELECT * FROM doctor_tab WHERE `email`='$doctor_email' AND `password`='$doctor_password' AND `doctor_id` = '$doctor_id'");
					$usercount = mysqli_num_rows($query);
					if ($usercount>0){
						$usersel=mysqli_fetch_array($query);
						$doctor_id=$usersel['doctor_id'];
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


			case 'doctor_login': // login from index
				$userquery = mysqli_query ($conn,"SELECT * FROM `doctor_tab` WHERE email = '$email' AND `password` = '$doctor_password' AND status_id=1") ;
						$usersel=mysqli_fetch_array($userquery);
						$doctor_id=$usersel['doctor_id'];
						$_SESSION['doctor_id'] = $doctor_id;
						$s_doctor_id=$_SESSION['doctor_id'];
						mysqli_query($conn,"UPDATE `doctor_tab` SET last_login=NOW() WHERE doctor_id='$s_staff_id'") or die("cannot update") ; //// update last login
									
				?>
							<script>

								window.parent(location="../doctor/");
							</script>
				<?php

			/////////////labs
				
			case 'lab_login_check': // for doctor login
				$lab_scientist_email=trim($_POST['lab_scientist_email']);
			///	$temp_password=trim(($_POST['password']));
				$lab_scientist_password=trim(($_POST['lab_scientist_password']));
				$lab_scientist_id=trim(($_POST['lab_scientist_id']));

					$query=mysqli_query($conn,"SELECT * FROM lab_scientist_tab WHERE `email`='$lab_scientist_email' AND `password`='$lab_scientist_password' AND `lab_scientist_id` = '$lab_scientist_id'");
					$usercount = mysqli_num_rows($query);
					if ($usercount>0){
						$usersel=mysqli_fetch_array($query);
						$lab_scientist_id=$usersel['lab_scientist_id'];
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


			case 'lab_login': // login from index
				$userquery = mysqli_query ($conn,"SELECT * FROM `lab_scientist_tab` WHERE email = '$lab_scientist_email' AND `password` = '$lab_scientist_password' AND status_id=1") ;
						$usersel=mysqli_fetch_array($userquery);
						$lab_scientist_id=$usersel['lab_scientist_id'];
						$_SESSION['lab_scientist_id'] = $lab_scientist_id;
						$s_lab_scientist_id=$_SESSION['lab_scientist_id'];
						mysqli_query($conn,"UPDATE `lab_scientist_tab` SET last_login=NOW() WHERE lab_scientist_id='$s_lab_scientist_id'") or die("cannot update") ; //// update last login
									
				?>
							<script>

								window.parent(location="../labouratory/");
							</script>
				<?php





			/////////////////////nurses


						
			case 'nurse_login_check': // for nurse login
				$nurse_email=trim($_POST['nurse_email']);
			///	$temp_password=trim(($_POST['password']));
				$nurse_password=trim(($_POST['nurse_password']));
				$nurse_id=trim(($_POST['nurse_id']));

					$query=mysqli_query($conn,"SELECT * FROM nurse_tab WHERE `email`='$nurse_email' AND `password`='$nurse_password' AND `nurse_id` = '$nurse_id'");
					$usercount = mysqli_num_rows($query);
					if ($usercount>0){
						$usersel=mysqli_fetch_array($query);
						$nurse_id=$usersel['nurse_id'];
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


			case 'nurse_login': // login from index
				$userquery = mysqli_query ($conn,"SELECT * FROM `nurse_tab` WHERE email = '$email' AND `password` = '$nurse_password' AND status_id=1") ;
						$usersel=mysqli_fetch_array($userquery);
						$nurse_id=$usersel['nurse_id'];
						$_SESSION['nurse_id'] = $nurse_id;
						$s_nurse_id=$_SESSION['nurse_id'];
						mysqli_query($conn,"UPDATE `nurse_tab` SET last_login=NOW() WHERE nurse_id='$s_nurse_id'") or die("cannot update") ; //// update last login
					// echo $s_nurse_id;				
				?>
							<script>
								window.parent(location="../nurse/");
							</script>
				<?php


			// <!-- for checking action and page  -->

					
					
			break;


	





}




?>