<?php include '../../../backend/config/connection.php'?>


<?php include '../../../backend/dashboardconfig/session-validation.php';
      include '../../../../backend/config/search.php';?>




<?php
// session_start();
// $_SESSION['current_patient_id'] = $scheck;
//  $patient_id= $_POST['patient_id'];
//  echo $patient_id;

?>



<?php    



$fetch_patient_profile = $callclass->_get_patient_details($conn, $patient_id);

$patient_profile_array = json_decode($fetch_patient_profile, true);

if ($patient_profile_array) {
    $sn = $patient_profile_array['sn'];
    $fullname = $patient_profile_array['fullname'];
    $email = $patient_profile_array['email'];
    $phonenumber = $patient_profile_array['phonenumber'];
    $status_id = $patient_profile_array['status_id'];
    $category_id = $patient_profile_array['category_id'];
    $date = $patient_profile_array['date'];
    $last_login = $patient_profile_array['last_login'];
    $passport = $patient_profile_array['passport'];
} else {
    $fullname=  "error";
    // Handle the case where the patient details were not found.
    // You might want to return an error message or take other appropriate action.
}


    $fetch_status = $callclass->_get_status_details($conn, $status_id);
    $status_array = json_decode($fetch_status, true);
    
    if ($status_id) {
        $status_name = $status_array['status_name'];
    } else {
        // Handle the case where status details were not found.
        // You might want to return an error message or take other appropriate action.
    }




    // $fetch_category = $callclass->_get_category_details($conn, $category_id);

    // // Check if the category details were successfully retrieved
    // if ($fetch_category !== false) {
    //     $category_array = json_decode($fetch_category, true);
    
    //     // Check if category_name exists in the response
    //     if (isset($category_array['category_name'])) {
    //         $category_name = $category_array['category_name'];
    //     } else {
    //         // Handle the case where category_name was not found in the response.
    //         // You might want to return an error message or take other appropriate action.
    //     }
    // } else {
    //     // Handle the case where category details were not found.
    //     // You might want to return an error message or take other appropriate action.
    // }
    
    $fetch_pcount = $callclass->_get_total_count($conn, $pcount);
    $pcount_array = json_decode($fetch_pcount, true);
    $pcount = $pcount_array['counter_id'];
    
?>
 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../awesome-font/css/font-awesome.min.css" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" href="../css/index.css">
    <script src ="js/patient.js"></script>
    <script src="js/jquery-v3.6.1.min.js"></script>
    <link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Patient</title>
</head>
<body>
   <div class="patient-container">
    <div  class="patient-navbar">
        <!---BACK ARROW-->
        <i class="fa fa-long-arrow-left " id='back-arrow' onClick='backWardArrow()'></i>
        <h2>Patient Admission Lists</h2>
    </div>
        <!-- <div class="nav-menu">
            <ul class="menu-items">
                <a href="#">
                <li class="items">
                    <i class="fa fa-book "></i>
                    <h4>Notes</h4>
                </li>
            </a>
                <a href="#">
                <li class="items">
                    <i class="fa fa-check "></i>
                    <h4>Activity Log</h4>
                </li>
            </a>
                <a href="#">
                <li class="items">
                    <i class="fa fa-registered"></i>
                    <h4>Results</h4>
                </li>
            </a>
                <a href="#">
                <li class="items">
                    <i class="fa fa-bed"></i>
                    <h4>Wards</h4>
                </li>
            </a>
                <a href="#">
                <li class="items">
                    <i class="fa fa-user-circle-o"></i>
                    <h4>Reception</h4>
                </li>
            </a>
            </ul>
    </div>
    -->
    <div class="search_table_container">
    <div class="search-container">
    <div class="search-bar">
        <div id="select">
            <p id="selectText"></p>
            <i class="fa fa-sort-desc"></i>
            
    <ul id="list">
        <li class="options" id="0" onclick="showTable('All')">All</li>
        <li class="options" id="1" onclick="showTable('Inpatients')">Inpatients</li>
        <li class="options" id="2" onclick="showTable('Outpatients')">Outpatients</li>
        <li class="options" id="3" onclick="showTable('Waitinglist')">Waiting List</li>
        <li class="options" id="4" onclick="showTable('Appointment')">Appointment</li>
        <li class="options" id="5"  onclick="showTable('Test')">Test</li>
        <li class="options" id="6"  onclick="showTable('ANC')">ANC</li>
        <li class="options" id="7"  onclick="showTable('Todayinputs')">Today inputs</li>
        <!-- Add more options here -->
    </ul>




    <!-- <ul id="list">
    <li class="options" id="0" onclick="showTable('categoryAll')">All</li>
    <li class="options" id="1" onclick="showTable('categoryInpatients')">Inpatients</li>
     Add similar list items for other categories
