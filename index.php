<?php 
  $title = "Homepage";
	include_once('templates/header.html');
?>

<section class="wrapper" id="search_wrapper">
  <!-- The search form -->
  <h1> Available Courses Details </h1>
  <form class="container" action="result.php" method="POST">
    <!-- Dropdown -->
    <div class=" d-flex justify-content-center">
        <div id="input_container">
          <select class="btn-primary" name="searchfield" id="dropdown">
            <option value="*" selected>ALL</option>
            <option value="courseID">CourseID</option>
            <option value="courseName">Course Name</option>
            <option value="credits">Credits</option>
            <option value="totalHours">Total Hours</option>
            <option value="classroomType">Classroom Type</option>
            <option value="term">Term</option>
            <option value="tuition">Tuition</option>
            <option value="description">Description</option>
          </select>
          
            <input type="search" size="30" maxlength="30" placeholder="Search with keyword" name="searchterm" id="search_input" required>
            <button class="btn btn-primary" value="submit" id="search_btn"><i class="fa fa-search"></i></button>  
          <a class="btn btn-primary" href="create.php" id="add_btn"> <i class="fa fa-plus"></i> </a> 
        </div> 
      </div>
  </form>      
</section>

<section class="main">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM courses";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>COURSE ID</th>";
                                        echo "<th>COURSE NAME</th>";
                                        echo "<th>CREDITS</th>";
                                        echo "<th>TOTAL HOURS</th>";
                                        echo "<th>CLASSROOM TYPE</th>";
                                        echo "<th>TERM</th>";
                                        echo "<th>TUITION</th>";
                                        echo "<th>DESCRIPTION</th>";
                                    echo "</tr>";
                                echo "</thead>";

                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['CourseID'] . "</td>";
                                        echo "<td>" . $row['CourseName'] . "</td>";
                                        echo "<td>" . $row['Credits'] . "</td>";
                                        echo "<td>" . $row['TotalHours'] . "</td>";
                                        echo "<td>" . $row['ClassroomType'] . "</td>";  
                                        echo "<td>" . $row['Term'] . "</td>"; 
                                        echo "<td>" . $row['Tuition'] . "</td>";  
                                        echo "<td>" . $row['Description'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
  </section>
<?php
	include_once('templates/footer.html')
?>