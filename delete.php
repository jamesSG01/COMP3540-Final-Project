
<?php
    // Process delete operation after confirmation
    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        // Include config file
        require_once "config.php";
        // Prepare a delete statement
        $sql = "UPDATE hospitals SET deleted=1 WHERE HospitalID = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Set parameters
            $param_id = $_POST[''];
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, 's', $param_id);
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records deleted successfully. Redirect to landing page
                header("location: index.php?success");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    } else{
        // Check existence of id parameter
        if(empty(trim($_GET["id"]))){
            // URL doesn't contain id parameter. Redirect to error page
            header("location: error.php");
            exit();
        }
    }
?>

<?php 
    $title = 'Delete Record';
    include_once('templates/header.html');
?>
<section class="create">

    <div class="wrapper fadeInDown">
        <div id="createform_content">
        <?php echo '<h3>DELETE HOSPITAL RECORD: <code>'. $_GET['id'].'</code></h3>' ?> 
          <form class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="text" class="form-control" name="CourseID" value=<?php echo $_GET["id"];?> hidden >
                <div class="">
                    <button type="submit" class="btn btn-primary" value="Submit"> Delete it </button>
                    <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                </div>
          </form>
        </div>
    </div>
</section>

<?php
   include('templates/footer.html')
?>