</ul> -->




        </div>

      
            <input id="search_term" onkeyup="_fetch_patient_list()" name="search_term" type="text" placeholder="Type here to search..." title="Type here to search" />
          
            <i class="fa fa-search" onclick="_fetch_patient_list()" id="submit-input"> <?php echo $pcount ?></i>
      
    </div> 
    </div>
    <!-- </form> -->
  
    <div class="div-table" >
    <table id="All" >
    <?php $sql = "SELECT * FROM patient_tab"; 
    $result = $conn->query($sql);
    ?>
    <thead> 
        <th>
             <d>#</d>
        </th>
        <th>
             <d>id</d>
        </th>
        <th>
             <d>Pp</d>
        </th>
        <th>
            <d>Patient</d>
        </th>
        <th>
            <d>Number</d>
        </th>
        <th>
            <d>Date</d>
        </th>
        <th>
            <d>Status</d>
        </th>
    </thead>              
    <!-- ///////////////////////////////////////////////////////////////////// -->
        <tbody id="searchResultsBody" >
        <?php
       
       if ($result->num_rows > 0) {
           while ($row = $result->fetch_assoc()) {
           
               $patient_id = $row["patient_id"];
               $_POST['patient_id'] = $patient_id;
            //    echo $_POST['patient_id'];
               echo "<tr data-patient-id='$patient_id' onClick='next_page(this);'>";

                // $spatient_id= $patient_id;
            


                    echo "<td>" . $row["sn"] . "</td>";
                    // echo "<td>" . $row["passport"] . "</td>";
                    echo "<td>". $row["patient_id"] . "</td>";
                    echo "<td><img src='" . $website_url . "/uploaded_files/profile_pix/patient/" . $row["patient_passport"] . "' alt='Profile Picture'/></td>";

                    echo "<td>" . $row["fullname"] . "</td>";
                    echo "<td>" . $row["phonenumber"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td><i class='fa fa-circle' data-value='" . $row["status_id"] . "' data-status='" . $row["status_name"] . "'></i> " . $row["status_name"] . "</td>";
               echo "</tr>";
           }
       } else {
           echo "<tr><td colspan='6'>No records found</td></tr>";
       }
       ?>
       
        </tbody>
    </table>


<!-- inpatients table -->


    

<!-- <table id="All" class="category-table">
    Table content for "All" category 
</table> -->

<table id="Inpatients" class="category-table" style="display: none;">

<?php $sql = "SELECT * FROM patient_tab WHERE category_id = '1'" or die("cant fetch"); 
    $result = $conn->query($sql);
    ?>

<thead> 
        <th>
             <d>#</d>
        </th>
        <th>
             <d>id</d>
        </th>
        <th>
            <d>Patient's Name</d>
        </th>
        <th>
            <d>Number</d>
        </th>
        <!-- <th>
            <d>Category</d>
        </th> -->
        <th>
            <d>Date</d>
        </th>
        <th>
            <d>Status</d>
        </th>
    </thead>              
        <tbody id="searchResultsBody" >
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["sn"] . "</td>";
                    echo "<td>" . $row["patient_id"] . "</td>";
                    echo "<td>" . $row["fullname"] . "</td>";
                    echo "<td>" . $row["phonenumber"] . "</td>";
                    
                    // echo "<td>" . $row["status_id"] . "</td>";
                    // echo "<td>" .$row['$category_name'] . $category_name . "</td>";
              
                echo "<td>" . $row["date"] . "</td>";
                echo "<td><i class='fa fa-circle' data-value='" . $row["status_id"] . "' data-status='" . $row["status_name"] . "'></i> " . $row["status_name"] . "</td>";
              
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>
        </tbody>
    <!-- Table content for "Inpatients" category -->
</table>


<!-- outpatients table -->

<table id="Outpatients" class="category-table" style="display: none;">

<?php $sql = "SELECT * FROM patient_tab WHERE category_id = '2'" or die("cant fetch"); 
    $result = $conn->query($sql);
    ?>

<thead> 
        <th>
             <d>#</d>
        </th>
        <th>
             <d>id</d>
        </th>
        <th>
            <d>Patient's Name</d>
        </th>
        <th>
            <d>Number</d>
        </th>
       
        <th>
            <d>Date</d>
        </th>
        <th>
            <d>Status</d>
        </th>
    </thead>              
        <tbody id="searchResultsBody" >
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["sn"] . "</td>";
                    echo "<td>" . $row["patient_id"] . "</td>";
                    echo "<td>" . $row["fullname"] . "</td>";
                    echo "<td>" . $row["phonenumber"] . "</td>";
                    
                    // echo "<td>" . $row["status_id"] . "</td>";
                    // echo "<td>" .$row['$category_name'] . $category_name . "</td>";
              
                echo "<td>" . $row["date"] . "</td>";
                echo "<td><i class='fa fa-circle' data-value='" . $row["status_id"] . "' data-status='" . $row["status_name"] . "'></i> " . $row["status_name"] . "</td>";
              
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>
        </tbody>
    <!-- Table content for "Inpatients" category -->
</table>

<!-- WaitingList table -->

<table id="Waitinglist" class="category-table" style="display: none;">

<?php $sql = "SELECT * FROM patient_tab WHERE category_id = '3'" or die("cant fetch"); 
    $result = $conn->query($sql);
    ?>

<thead> 
        <th>
             <d>#</d>
        </th>
        <th>
             <d>id</d>
        </th>
        <th>
            <d>Patient's Name</d>
        </th>
        <th>
            <d>Number</d>
        </th>
        <!-- <th>
            <d>Category</d>
        </th> -->
        <th>
            <d>Date</d>
        </th>
        <th>
            <d>Status</d>
        </th>
    </thead>              
        <tbody id="searchResultsBody" >
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["sn"] . "</td>";
                    echo "<td>" . $row["patient_id"] . "</td>";
                    echo "<td>" . $row["fullname"] . "</td>";
                    echo "<td>" . $row["phonenumber"] . "</td>";
                    
                    // echo "<td>" . $row["status_id"] . "</td>";
                    // echo "<td>" .$row['$category_name'] . $category_name . "</td>";
              
                echo "<td>" . $row["date"] . "</td>";
                echo "<td><i class='fa fa-circle' data-value='" . $row["status_id"] . "' data-status='" . $row["status_name"] . "'></i> " . $row["status_name"] . "</td>";
              
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>
        </tbody>
</table>


<!-- Appointment table -->
<table id="Appointment" class="category-table" style="display: none;">

<?php $sql = "SELECT * FROM patient_tab WHERE category_id = '4'" or die("cant fetch"); 
    $result = $conn->query($sql);
    ?>

<thead> 
        <th>
             <d>#</d>
        </th>
        <th>
             <d>id</d>
        </th>
        <th>
            <d>Patient's Name</d>
        </th>
        <th>
            <d>Number</d>
        </th>
        <!-- <th>
            <d>Category</d>
        </th> -->
        <th>
            <d>Date</d>
        </th>
        <th>
            <d>Status</d>
        </th>
    </thead>              
        <tbody id="searchResultsBody" >
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["sn"] . "</td>";
                    echo "<td>" . $row["patient_id"] . "</td>";
                    echo "<td>" . $row["fullname"] . "</td>";
                    echo "<td>" . $row["phonenumber"] . "</td>";
                    
                    // echo "<td>" . $row["status_id"] . "</td>";
                    // echo "<td>" .$row['$category_name'] . $category_name . "</td>";
              
                echo "<td>" . $row["date"] . "</td>";
                echo "<td><i class='fa fa-circle' data-value='" . $row["status_id"] . "' data-status='" . $row["status_name"] . "'></i> " . $row["status_name"] . "</td>";
              
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>
        </tbody>
</table>

<!-- Test table -->
<table id="Test" class="category-table" style="display: none;">

<?php $sql = "SELECT * FROM patient_tab WHERE category_id = '5'" or die("cant fetch"); 
    $result = $conn->query($sql);
    ?>

<thead> 
        <th>
             <d>#</d>
        </th>
        <th>
             <d>id</d>
        </th>
        <th>
            <a href =""<d>Patient's Name</d>
        </th>
        <th>
            <d>Number</d>
        </th>
        <!-- <th>
            <d>Category</d>
        </th> -->
        <th>
            <d>Date</d>
        </th>
        <th>
            <d>Status</d>
        </th>
    </thead>              
        <tbody id="searchResultsBody" >
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["sn"] . "</td>";
                    echo "<td>" . $row["patient_id"] . "</td>";
                    echo "<td>" . $row["fullname"] . "</td>";
                    echo "<td>" . $row["phonenumber"] . "</td>";
                    
                    // echo "<td>" . $row["status_id"] . "</td>";
                    // echo "<td>" .$row['$category_name'] . $category_name . "</td>";
              
                echo "<td>" . $row["date"] . "</td>";
                echo "<td><i class='fa fa-circle' data-value='" . $row["status_id"] . "' data-status='" . $row["status_name"] . "'></i> " . $row["status_name"] . "</td>";
              
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>
        </tbody>
</table>



<!-- ANC table -->
<table id="ANC" class="category-table" style="display: none;">

<?php $sql = "SELECT * FROM patient_tab WHERE category_id = '6'" or die("cant fetch"); 
    $result = $conn->query($sql);
    ?>

<thead> 
        <th>
             <d>#</d>
        </th>
        <th>
             <d>id</d>
        </th>
        <th>
            <d>Patient's Name</d>
        </th>
        <th>
            <d>Number</d>
        </th>
        <!-- <th>
            <d>Category</d>
        </th> -->
        <th>
            <d>Date</d>
        </th>
        <th>
            <d>Status</d>
        </th>
    </thead>              
        <tbody id="searchResultsBody">
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["sn"] . "</td>";
                    echo "<td>" . $row["patient_id"] . "</td>";
                    echo "<td>" . $row["fullname"] . "</td>";
                    echo "<td>" . $row["phonenumber"] . "</td>";
                    
                    // echo "<td>" . $row["status_id"] . "</td>";
                    // echo "<td>" .$row['$category_name'] . $category_name . "</td>";
              
                echo "<td>" . $row["date"] . "</td>";
                echo "<td><i class='fa fa-circle' data-value='" . $row["status_id"] . "' data-status='" . $row["status_name"] . "'></i> " . $row["status_name"] . "</td>";
              
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>
        </tbody>
</table>






<!-- todaysinput table -->
<table id="Todayinputs" class="category-table" style="display: none;">

<?php $sql = "SELECT * FROM patient_tab WHERE category_id = '7'" or die("cant fetch"); 
    $result = $conn->query($sql);
    ?>

<thead> 
        <th>
             <d>#</d>
        </th>
        <th>
             <d>id</d>
        </th>
        <th>
            <d>Patient's Name</d>
        </th>
        <th>
            <d>Number</d>
        </th>
        <!-- <th>
            <d>Category</d>
        </th> -->
        <th>
            <d>Date</d>
        </th>
        <th>
            <d>Status</d>
        </th>
    </thead>              
        <tbody id="searchResultsBody" >
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["sn"] . "</td>";
                    echo "<td>" . $row["patient_id"] . "</td>";
                    echo "<td>" . $row["fullname"] . "</td>";
                    echo "<td>" . $row["phonenumber"] . "</td>";
                    
                    // echo "<td>" . $row["status_id"] . "</td>";
                    // echo "<td>" .$row['$category_name'] . $category_name . "</td>";
              
                echo "<td>" . $row["date"] . "</td>";
                echo "<td><i class='fa fa-circle' data-value='" . $row["status_id"] . "' data-status='" . $row["status_name"] . "'></i> " . $row["status_name"] . "</td>";
              
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>
        </tbody>
</table>

</div>

<!-- end of tables -->





</div>
   </div>
   <script>
    const select =  document.getElementById("select");
    const list = document.getElementById("list");
    const selectText = document.getElementById("selectText");
    const options = document.getElementsByClassName("options");
    const inputfield = document.getElementById("inputfield");
    const submitInput = document.getElementById("submit-input");
    const id = document.getElementById("id");

    select.addEventListener("click", function(){
        list.classList.toggle("open");
    })

    const user = 1;
    submitInput.addEventListener("load", function(){
        submitInput.innerHTML = user.toString();
    })

    for(option of options){
        option.addEventListener("click", function(){
            selectText.innerHTML = this.innerHTML,id;
            inputfield.placeholder = 'Search In ' + selectText.innerHTML
        })
    }
    </script>










<!-- ////tomzy's script  -->


<script>



    // Select all elements with the class "color_change_class"
    var elements = document.querySelectorAll('.fa-circle');

    // Iterate through the elements and apply the color change
    elements.forEach(function (element) {
        var value = element.getAttribute('data-value');

        if (value === "1") {
            element.style.color = "#00ff00";
        } else if (value === "2") {
            element.style.color = "#ffe200";
        }
    });


        //////////////////////////////////////////////////////


















// end of tomiwa's script
   

// //     //Patient Page redirecting
//     function openNewPage(patient_id) {
//     // The URL of the page you want to open.
//     var url = 'patients_profile.php?id=' + patient_id; // Include the patient_id as a query parameter

//     // Open the new page in the current browser window or tab.
//     window.parent(location =( url));
// }


///////////////////
    //BACK ARROW TO THE DASHBOARD
    function backWardArrow(){
        var urlBackwardArrow = '../dashboard.php';
        window.parent(location=(urlBackwardArrow));
      
    }

</script>



