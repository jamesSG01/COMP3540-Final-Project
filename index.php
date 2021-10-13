<?php 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> James Nguyen | Assignment 2 </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
  <style type="text/css">
  		body {
  			background-color: #070a0c;
  		}
  		.main {
  			margin-top: 50px;
  			text-align: center;
  		}
  		.wrapper {
  			display: inline-block;
  			width: 70%;
  		}
  		footer, footer a{
  			color: whitesmoke;
  		}
  		header {
  			background-color:#162029;
  			z-index: 100;
  		}
  		
  		.main td, .main tr {background-color:#0e1720; color: #87959f; border-color: #2a333c; border-width: 2px;}
  		.main thead, .main th {background-color: #1a2242; color: #5954d8;}
  </style>
</head>
<body>
	<header >
		<?php 
			include('templates/header.php');
		?>
	</header>
	<section class="main">
		<div class="wrapper">
        <div class="container-fluid">
			<div class="row">
				<div class="col dropdown">
				  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
				    Search by
				  </button>
				  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
				    <li><a class="dropdown-item" href="#">ALL</a></li>
				    <li><a class="dropdown-item" href="#">CourseID</a></li>
				    <li><a class="dropdown-item" href="#">Course Name</a></li>
				    <li><a class="dropdown-item" href="#">Credits</a></li>
				    <li><a class="dropdown-item" href="#">Total Hours</a></li>
				    <li><a class="dropdown-item" href="#">Classroom Type</a></li>
				    <li><a class="dropdown-item" href="#">Term</a></li>
				    <li><a class="dropdown-item" href="#">Tuition</a></li>
				    <li><a class="dropdown-item" href="#">Description</a></li>
				  </ul>
				</div>
                <div class="col-8">
            		<div class="d-flex form-inputs"> <input class="form-control" type="text" placeholder="Search in field"> <i class="bx bx-search"></i> </div>
            		<button value="submit"> Search </button>
        		</div>
                <a href="create.php" class="col btn btn-primary" style="max-width: 120px;">+New Course</a>
            </div>
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

    <footer>	
    	<?php
    		include('templates/footer.php')
    	?>
    </footer>
</body>
</html>