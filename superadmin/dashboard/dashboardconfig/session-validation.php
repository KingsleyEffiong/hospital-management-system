<?php
    if (empty($s_staff_id)) {
        session_destroy();
?>
        <script>
            window.parent.location = "<?php echo $website_url?>/superadmin";
        </script>
<?php
        exit; // Exit the script if $s_staff_id is empty
    } else {
        $fetch_user = $callclass->_get_user_details($conn, $s_staff_id);
        $user_array = json_decode($fetch_user, true);
        $fullname = $user_array[0]['fullname'];
        $passport = $user_array[0]['passport'];
        $last_login = $user_array[0]['last_login'];
    }
?>

<?php
    if (empty($s_staff_id)) {
        session_destroy();
?>
        <script>
            window.parent.location = "<?php echo $website_url?>/superadmin";
        </script>
<?php
    }
?>
