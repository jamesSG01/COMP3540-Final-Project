<?php
    // Include config file
    require_once "config.php";    
    // Define variables and initialize with empty values
    $CourseName = $CourseID = $Credits = $TotalHours = $Term = $Tuition = $Descripion ="";
    $courseName_err = $courseID_err = $credits_err = $totalHours_err = $descripion_err = $term_err = $tuition_err = null;
    $args = null;

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        //GET FORM DATA
        $CourseID = trim($_POST["CourseID"]);
        
        $CourseName = trim($_POST["CourseName"]);
        $Credits = trim($_POST["Credits"]);
        $TotalHours = trim($_POST["TotalHours"]);
        $Term = trim($_POST["Term"]);
        $Tuition = trim($_POST["Tuition"]);
        $Descripion = trim($_POST["Description"]);

        
        
        // PROCEED IF THERE IS NO ERROR
        if(empty($courseName_err)  && empty($courseID_err)   && empty($term_err) && empty($tuition_err) && empty($credits_err) && empty($totalHours_err)){
            //query
            $sql = "UPDATE courses SET CourseName='$CourseName', Credits='$Credits', TotalHours='$TotalHours', Term='$Term', Tuition='$Tuition', Description='$Descripion' WHERE CourseID='$CourseID'";

            echo "sql";
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
        <?php echo '<h3>  UPDATE INFO OF COURSE '. $_GET['id'].'</h3>' ?> 
          <form class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" class="form-control" name="CourseID" value=<?php echo $_GET["id"];?> hidden >
            <div class="">
              <label for="CourseName" class="form-label">Course Name</label>
              <br>
              <input type="text" class="form-control" id="CourseName" maxlength="68" name="CourseName" placeholder="Course Name" >
              <span class="invalid-feedback d-block"><?php echo $courseName_err;?></span>
            </div>
            <div class="">
              <label for="Credits" class="form-label" step=0.1>Credits</label>
              <br>
              <input type="number" class="form-control" min="0" max="99.9" step="0.1" id="Credits"  name="Credits" placeholder="0-99.9 " >
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
              <label for="Tution" class="form-label" >Tution</label>
              <br>
              <input type="number" class="form-control" id="Tution" name="Tuition" min="0"  step=0.0001 placeholder="Positive Number only" >
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





