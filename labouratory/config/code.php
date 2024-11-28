<?php include '../../backend/config/connection.php';?>






<?php
// <!-- for checking action and page  -->
  	$action=$_POST['action'];
	  switch ($action){
	  
	case 'get_page':
	$page=$_POST['page'];
	include 'index.php';
	break;

    
    case 'bookLabouratoryTest':
        // Retrieve POST data
        $tests = json_encode($_POST['tests']); // Convert the tests array to a JSON string
        $total_amount = $_POST['totalAmount'];
        $patient_id = $_POST['patient_id'];
        $payment_status = "PENDING";
        $status_id = "1"; 
        $appointment_id = $_POST['appointment_id'];
    
        // Get the sequence number for generating the account_appointment_id
        $sequence = $callclass->_get_sequence_count($conn, 'ACCTAPP');
        $array = json_decode($sequence, true);
        $no = $array[0]['no'];
        $account_appointment_id = 'ACCTAPP' . $no;
    
        // Begin transaction
        $conn->begin_transaction();
    
        try {
            // Prepare the INSERT query
            $query = "INSERT INTO `account_appointment_tab`
                      (`patient_id`, `account_appointment_id`, `tests`, `total_amount`, `payment_status`, `time`) 
                      VALUES (?, ?, ?, ?, ?, now())";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssss", $patient_id, $account_appointment_id, $tests, $total_amount, $payment_status);
    
            // Execute the insert query
            if (!$stmt->execute()) {
                throw new Exception("Insert failed: " . $stmt->error);
            }
    
            // Update the status in lab_appointment_tab
            $update_query = "UPDATE lab_appointment_tab SET status_id = ? WHERE lab_scientist_appointment_id = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("ss", $status_id, $appointment_id);
    
            if (!$update_stmt->execute()) {
                throw new Exception("Update failed: " . $update_stmt->error);
            }
    
            // Commit transaction if both queries succeed
            $conn->commit();
            echo json_encode(array("success" => true));
    
        } catch (Exception $e) {
            // Rollback transaction on failure
            $conn->rollback();
            echo json_encode(array("success" => false, "message" => $e->getMessage()));
        } finally {
            // Close statements
            $stmt->close();
            $update_stmt->close();
        }
        break;
    
    
        

    }
    ?>