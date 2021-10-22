
<?php
    // Include config file
    require_once "config.php";    
    // Define variables and initialize with empty values
    $CourseName = $CourseID = $Credits = $TotalHours = $Term = $Tuition = $Descripion ="";
    $courseName_err = $courseID_err = $credits_err = $totalHours_err = $descripion_err = $term_err = $tuition_err = null;

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        //GET FORM DATA
        $input_courseID = strtoupper(trim($_POST["CourseID"]));
        $input_courseName = trim($_POST["CourseName"]);
        $input_credits = trim($_POST["Credits"]);
        $input_totalHours = trim($_POST["TotalHours"]);
        $input_term = trim($_POST["Term"]);
        $input_tuition = trim($_POST["Tuition"]);
        $input_description = trim($_POST["Description"]);

        
        // Validate courseID (NOT EMPTY)
        if(empty($input_courseID)){
            $courseID_err = "Please enter a Course ID .";
        } elseif(preg_match('/[!\'^£$%&*()}{@#~?><>,|=_+¬-]/', $input_courseID)){
            $courseID_err = "Please enter a valid Course ID.";
        } else {
            $result = mysqli_query($link,"SELECT * FROM courses WHERE CourseID='$input_courseID'");
            $num_rows = mysqli_num_rows($result);
            if ($num_rows) {
                $courseID_err = "Duplicated CourseID";
            } else{
                $CourseID = $input_courseID; 
            }
        }
        
        // Validate name 
        if(empty($input_courseName)){
            $courseName_err = "Please enter a name for course.";
        } elseif(preg_match('/[!\'^£$%&*()}{@#~?><>,|=_+¬-]/', $input_courseName)){
            $courseName_err = "Please enter a valid course name.";
        } else{
            $CourseName = $input_courseName; 
        }
        
        // Validate Credits (NOT EMPTY)
        if(empty($input_credits)){
            $credits_err = "Please enter credits for this course.";     
        } elseif(!is_numeric($input_credits) ){
                $credits_err = "Invalid Value.";
        } else{
            $Credits = $input_credits;
        }
        

        // Validate Total Hours
        if(!ctype_digit($input_totalHours) && !empty($input_totalHours)){
            $totalHours_err = "Invalid Value.";
        } elseif ($input_totalHours<0 && !empty($input_totalHours) ){
            $totalHours_err = "Out of bounds !";
        } 
        else{
            $TotalHours = $input_totalHours;
        }
        
   
        // Validate Term
        if(!ctype_digit($input_term) && !empty($input_term)){
            $term_err = "Invalid Value.";
        } elseif ($input_term<0 && !empty($input_totalHours)){
            $totalHours_err = "Out of bounds !";
        } else{
            $Term = $input_term;
        }
             
        
        // Validate Tuition
        if(empty($input_tuition)){
            $tuition_err = "Please enter tuition for this course."; 
        } elseif(!ctype_digit($input_tuition)){
            $tuition_err = "Please enter a valid value.";
        } elseif ($input_tuition<0){
            $totalHours_err = "Out of bounds !";
        }else{
            $Tuition = $input_tuition;
        }
            
  
        // Validate Description 
        if(preg_match('/[!\'^£$%&*()}{@#~?><>,|=_+¬-]/', $input_description)){
            $descripion_err = "Description cannot contain special characters.";
        } else{
            $Descripion = $input_description; 
        }
        
        // PROCEED IF THERE IS NO ERROR
        if(empty($courseName_err)  && empty($courseID_err)   && empty($term_err) && empty($tuition_err) && empty($credits_err) && empty($totalHours_err)){
            //query
            $sql = "INSERT INTO courses (`CourseID`, `CourseName`, `Credits`, `TotalHours`, `Term`, `Tuition`, `Description`) VALUES ('$CourseID','$CourseName','$Credits','$TotalHours','$Term','$Tuition','$Descripion');";
            mysqli_query($link,$sql);
        
            // Close connection
            mysqli_close($link);
            
            // Records created successfully. Redirect to landing page
            header("location: index.php?success");
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
?>


<?php 
    $title = 'Create New Record';
    include_once('templates/header.html');
?>
<section class="create">

    <div class="wrapper fadeInDown">
        <div id="createform_content">
        <h3> CREATE NEW COURSE </h3>  
   
          <form class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="">
              <label for="CourseID" class="form-label">CourseID </label>
              <br>
              <input type="text" class="form-control" id="CourseID" maxlength="7" name="CourseID" placeholder="Course ID" required>
              <span class="invalid-feedback d-block"><?php echo $courseID_err;?></span>
            </div>
            <div class="">
              <label for="CourseName" class="form-label">Course Name</label>
              <br>
              <input type="text" class="form-control" id="CourseName" maxlength="68" name="CourseName" placeholder="Course Name" required>
              <span class="invalid-feedback d-block"><?php echo $courseName_err;?></span>
            </div>
            <div class="">
              <label for="Credits" class="form-label" step=0.1>Credits</label>
              <br>
              <input type="number" class="form-control" min="0" max="99.9" step="0.1" id="Credits"  name="Credits" placeholder="0-99.9 " required>
              <span class="invalid-feedback d-block"><?php echo $credits_err;?></span>
            </div>
            <div class="">
              <label for="Term" class="form-label">Term</label>
              <br>
              <input name="Term" class="form-control" type="number" min="1" max="127" step="1" placeholder="  (Integer) 1- 127">
              <span class="invalid-feedback d-block"><?php echo $term_err;?></span>
            </div>
            <br>
            <div class="">
              <label for="TotalHours" class="form-label">Total Hours</label>
              <br>
              <input type="number" class="form-control" id="TotalHours" name="TotalHours" step="1" min="1" max="99" placeholder="  (Integer) 0-99">
              <span class="invalid-feedback d-block"> <?php echo $totalHours_err;  ?>  </span>
                    
            </div>
            <div class="">
              <label for="ClassroomType" class="form-label">Classroom Type</label>
              <br>
              <input type="text" class="form-control" id="ClassroomType" name="ClassroomType" placeholder="NULL - varchar(0)" disabled>   
            </div>
            <div class="">
              <label for="Tution" class="form-label" >Tution</label>
              <br>
              <input type="number" class="form-control" id="Tution" name="Tuition" min="0" required step=0.0001 placeholder="Positive Number only" required>
              <span class="invalid-feedback d-block"><?php echo $tuition_err;?></span>
            </div>
            <div class="">
              <label for="description" class="form-label">Description</label>
              <br>
              <textarea class="form-control" rows="5" cols="35" maxlength="150" id="description" name="Description" placeholder="   Max 150 words.."></textarea>
              <span class="invalid-feedback d-block"><?php echo $descripion_err;?></span>
            </div>
            <div class="">
                    <button type="submit" class="btn btn-primary" value="Submit"> Submit </button>
                    <button type="reset" class="btn btn-primary">Reset&nbsp; </button>
                    <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
            </div>
          </form>
        </div>
    </div>
</section>
<?php
   include('templates/footer.html')
?>





