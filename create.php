<?
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$input_courseName = $input_courseID = $input_classroomType = "";
$input_totalHours = $input_term = $input_tuition = "";
$input_description = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_courseName = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_courseName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $courseName = $input_name; 
    }
    
    // Validate courseID
    $input_courseID = trim($_POST["courseID"]);
    if(empty($courseID)){
        $name_err = "Please enter a Course ID .";
    } elseif(!filter_var($input_courseName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid Course ID.";
    } else{
        $courseName = $input_name; 
    }
    
    // Validate Credit
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value.";
    } else{
        $salary = $input_salary;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($_err) && empty($salary_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO courses (name, address, salary) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_address, $param_salary);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> Create New Record | Assignment 2 </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<header >
		<?php 
			include('templates/header.html');
		?>
	</header>
    <section class="create">  
        <div class="wrapper bg-white">
          
          <form class="row g-3">
            <div class="">
              <label for="CourseID" class="form-label">CourseID </label>
              <input type="text" class="form-control" id="CourseID" name="CourseID" required>
            </div>
            <div class="">
              <label for="CourseName" class="form-label">Course Name</label>
              <input type="text" class="form-control" id="CourseName" name="CourseName" required>
            </div>
            <div class="">
              <label for="Credits" class="form-label" step=0.1>Credits</label>
              <input type="number" class="form-control" id="Credits" name="Credits" required>
            </div>
            <div class="">
              <label for="Term" class="form-label">Term</label>
              <div id="Term" name="Term">
                <select class="form-select" id="autoSizingSelect">
                  <option selected disabled>Choose</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>  
            </div>
            <div class="">
              <label for="TotalHours" class="form-label">Total Hours</label>
              <input type="text" class="form-control" id="TotalHours" name="TotalHours">
            </div>
            <div class="">
              <label for="ClassroomType" class="form-label">Classroom Type</label>
              <input type="text" class="form-control" id="ClassroomType" name="ClassroomType">   
            </div>
            <div class="">
              <label for="Tution" class="form-label" >Tution</label>
              <input type="number" class="form-control" id="Tution" name="Tution" required step=0.1>
            </div>
            <div class="">
              <label for="inputZip" class="form-label">Description</label>
              <input type="text" class="form-control" id="inputZip">
            </div>
            <div class="">
              <input type="reset" class="btn btn-primary"></input>
            </div>
            <div class="">
              <button type="submit" class="btn btn-primary"> Submit </button>
            </div>
          </form>
        </div>
    </section>
    <footer>	
        <?php
    	   include('templates/footer.html')
        ?>
    </footer>
</body>
</html>