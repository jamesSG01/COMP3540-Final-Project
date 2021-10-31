
<?php 
    $title = 'Query Result';
	include('templates/header.html');
?>
<section class="main">
    <div>
        <h1> Search Results </h1>
    </div>
    <div>
        <a href="index.php" class="btn btn-primary"> Search Again </a> 
        <a class="btn btn-primary" href="create.php" >Create New Record</a> 
    </div>
	<div class="wrapper">
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
                            echo "<img src='img/waalaa.jpg'></img>";
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
                                            echo '<a href="#" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a> <br>';
                                            echo '<a href="#" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a><br>';
                                            echo '<a href="#" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";	
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<iframe src="https://giphy.com/embed/pMztjzgwKXglMMtsHs" width="480" height="480" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p></p>';
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
</section>

    
<?php
	include('templates/footer.html')
?>
