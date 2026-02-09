<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['userType'])) {
include('../assets/includes/header.php');
include('../assets/includes/navbar_faculty.php');
require '../db_conn.php';


if(isset($_GET['page'])) {
    $page = $_GET['page'];
    $_SESSION['page'] = $page; // Adding 'page' value to session
} else if(isset($_SESSION['page'])) {
    $page = $_SESSION['page'];
} else {
    // Redirect to reports.php when 'page' parameter is not set
    header("Location: reports.php");
    exit(); // Ensure that script execution stops after the redirection
}


?>


  <main id="main" class="main">

<div class="pagetitle">
    <h1><?php echo ucfirst(str_replace('_', ' ', substr($page, 0, -4))); ?></h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="navbar_faculty.php">Home</a></li>
            <li class="breadcrumb-item">Reports</li>
            <li class="breadcrumb-item active"><?php echo ucfirst(str_replace('_', ' ', substr($page, 0, -4))); ?></li>
        </ol>
    </nav>
</div><!-- End Page Title -->



<script>
            <?php
            // Check if the session message exists and show it as a SweetAlert
            if (isset($_SESSION['message'])) {
                echo "Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '{$_SESSION['message']}',
                        showConfirmButton: false,
                        timer: 2000,
                        customClass: {
                            popup: 'my-sweetalert',
                        }
                    });";
                unset($_SESSION['message']); // Clear the session message after displaying it
            }

            if (isset($_SESSION['message_danger'])) {
                echo "Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: '{$_SESSION['message_danger']}',
                        showConfirmButton: false,
                        timer: 2000,
                        customClass: {
                            popup: 'my-sweetalert',
                        }
                    });";
                unset($_SESSION['message_danger']); // Clear the session message after displaying it
            }
            ?>
        </script>


<section class="section">

              <?php

// Include the file based on the value of $page
if(isset($page)) {
    $file_path = '../report_filter/' . $page;
    include($file_path);
}
?>


</section>



  </main><!-- End #main -->



<?php 
 }else{
    header("Location: ../faculty-portal.php");
    exit();
 }
 ?>
<?php
include('../assets/includes/footer.php');
?>





