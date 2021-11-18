<?php
session_start();
if (!isset($_SESSION['user'])){
    header("location: noacess.php");
}
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM hospitals WHERE HospitalID = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
        mysqli_stmt_close($stmt);

    }
     
    // Close statement
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>


<?php 
    $title = 'Create New Record';
    include_once('templates/header.html');
 
?>
<section>
    <div class="wrapper bg-white ">
    <div class="d-flex justify-content-center">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>HospitalID</label>
                        <p><b><?php echo $row['HospitalID']; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>HospitalName</label>
                        <p><b><?php echo $row["HospitalName"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <p><b><?php echo $row["Address"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <p><b><?php echo $row["City"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>PostalCode</label>
                        <p><b><?php echo $row["PostalCode"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Country</label>
                        <p><b><?php echo $row["Country"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p><b><?php echo $row["Email"]; ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<?php
    include('templates/footer.html')
?>