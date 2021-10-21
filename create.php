

<?php 
    $title = 'Create New Record';
	include('templates/header.html');
?>
<section class="create">

    <div class="wrapper fadeInDown">
        <a href="index.php" class="btn btn-primary" id="goback_btn"> Send Me Back </a>
        <div id="createform_content">
        <h3> CREATE NEW COURSE </h3>  
   
          <form class="row g-3">
            <div class="">
              <label for="CourseID" class="form-label">CourseID </label>
              <br>
              <input type="text" class="form-control" id="CourseID" maxlength="7" name="  CourseID" placeholder="Course ID" required>
            </div>
            <div class="">
              <label for="CourseName" class="form-label">Course Name</label>
              <br>
              <input type="text" class="form-control" id="CourseName" maxlength="68" name="  CourseName" placeholder="Course Name" required>
            </div>
            <div class="">
              <label for="Credits" class="form-label" step=0.1>Credits</label>
              <br>
              <input type="number" class="form-control" min="0" max="99.9" step="0.1" id="Credits"  name="Credits" placeholder="0-99.9 " required>
            </div>
            <div class="">
              <label for="Term" class="form-label">Term</label>
              <br>
              <input name="Term" type="number" min="1" max="127" step="1" placeholder="  (Integer) 1- 127">
            </div>
            <br>
            <div class="">
              <label for="TotalHours" class="form-label">Total Hours</label>
              <br>
              <input type="number" class="form-control" id="TotalHours" name="TotalHours" step="1" min="1" max="99" placeholder="  (Integer) 0-99">
            </div>
            <div class="">
              <label for="ClassroomType" class="form-label">Classroom Type</label>
              <br>
              <input type="text" class="form-control" id="ClassroomType" name="ClassroomType" placeholder="NULL - varchar(0)" disabled>   
            </div>
            <div class="">
              <label for="Tution" class="form-label" >Tution</label>
              <br>
              <input type="number" class="form-control" id="Tution" name="Tution" required step=0.0001 placeholder="Positive Number only">
            </div>
            <div class="">
              <label for="description" class="form-label">Description</label>
              <br>
              <textarea rows="5" cols="35" maxlength="150" id="description" name="Description" placeholder="   Max 150 words.."></textarea>
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



<?php
    // Include config file
    require_once "config.php";
     
    // Define variables and initialize with empty values
    $courseName = $courseID = $credits = $classroomType = $totalHours = $term = $tuition = "";
    $courseName_err = $courseID_err =$credits_err= $classroomType_err = $totalHours_err = $term_err = $tuition_err = "";

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        // Validate courseID (NOT EMPTY)
        $input_courseID = trim($_POST["courseID"]);
        if(empty($input_courseID)){
            $courseID_err = "Please enter a Course ID .";
        } elseif(!filter_var($input_courseID, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"[A-Za-Z ][A-Za-z0-9 ]*")))){
            $name_err = "Please enter a valid Course ID.";
        } else{
            $courseID = $input_courseID; 
        }

        // Validate name 
        $input_courseName = trim($_POST["courseName"]);
        if(empty($input_courseName)){
            $name_err = "Please enter a name for course.";
        } elseif(!filter_var($input_courseName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            $name_err = "Please enter a valid course name.";
        } else{
            $courseName = $input_courseName; 
        }

        // Validate Credits (NOT EMPTY)
        $input_credits = trim($_POST["Credits"]);
        if(empty($input_credits)){
            $credits_err = "Please enter credits for this course.";     
        } elseif(!is_numeric($input_credits)){
            $credits_err = "Please enter a positive value.";
        } else{
            $credits = $input_credits;
        }

        // Validate Total Hours
        $input_totalHours = trim($_POST["TotalHours"]);
        if(!ctype_digit($input_totalHours) && !empty($input_totalHours)){
            $totalHours_err = "Please enter a positive integer value.";
        } else{
            $totalHours = $TotalHours;
        }
        

        // Validate Tuition
        $input_tuition = trim($_POST["Tuition"]);
        if(empty($input_classroomType)){
            $tuition_err = "Please enter the salary amount.";     
        } elseif(!ctype_digit($input_classroomType)){
            $tuition_err = "Please enter a positive integer value.";
        } else{
            $tuition = $input_tuition;
        }
        // Set Description
        $description = trim($_POST["Description"]);
        
        /*=================================================
         Check input errors before inserting in database
         ==================================================*/
        if(empty($name_err) && empty($courseID_err) && empty($classroomType_err) && ($totalHours_err) && ($tuition_err)){
            // Prepare an insert statement
            $sql = "INSERT INTO courses (CourseID, CourseName, Credits, TotalHours, Term, Tution, Description) VALUES (?, ?, ?, ?, ?, ?, ?)";
             
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sss", $param_id, $param_name, $param_credits, $param_hours, $param_classroom, $param_term, $param_tuition, $param_desc);
                
                // Set parameters
                $param_id = $courseID;
                $param_name = $courseName;
                $param_credits = $credits;
                $param_hours = $totalHours;
                $param_classroom = $classroomType;
                $param_term = $term;
                $param_tuition = $tuition;
                $param_desc = $description;

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