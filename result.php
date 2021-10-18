<?php 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> James Nguyen | Assignment 2 </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<header >
		<?php 
			include('templates/header.html');
		?>
	</header>
	<section class="main">
		<div class="wrapper">
        <?php 
            include('templates/search_bar.html')
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Create variables 
                    $searchterm = $_POST['searchterm'];
                    $searchfield = $_POST['searchfield'];

                    //Check variables 
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    if ($searchterm =='') 
                        $sql = "SELECT * FROM courses";
                    else if ($searchfield == '*')
                       $sql = "SELECT * FROM courses WHERE 
                   (CourseID LIKE '%$searchterm%' 
                   OR CourseName LIKE '%$searchterm%' 
                   OR Credits LIKE '%$searchterm%' 
                   OR TotalHours LIKE '%$searchterm%' 
                   OR ClassroomType LIKE '%$searchterm%' 
                   OR Term LIKE '%$searchterm' 
                   OR Tuition LIKE '%$searchterm%'
                   OR Description LIKE '%$searchterm')";
                    else 
                        $sql = "SELECT * FROM courses WHERE $searchfield LIKE '%$searchterm%'";                    
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
                                        echo "<th>ACTION</th>";
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
                                        echo "<td>";
                                            echo '<a href="#" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="#" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="#" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";	
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
    		include('templates/footer.html')
    	?>
    </footer>
</body>
</html>