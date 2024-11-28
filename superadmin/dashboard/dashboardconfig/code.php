<?php include '../../../backend/config/connection.php';?>

<?php require_once('session-validation.php');?>

<?php 
	$action=$_POST['action'];
	  switch ($action){

	case 'get_page':
		$page=$_POST['page'];
		require_once ('page-content.php');
	break;

	case 'record':
		$page=$_POST['page'];
		require_once ('page-content.php');
	break;



	case 'get_form':
		$page=$_POST['page'];
		require_once ('page-content.php');
	break;

	case 'get_form_with_id':
		$ids=$_POST['ids'];
		$page=$_POST['page'];
		require_once ('page-content.php');
	break;

	case 'dashboard':
		$page=$_POST['page'];
		require_once ('page-content.php');
	break;

	case 'get_menu_page':
		$page=$_POST['page'];
		require_once ('page-content.php');
	break;

	case 'get-inner-page':
		$search_page=$_POST['page'];
		$ids=$_POST['ids'];
		require_once('sub-code.php');
	break;


   	case 'logout':
		session_destroy();
		?>
		<script>
			window.alert("Logging Out");
			window.parent(location="../../");
		</script>
		<?php
	break;



	 case 'fetch_patient_list': 
		$status_id=$_POST['status_id'];
		$all_search_txt=$_POST['all_search_txt'];
		$search_page='staff-list';
		require_once('search-code.php');
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



	case 'update_user_profile': 
		$staff_id=$_POST['s_staff_id'];
		$fullname=$_POST['fullname'];
		$email=$_POST['email'];
		$phonenumber=$_POST['phonenumber'];			  
		$status_id=$_POST['status_id'];
	//	$role_id=$_POST['role_id'];

		mysqli_query($conn, "UPDATE staff_tab SET `fullname`='$fullname',`email`='$email',`phonenumber`='$phonenumber' WHERE `staff_id`='$s_staff_id'");

	break;	
		



	case 'update_profile_pix': // Upload Profile Pix for first time login
		$passport=$_FILES['passport']['name'];
		$datetime=date("Ymdhi");
		
		$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF");
		$extension = pathinfo($_FILES['passport']['name'], PATHINFO_EXTENSION);
		
		if (in_array($extension, $allowedExts)){
			
			$user_array=$callclass->_get_staff_details($conn, $s_staff_id);
			$u_array = json_decode($user_array, true);
			$db_passport= $u_array[0]['passport'];
			if($db_passport==''){
				//// do nothing;
			}else{
				unlink("../../../uploaded_files/profile_pix/" .$db_passport);
			}
			
		$passport = $datetime.'_'.$passport;
		move_uploaded_file($_FILES["passport"]["tmp_name"],"../../../uploaded_files/profile_pix/" .$passport);

		}
		
		mysqli_query($conn,"UPDATE staff_tab SET passport='$passport' WHERE staff_id='$s_staff_id'") or die ("cannot update staff_tab");

	break;





































	// case 'update_user_password': 
	// 	$oldpass=($_POST['oldpass']);
	// 	$newpass=$_POST['newpass'];
	// 	//$newpass=($newpass);
	// 	$userpass=mysqli_num_rows(mysqli_query($conn,"SELECT password FROM staff_tab WHERE password='$oldpass' AND staff_id ='$s_staff_id'"));
	// 		if ($userpass>0){
	// 			mysqli_query($conn,"UPDATE staff_tab SET password='$newpass' WHERE staff_id='$s_staff_id'")
	// 			or die ("cannot update staff_tab");
	// 			/////////// get alert//////////////////////////////////
	// 			$check=1; /// password updated
	// 			session_destroy();
	// 		}else{
	// 			$check=0; //password not updated
	// 		}
	// 	echo json_encode(array("check" => $check)); 
	// break;	
	}
?>

