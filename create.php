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

<?php 
	include('templates/header.html');
?>
<section class="create">
    <div style="text-align: center;">
        <a href="result.php" class="btn btn-primary" style="display: inline;"> Go Back </a>
    </div>  
    <div class="wrapper fadeInDown">
        <div id="createform_content">  
          <form class="row g-3">
            <div class="">
              <label for="CourseID" class="form-label">CourseID </label>
              <br>
              <input type="text" class="form-control" id="CourseID" name="CourseID" required>
            </div>
            <div class="">
              <label for="CourseName" class="form-label">Course Name</label>
              <br>
              <input type="text" class="form-control" id="CourseName" name="CourseName" required>
            </div>
            <div class="">
              <label for="Credits" class="form-label" step=0.1>Credits</label>
              <br>
              <input type="number" class="form-control" id="Credits" name="Credits" required>
            </div>
            <div class="">
              <label for="Term" class="form-label">Term</label>
              <br>
              <div id="Term" name="Term">
                <select class="form-select" id="autoSizingSelect">
                  <option selected disabled>Choose</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>  
            </div>
            <br>
            <div class="">
              <label for="TotalHours" class="form-label">Total Hours</label>
              <br>
              <input type="text" class="form-control" id="TotalHours" name="TotalHours">
            </div>
            <div class="">
              <label for="ClassroomType" class="form-label">Classroom Type</label>
              <br>
              <input type="text" class="form-control" id="ClassroomType" name="ClassroomType">   
            </div>
            <div class="">
              <label for="Tution" class="form-label" >Tution</label>
              <br>
              <input type="number" class="form-control" id="Tution" name="Tution" required step=0.1>
            </div>
            <div class="">
              <label for="description" class="form-label">Description</label>
              <br>
              <input type="text" class="form-control" id="description" name="Description">
            </div>
            <div class="">
              <button type="reset" class="btn btn-primary">Reset&nbsp; </button>
              <button type="submit" class="btn btn-primary"> Submit </button>
            </div>
          </form>
        </div>
    </div>
</section>
<?php
   include('templates/footer.html')
?>
  