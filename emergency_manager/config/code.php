<?php include '../../backend/config/connection.php';?>






<?php
// <!-- for checking action and page  -->
  	$action=$_POST['action'];
	  switch ($action){
	  
	case 'get_page':
	$page=$_POST['page'];
	include 'index.php';
	break;

    
 

    case 'emergency_input':

        // Capture POST data
        $Epatient_name = $_POST['fullName'];
        $dob = $_POST['dob'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $ec_name = $_POST['emergencyFullName'];
        $ec_contact_no = $_POST['contactNumber'];
        $ec_relationship = $_POST['relationship'];
        $date_of_incident = $_POST['dateOfIncident'];
        $time_of_incident = $_POST['timeOfIncident'];
        $cause_of_incident = $_POST['causeOfIncident'];
        $status_id = "2";
    
        // Check for existing record with the same phone number
        $stmt = $conn->prepare("SELECT * FROM emergency_patient_tab WHERE `ec_contact_no` = ?");
        $stmt->bind_param("s", $ec_contact_no);
        $stmt->execute();
        $stmt->store_result();
        $check_query_count = $stmt->num_rows;
    
        if ($check_query_count > 0) {    
            echo json_encode(array("success" => false, "message" => "Phone number already exists."));
        } else {
    
            // Get sequence
            $sequence = $callclass->_get_sequence_count($conn, 'EPAT');
            $array = json_decode($sequence, true);
            $no = $array[0]['no'];
            $emergency_patient_id = 'Epat' . $no;
    
            // Prepare the insert query
            $stmt = $conn->prepare("INSERT INTO `emergency_patient_tab`
            (`emergency_patient_id`, `Epatient_name`, `status_id`, `dob`, `address`, `gender`, `ec_name`, `ec_contact_no`, `ec_relationship`, `date_of_incident`, `time_of_incident`, `cause_of_incident`, `date`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    
            $stmt->bind_param("ssssssssssss", $emergency_patient_id, $Epatient_name, $status_id, $dob, $address, $gender, $ec_name, $ec_contact_no, $ec_relationship, $date_of_incident, $time_of_incident, $cause_of_incident);
    
            if ($stmt->execute()) {
                echo json_encode(array("success" => true, "patient_id" => $emergency_patient_id));
            } else {
                echo json_encode(array("success" => false, "message" => $stmt->error));
            }
    
            $stmt->close();
        }
        
        break;


        

    case 'getDoctorsRoles':
        // Execute the query to fetch all doctor roles
        $query = mysqli_query($conn, "SELECT * FROM doctor_role_tab");
  
        // Check if the query executed successfully
        if ($query) {
            $doctorRoles = array();
  
            // Fetch the data from the result set
            while ($row = mysqli_fetch_assoc($query)) {
                $doctorRoles[] = $row;
            }
  
            // Return the data as JSON
            echo json_encode(array("success" => true, "doctorRoles" => $doctorRoles));
        } else {
            // Return an error message if the query failed
            echo json_encode(array("success" => false, "message" => "Error executing the query"));
        }
        break;
  
  
    case 'getDoctors':
        $role = $_POST['roles'];
  
        // Sanitize the role input to prevent SQL injection
        $role = mysqli_real_escape_string($conn, $role);
    
        // Execute the query to fetch doctors based on the role
        $query = mysqli_query($conn, "SELECT doctor_tab.fullname, doctor_tab.doctor_id FROM doctor_tab
                                JOIN doctor_role_tab ON doctor_role_tab.doctor_role_id = doctor_tab.doctor_role_id 
                                WHERE doctor_tab.doctor_role_id ='$role'");
    
        // Check if the query executed successfully
        if ($query) {
            $doctor = array();
    
            // Fetch the data from the result set
            while ($row = mysqli_fetch_assoc($query)) {
                $doctor[] = $row;
            }
    
            // Return the data as JSON
            echo json_encode(array("success" => true, "doctor" => $doctor));
        } else {
            // Return an error message if the query failed
            echo json_encode(array("success" => false, "message" => "Error executing the query"));
        }
        break;


        case 'transfer_patient_to_doctor':
            $patient_id = $_POST['patient_id'];
            $patient_name = $_POST['patient_name'];
            $comment = $_POST['comment'];
            $time = $_POST['selected_time'];
            $date = $_POST['selected_date'];
            $doctor_id = $_POST['doctor_id'];
            $status_id = "1"; // Default status ID for new transfer
        


           
            // Get the appointment ID sequence
            $sequence = $callclass->_get_sequence_count($conn,  'DOCAPP');
            $array = json_decode($sequence, true);
            $no = $array[0]['no'];
            $appointment_id = 'DOCAPP' . $no;
        
            // Prepare the SQL query with placeholders
            $stmt = $conn->prepare("
                INSERT INTO doctor_appointment_tab
                (doctor_appointment_id, patient_id, patient_name, reason, time, doctor_appointment_status_id, doctor_id, doctor_appointment_date)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ");
        
            if ($stmt) {
                // Bind the parameters
                $stmt->bind_param(
                    "ssssssss",
                    $appointment_id,
                    $patient_id,
                    $patient_name,
                    $comment,
                    $time,
                    $status_id,
                    $doctor_id,
                    $date
                );
        
                // Execute the statement and return appropriate response
                if ($stmt->execute()) {
                    echo json_encode(array("success" => true, "message" => "Patient transferred successfully"));
                } else {
                    echo json_encode(array("success" => false, "message" => "Error executing query."));
                    // Optional: Log the detailed error to a log file instead of showing it
                    error_log("SQL Error: " . $stmt->error);
                }
        
                // Close the statement
                $stmt->close();
            } else {
                echo json_encode(array("success" => false, "message" => "Error preparing query."));
                // Optional: Log the detailed error
                error_log("SQL Prepare Error: " . $conn->error);
            }
        break;



        case 'get_nurse':

            // Execute the query to fetch nurses
            $query = mysqli_query($conn, "SELECT fullname, nurse_id FROM nurse_tab");
        
            // Check if the query executed successfully
            if ($query) {
                $nurse = array();
        
                // Fetch the data from the result set
                while ($row = mysqli_fetch_assoc($query)) {
                    $nurse[] = $row; // Storing data in $nurse
                }
        
                // Return the data as JSON
                echo json_encode(array("success" => true, "nurse" => $nurse));
            } else {
                // Return an error message if the query failed
                echo json_encode(array("success" => false, "message" => "Error executing the query"));
            }
            break;
        
        
    

            
case 'transfer_to_nurse':
    // Retrieve data from POST request
    $patient_id = $_POST['patient_id'];
    $patient_name = $_POST['patient_name'];
    $comment = $_POST['comment'];
    $time = $_POST['selected_time'];
    $date = $_POST['selected_date'];
    $nurse_id = $_POST['nurse_id'];
    $status_id = "1"; // Default status ID for new transfer

    // Check if the appointment already exists
    $check_stmt = $conn->prepare("SELECT * FROM nurse_appointment_tab WHERE patient_id = ? AND time = ? AND nurse_appointment_date= ?");
    if ($check_stmt) {
        $check_stmt->bind_param("sss", $patient_id, $time, $date);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            echo json_encode(array("success" => false, "message" => "Appointment already exists."));
        } else {
            // Get the appointment ID sequence
            $sequence = $callclass->_get_sequence_count($conn, 'APP');
            $array = json_decode($sequence, true);
            $no = $array[0]['no'];
            $appointment_id = 'APP' . $no;

            // Prepare the SQL INSERT query
            $stmt = $conn->prepare("
                INSERT INTO nurse_appointment_tab
                (nurse_appointment_id, patient_id, patient_name, reason, time, nurse_appointment_status_id, nurse_id, nurse_appointment_date)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ");

            if ($stmt) {
                // Bind the parameters
                $stmt->bind_param(
                    "ssssssss",
                    $appointment_id,
                    $patient_id,
                    $patient_name,
                    $comment,
                    $time,
                    $status_id,
                    $nurse_id,
                    $date
                );

                // Execute the statement and return the appropriate response
                if ($stmt->execute()) {
                    echo json_encode(array("success" => true, "message" => "Patient transferred successfully."));
                } else {
                    echo json_encode(array("success" => false, "message" => "Error executing query."));
                    error_log("SQL Error: " . $stmt->error);
                }

                // Close the statement
                $stmt->close();
            } else {
                echo json_encode(array("success" => false, "message" => "Error preparing query."));
                error_log("SQL Prepare Error: " . $conn->error);
            }
        }

        // Close the check statement
        $check_stmt->close();
    } else {
        echo json_encode(array("success" => false, "message" => "Error preparing check query."));
        error_log("SQL Prepare Check Error: " . $conn->error);
    }
    break;


///////////////surgical unit 


case 'get_surgical_unit':

    // Execute the query to fetch nurses
    $query = mysqli_query($conn, "SELECT fullname, surgical_unit_id FROM surgical_unit_tab");

    // Check if the query executed successfully
    if ($query) {
        $surgical_unit = array();

        // Fetch the data from the result set
        while ($row = mysqli_fetch_assoc($query)) {
            $surgical_unit[] = $row; // Storing data in $nurse
        }

        // Return the data as JSON
        echo json_encode(array("success" => true, "surgical_unit" => $surgical_unit));
    } else {
        // Return an error message if the query failed
        echo json_encode(array("success" => false, "message" => "Error executing the query"));
    }
    break;

    case 'transfer_to_surgical_suite':
        // Retrieve data from POST request
        $patient_id = $_POST['patient_id'];
        $patient_name = $_POST['patient_name'];
        $comment = $_POST['comment'];
        $time = $_POST['time'];
        $date = $_POST['date'];
        $surgical_suite_id = $_POST['staffavailable'];
        $status_id = "1"; // Default status ID for new transfer
    
        // Check if the appointment already exists
        $check_stmt = $conn->prepare("SELECT * FROM surgical_suite_appointment_tab WHERE patient_id = ? AND time = ? AND date = ?");
        if ($check_stmt) {
            $check_stmt->bind_param("sss", $patient_id, $time, $date);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();
    
            if ($check_result->num_rows > 0) {
                echo json_encode(array("success" => false, "message" => "Appointment already exists."));
            } else {
                // Get the appointment ID sequence
                $sequence = $callclass->_get_sequence_count($conn, 'SURGAPP');
                $array = json_decode($sequence, true);
                $no = $array[0]['no'];
                $appointment_id = 'SURGAPP' . $no;
    
                // Prepare the SQL INSERT query
                $stmt = $conn->prepare(" INSERT INTO surgical_suite_appointment_tab
                    (surgical_suite_appointment_id, patient_id, patient_name, surgical_procedure , time, surgical_suite_id, date, status_id)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
                if ($stmt) {
                    // Bind the parameters
                    $stmt->bind_param(
                        "ssssssss",
                        $appointment_id,
                        $patient_id,
                        $patient_name,
                        $comment,
                        $time,
                        $surgical_suite_id,
                        $date,
                        $status_id
                    );
    
                    // Execute the statement and return the appropriate response
                    if ($stmt->execute()) {
                        echo json_encode(array("success" => true, "message" => "Patient transferred successfully."));
                    } else {
                        echo json_encode(array("success" => false, "message" => "Error executing query."));
                        error_log("SQL Error: " . $stmt->error);
                    }
    
                    // Close the statement
                    $stmt->close();
                } else {
                    echo json_encode(array("success" => false, "message" => "Error preparing query."));
                    error_log("SQL Prepare Error: " . $conn->error);
                }
            }
    
            // Close the check statement
            $check_stmt->close();
        } else {
            echo json_encode(array("success" => false, "message" => "Error preparing check query."));
            error_log("SQL Prepare Check Error: " . $conn->error);
        }
        break;
    

        ////////////lab


                
        case 'get_lab_unit':

            // Execute the query to fetch labs
            $query = mysqli_query($conn, "SELECT lab_scientist_name,lab_scientist_id FROM lab_scientist_tab");

            // Check if the query executed successfully
            if ($query) {
                $lab_unit = array();

                // Fetch the data from the result set
                while ($row = mysqli_fetch_assoc($query)) {
                    $lab_unit[] = $row; // Storing data in $nurse
                }

                // Return the data as JSON
                echo json_encode(array("success" => true, "lab_unit" => $lab_unit));
            } else {
                // Return an error message if the query failed
                echo json_encode(array("success" => false, "message" => "Error executing the query"));
            }
        break;


        case 'transfer_to_lab':
            // Retrieve data from POST request
            $patient_id = $_POST['patient_id'];
            $patient_name = $_POST['patient_name'];
            $comment = $_POST['comment'];
            $time = $_POST['time'];
            $date = $_POST['date'];
            $lab_scientist_id = $_POST['staffavailable'];
            $status_id = "1"; // Default status ID for new transfer
        
            // Check if the appointment already exists
            $check_stmt = $conn->prepare("SELECT * FROM lab_appointment_tab WHERE patient_id = ? AND time = ? AND date= ?");
            if ($check_stmt) {
                $check_stmt->bind_param("sss", $patient_id, $time, $date);
                $check_stmt->execute();
                $check_result = $check_stmt->get_result();
        
                if ($check_result->num_rows > 0) {
                    echo json_encode(array("success" => false, "message" => "Appointment already exists."));
                } else {
                    // Get the appointment ID sequence
                    $sequence = $callclass->_get_sequence_count($conn, 'LABAPP');
                    $array = json_decode($sequence, true);
                    $no = $array[0]['no'];
                    $appointment_id = 'LABAPP' . $no;
        
                    // Prepare the SQL INSERT query
                    $stmt = $conn->prepare("
                        INSERT INTO lab_appointment_tab (lab_scientist_appointment_id, patient_id, patient_name, message, time, lab_scientist_id, date)
                        VALUES (?, ?, ?, ?, ?, ?, ?)

                    ");
        
                    if ($stmt) {
                        // Bind the parameters
                        $stmt->bind_param(
                            "sssssss",
                            $appointment_id,
                            $patient_id,
                            $patient_name,
                            $comment,
                            $time,
                            $lab_scientist_id,
                            $date
                        );
        
                        // Execute the statement and return the appropriate response
                        if ($stmt->execute()) {
                            echo json_encode(array("success" => true, "message" => "Patient transferred successfully."));
                        } else {
                            echo json_encode(array("success" => false, "message" => "Error executing query."));
                            error_log("SQL Error: " . $stmt->error);
                        }
        
                        // Close the statement
                        $stmt->close();
                    } else {
                        echo json_encode(array("success" => false, "message" => "Error preparing query."));
                        error_log("SQL Prepare Error: " . $conn->error);
                    }
                }
        
                // Close the check statement
                $check_stmt->close();
            } else {
                echo json_encode(array("success" => false, "message" => "Error preparing check query."));
                error_log("SQL Prepare Check Error: " . $conn->error);
            }
           
        break;

///////////radiology


        case 'get_radiology':

            // Execute the query to fetch labs
            $query = mysqli_query($conn, "SELECT fullname,radiology_id FROM radiology_tab");

            // Check if the query executed successfully
            if ($query) {
                $radiology_unit = array();

                // Fetch the data from the result set
                while ($row = mysqli_fetch_assoc($query)) {
                    $radiology_unit[] = $row; // Storing data in $nurse
                }

                // Return the data as JSON
                echo json_encode(array("success" => true, "radiology" => $radiology_unit));
            } else {
                // Return an error message if the query failed
                echo json_encode(array("success" => false, "message" => "Error executing the query"));
            }
        break;


        case 'transfer_to_radiology':
            // Retrieve data from POST request
            $patient_id = $_POST['patient_id'];
            $patient_name = $_POST['patient_name'];
            $comment = $_POST['comment'];
            $time = $_POST['time'] ;
            $date = $_POST['date'];
            $radiology_id = $_POST['radavailable'];
            $status_id = "1"; // Default status ID for new transfer
        
            // Ensure required data is present
            if (!$patient_id || !$patient_name || !$time || !$date || !$radiology_id) {
                echo json_encode(array("success" => false, "message" => "Missing required data."));
                break;
            }
        
            // Check if the appointment already exists
            $check_stmt = $conn->prepare("SELECT * FROM radiology_appointment_tab WHERE patient_id = ? AND time = ? AND date = ?");
            if ($check_stmt) {
                $check_stmt->bind_param("sss", $patient_id, $time, $date);
                $check_stmt->execute();
                $check_result = $check_stmt->get_result();
        
                if ($check_result->num_rows > 0) {
                    echo json_encode(array("success" => false, "message" => "Appointment already exists."));
                } else {
                    // Get the appointment ID sequence
                    $sequence = $callclass->_get_sequence_count($conn, 'RADAPP');
                    $array = json_decode($sequence, true);
                    $no = $array[0]['no'];
                    $appointment_id = 'RADAPP' . $no;
        
                    // Prepare the SQL INSERT query
                    $stmt = $conn->prepare("
                        INSERT INTO radiology_appointment_tab
                        (radiology_appointment_id, patient_id, patient_name, message, time, radiology_id, date)
                        VALUES (?, ?, ?, ?, ?, ?, ?)
                    ");
        
                    if ($stmt) {
                        // Bind the parameters
                        $stmt->bind_param(
                            "sssssss",
                            $appointment_id,
                            $patient_id,
                            $patient_name,
                            $comment,
                            $time,
                            $radiology_id,
                            $date
                        );
        
                        // Execute the statement and return the appropriate response
                        if ($stmt->execute()) {
                            echo json_encode(array("success" => true, "message" => "Patient transferred successfully."));
                        } else {
                            echo json_encode(array("success" => false, "message" => "Error executing query."));
                            error_log("SQL Error: " . $stmt->error);
                        }
        
                        // Close the statement
                        $stmt->close();
                    } else {
                        echo json_encode(array("success" => false, "message" => "Error preparing query."));
                        error_log("SQL Prepare Error: " . $conn->error);
                    }
                }
        
                // Close the check statement
                $check_stmt->close();
            } else {
                echo json_encode(array("success" => false, "message" => "Error preparing check query."));
                error_log("SQL Prepare Check Error: " . $conn->error);
            }
        
            break;
        
////////////morgue 


        case 'get_morgue':

            // Execute the query to fetch labs
            $query = mysqli_query($conn, "SELECT fullname,morgue_id FROM morgue_tab");

            // Check if the query executed successfully
            if ($query) {
                $morgue_unit = array();

                // Fetch the data from the result set
                while ($row = mysqli_fetch_assoc($query)) {
                    $morgue_unit[] = $row; // Storing data in $nurse
                }

                // Return the data as JSON
                echo json_encode(array("success" => true, "morgue" => $morgue_unit));
            } else {
                // Return an error message if the query failed
                echo json_encode(array("success" => false, "message" => "Error executing the query"));
            }
        break;

        
        case 'transfer_to_morgue':
            // Retrieve data from POST request and ensure required fields are provided
            $patient_id = $_POST['patient_id'] ?? null;
            $patient_name = $_POST['patient_name'] ?? null;
            $comment = $_POST['comment'] ?? null;
            $time = $_POST['time'] ?? null;
            $date = $_POST['date'] ?? null;
            $morgue_id = $_POST['morgueavailable'] ?? null;
            $status_id = "3"; // Default status ID for new transfer
            $emergency_unit_id = $_POST['emergency_unit_id'] ?? null;
        
            // Validate that required fields are not missing
            if (!$patient_id || !$patient_name || !$time || !$date || !$morgue_id || !$emergency_unit_id) {
                echo json_encode(array("success" => false, "message" => "Missing required data."));
                break;
            }
        
            // Check if the appointment already exists
            $check_stmt = $conn->prepare("SELECT * FROM morgue_appointment_tab WHERE patient_id = ? AND time_of_death = ? AND date_of_death = ?");
            if ($check_stmt) {
                $check_stmt->bind_param("sss", $patient_id, $time, $date);
                $check_stmt->execute();
                $check_result = $check_stmt->get_result();
        
                if ($check_result->num_rows > 0) {
                    // Fetch the row data and check if patient is already transferred
                    $row = $check_result->fetch_assoc();
                    if ($row['status_id'] == "3") {
                        echo json_encode(array("success" => true, "message" => "Patient has already been transferred."));
                    } else {
                        // Update record and proceed with appointment insertion
                        $update_query = "UPDATE emergency_patient_tab SET status_id = 3, time_of_transfer = NOW(), emergency_unit_id = ? WHERE emergency_patient_id = ?";
                        $update_stmt = $conn->prepare($update_query);
                        if ($update_stmt) {
                            $update_stmt->bind_param("ss", $emergency_unit_id, $patient_id);
                            $update_stmt->execute();
        
                            // Insert the new morgue appointment
                            $sequence = $callclass->_get_sequence_count($conn, 'MORGAPP');
                            $array = json_decode($sequence, true);
                            $no = $array[0]['no'];
                            $appointment_id = 'MORGAPP' . $no;
        
                            $stmt = $conn->prepare("
                                INSERT INTO morgue_appointment_tab
                                (morgue_appointment_id, patient_id, patient_name, message, time_of_death, staff_id, date_of_death)
                                VALUES (?, ?, ?, ?, ?, ?, ?)
                            ");
                            
                            if ($stmt) {
                                $stmt->bind_param("sssssss", $appointment_id, $patient_id, $patient_name, $comment, $time, $morgue_id, $date);
                                if ($stmt->execute()) {
                                    echo json_encode(array("success" => true, "message" => "Patient transferred successfully."));
                                } else {
                                    echo json_encode(array("success" => false, "message" => "Error executing query."));
                                    error_log("SQL Error: " . $stmt->error);
                                }
                                $stmt->close();
                            } else {
                                echo json_encode(array("success" => false, "message" => "Error preparing insert query."));
                                error_log("SQL Prepare Error: " . $conn->error);
                            }
                        } else {
                            echo json_encode(array("success" => false, "message" => "Error preparing update query."));
                            error_log("SQL Update Error: " . $conn->error);
                        }
                    }
                } else {
                    // echo json_encode(array("success" => false, "message" => "No existing appointment found for this patient."));
                      // Update record and proceed with appointment insertion
                      $update_query = "UPDATE emergency_patient_tab SET status_id = 3, time_of_transfer = NOW(), emergency_unit_id = ? WHERE emergency_patient_id = ?";
                      $update_stmt = $conn->prepare($update_query);
                      if ($update_stmt) {
                          $update_stmt->bind_param("ss", $emergency_unit_id, $patient_id);
                          $update_stmt->execute();
      
                          // Insert the new morgue appointment
                          $sequence = $callclass->_get_sequence_count($conn, 'MORGAPP');
                          $array = json_decode($sequence, true);
                          $no = $array[0]['no'];
                          $appointment_id = 'MORGAPP' . $no;
      
                          $stmt = $conn->prepare("
                              INSERT INTO morgue_appointment_tab
                              (morgue_appointment_id, patient_id, patient_name, message, time_of_death, staff_id, date_of_death)
                              VALUES (?, ?, ?, ?, ?, ?, ?)
                          ");
                          
                          if ($stmt) {
                              $stmt->bind_param("sssssss", $appointment_id, $patient_id, $patient_name, $comment, $time, $morgue_id, $date);
                              if ($stmt->execute()) {
                                  echo json_encode(array("success" => true, "message" => "Patient transferred successfully."));
                              } else {
                                  echo json_encode(array("success" => false, "message" => "Error executing query."));
                                  error_log("SQL Error: " . $stmt->error);
                              }
                              $stmt->close();
                          } else {
                              echo json_encode(array("success" => false, "message" => "Error preparing insert query."));
                              error_log("SQL Prepare Error: " . $conn->error);
                          }
                      } else {
                          echo json_encode(array("success" => false, "message" => "Error preparing update query."));
                          error_log("SQL Update Error: " . $conn->error);
                      }
                }
        
                // Close the check statement
                $check_stmt->close();
            } else {
                echo json_encode(array("success" => false, "message" => "Error preparing check query."));
                error_log("SQL Prepare Check Error: " . $conn->error);
            }
            break;
        
        


            case 'transfer_to_health_record':
                $patient_name = $_POST['patient_name'];
                $patient_id = $_POST['patient_id'];
                $comment = $_POST['comment'];
                $emergency_unit_id = $_POST['emergency_unit_id'];
            
                // Check if required data is missing
                if (!$patient_id || !$patient_name || !$comment) {
                    echo json_encode(array("success" => false, "message" => "Missing required data."));
                    break;
                }
            
                // Check if the patient record already exists
                $check_stmt = $conn->prepare("SELECT * FROM emergency_patient_tab WHERE emergency_patient_id = ?");
                if ($check_stmt) {
                    $check_stmt->bind_param("s", $patient_id);
                    $check_stmt->execute();
                    $check_result = $check_stmt->get_result();
            
                    if ($check_result->num_rows > 0) {
                        // Fetch the row data
                        $row = $check_result->fetch_assoc();
            
                        // Check if patient is already transferred
                        if ($row['status_id'] == "1") {
                            echo json_encode(array("success" => true, "message" => "Patient has already been transferred."));
                        } else {
                            // Update the record
                            $update_query = "UPDATE emergency_patient_tab SET status_id = 1, time_of_transfer = NOW(), emergency_unit_id = ? WHERE emergency_patient_id = ?";
                            $update_stmt = $conn->prepare($update_query);
                            if ($update_stmt) {
                                $update_stmt->bind_param("ss", $emergency_unit_id, $patient_id);
                                $update_stmt->execute();
                                echo json_encode(array("success" => true, "message" => "Patient transferred successfully."));
                            } else {
                                echo json_encode(array("success" => false, "message" => "Error preparing update query."));
                                error_log("SQL Update Error: " . $conn->error);
                            }
                        }
                    } else {
                        echo json_encode(array("success" => false, "message" => "Patient record not found."));
                    }
            
                    // Close the check statement
                    $check_stmt->close();
                } else {
                    echo json_encode(array("success" => false, "message" => "Error preparing check query."));
                    error_log("SQL Prepare Check Error: " . $conn->error);
                }
            
                break;
            
            
        


                        
                
            
        

    }
    
    

    ?>
     
