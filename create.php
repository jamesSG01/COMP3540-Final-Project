
<?php
    // Include config file
    require_once "config.php";

    

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        // Define variables and initialize with empty values
        $CourseName = $CourseID = $Credits = $ClassroomType = $TotalHours = $Term = $Tuition = $Descripion="";
        $courseName_err = $courseID_err = $credits_err = $totalHours_err = $term_err = $tuition_err = null;

        //GET FORM DATA
        $input_courseID = trim($_POST["CourseID"]);
        $input_courseName = trim($_POST["CourseName"]);
        $input_credits = trim($_POST["Credits"]);
        $input_totalHours = trim($_POST["TotalHours"]);
        $input_term = trim($_POST["Term"]);
        $input_tuition = trim($_POST["Tuition"]);
        $input_description = trim($_POST["Description"]);

        //echo $CourseID;
        //===============================
        //         VALIDATION 
        //===============================
             // Validate courseID (NOT EMPTY)
            $input_courseID = trim($_POST["CourseID"]);
            
            $CourseID = $input_courseID; 
            

            // Validate name 
            $input_courseName = trim($_POST["CourseName"]);
        
            $CourseName = $input_courseName; 
            

            // Validate Credits (NOT EMPTY)
            $input_credits = trim($_POST["Credits"]);
           
            $Credits = $input_credits;
            

            // Validate Total Hours
            $input_totalHours = trim($_POST["TotalHours"]);
       
            // Validate Term
            $input_term = trim($_POST["Term"]);
         
            $Term = $input_term;
            

            // Validate Tuition
            $input_tuition = trim($_POST["Tuition"]);
      
            // Pass value to $Description
            $Descripion = $input_description;

        /*//DEBUG 
        if (empty($courseName_err)) {
            echo 'true';
        }
        if (empty($courseID_err)) {
            echo 'true';
        }
        if (empty($term_err)) {
            echo 'true';
        }
        if (empty($totalHours_err)) {
            echo 'true';
        }
        if (empty($tuition_err)) {
            echo 'true';
        }
        if (empty($credits_err)) {
            echo 'true';
        }*/

        // PROCEED IF THERE IS NO ERROR
        if(empty($courseName_err)  && empty($courseID_err)   && empty($term_err) && empty($tuition_err) && empty($credits_err) && empty($totalHours_err)){
            //query
            $sql = "INSERT INTO courses (`CourseID`, `CourseName`, `Credits`, `TotalHours`, `Term`, `Tuition`, `Description`) VALUES ('$CourseID','$CourseName','$Credits','$TotalHours','$Term','$Tuition','Description');";
            mysqli_query($link,$sql);
        
            // Close connection
            mysqli_close($link);
            
            // Records created successfully. Redirect to landing page
            header("location: index.php");
        }else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    //
?>


<?php 
    $title = 'Create New Record';
	include_once('templates/header.html');
?>
<section class="create">

    <div class="wrapper fadeInDown">
        <a href="index.php" class="btn btn-primary" id="goback_btn"> Send Me Back </a>
        <div id="createform_content">
        <h3> CREATE NEW COURSE </h3>  
   
          <form class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="">
              <label for="CourseID" class="form-label">CourseID </label>
              <br>
              <input type="text" class="form-control" id="CourseID" maxlength="7" name="CourseID" placeholder="Course ID" required>
              <span class="invalid-feedback"><?php echo $courseID_err;?></span>
            </div>
            <div class="">
              <label for="CourseName" class="form-label">Course Name</label>
              <br>
              <input type="text" class="form-control" id="CourseName" maxlength="68" name="CourseName" placeholder="Course Name" required>
              <span class="invalid-feedback"><?php echo $courseName_err;?></span>
            </div>
            <div class="">
              <label for="Credits" class="form-label" step=0.1>Credits</label>
              <br>
              <input type="number" class="form-control" min="0" max="99.9" step="0.1" id="Credits"  name="Credits" placeholder="0-99.9 " required>
              <span class="invalid-feedback"><?php echo $credits_err;?></span>
            </div>
            <div class="">
              <label for="Term" class="form-label">Term</label>
              <br>
              <input name="Term" type="number" min="1" max="127" step="1" placeholder="  (Integer) 1- 127">
              <span class="invalid-feedback"><?php echo $credits_err;?></span>
            </div>
            <br>
            <div class="">
              <label for="TotalHours" class="form-label">Total Hours</label>
              <br>
              <input type="number" class="form-control" id="TotalHours" name="TotalHours" step="1" min="1" max="99" placeholder="  (Integer) 0-99">
              <span class="invalid-feedback"><?php echo $totalHours_err;?></span>
            </div>
            <div class="">
              <label for="ClassroomType" class="form-label">Classroom Type</label>
              <br>
              <input type="text" class="form-control" id="ClassroomType" name="ClassroomType" placeholder="NULL - varchar(0)" disabled>   
            </div>
            <div class="">
              <label for="Tution" class="form-label" >Tution</label>
              <br>
              <input type="number" class="form-control" id="Tution" name="Tuition" required step=0.0001 placeholder="Positive Number only" required>
              <span class="invalid-feedback"><?php echo $tuition_err;?></span>
            </div>
            <div class="">
              <label for="description" class="form-label">Description</label>
              <br>
              <textarea rows="5" cols="35" maxlength="150" id="description" name="Description" placeholder="   Max 150 words.."></textarea>
            </div>
            <div class="">
                    <input type="submit" class="btn btn-primary" value="Submit">
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



