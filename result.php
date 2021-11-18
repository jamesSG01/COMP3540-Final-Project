
<?php 
    session_start();
    $title = 'Search Result';
	include('templates/header.html');
    
    //check session
    if (!isset($_SESSION['user'])){
        header("location: noacess.php");
    }
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
                    if (isset($_POST['searchterm']) && ($_POST['searchterm'] != null) ){
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
                           $sql = "SELECT * FROM hospitals WHERE 
                           (HospitalID LIKE '%$searchterm%' 
                           OR HospitalName LIKE '%$searchterm%' 
                           OR Address LIKE '%$searchterm%' 
                           OR City LIKE '%$searchterm%' 
                           OR PostalCode LIKE '%$searchterm%' 
                           OR Country LIKE '%$searchterm' 
                           OR Email LIKE '%$searchterm%')AND DELETED=0";
                        else 
                            $sql = "SELECT * FROM hospitals WHERE $searchfield LIKE '%$searchterm%' AND deleted=0";                    
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                echo '<table class="table table-bordered table-striped">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>HospitalID</th>";
                                            echo "<th>HospitalName</th>";
                                            echo "<th>Address</th>";
                                            echo "<th>City</th>";
                                            echo "<th>PostalCode</th>";
                                            echo "<th>Country</th>";
                                            echo "<th>Email</th>";
                                            echo "<th>Actions</th>";
                                        echo "</tr>";
                                    echo "</thead>";

                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                            echo "<td>" . $row['HospitalID'] . "</td>";
                                            echo "<td>" . $row['HospitalName'] . "</td>";
                                            echo "<td>" . $row['Address'] . "</td>";
                                            echo "<td>" . $row['City'] . "</td>";
                                            echo "<td>" . $row['PostalCode'] . "</td>";	
                                            echo "<td>" . $row['Country'] . "</td>";	
                                            echo "<td>" . $row['Email'] . "</td>";	
                                            echo "<td>";
                                                //echo $row['CourseID'];
                                                echo '<a href="read.php?id='.$row['HospitalID'].'" class="mr-3" title="View Record" data-toggle="tooltip"> <span class="fa fa-eye"></span></a> <br>';
                                                echo '<a href="update.php?id='.$row['HospitalID'].'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a><br>';
                                                echo '<a href="delete.php?id='.$row['HospitalID'].'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
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
                    } else{
                        header('location: error.php');
                    }
                ?>
            </div>
        </div>        
</section>

    
<?php
	include('templates/footer.html')
?>
