
<?php
    if ($s_staff_id==''||$s_doctor_id=''){
?>
       <script>
            window.parent(location="../");
        </script> 
<?php
    }else{
        $fetch_user=$callclass->_get_user_details($conn, $s_staff_id,$website_url);
        $user_array = json_decode($fetch_user, true);
        $staff_id= $user_array[0]['staff_id'];
        $fullname= $user_array[0]['fullname'];
        $email= $user_array[0]['email'];
        $phonenumber= $user_array[0]['phonenumber'];
        $passport= $user_array[0]['passport'];


        $fetch_user=$callclass->_get_doctor_details($conn, $s_doctor_id,$website_url);
        $user_array = json_decode($fetch_user, true);
        $doctor_id= $user_array[0]['doctor_id'];
        $fullname= $user_array[0]['fullname'];
        $doctor_email= $user_array[0]['doctor_email'];
        $phonenumber= $user_array[0]['phonenumber'];
        $passport= $user_array[0]['passport'];


       }
?>

 
