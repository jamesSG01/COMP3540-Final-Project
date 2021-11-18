
<?php
    session_start();
    if (!isset($_SESSION['user'])){
        header("location: noacess.php");
    }
    // Include config file
    require_once "config.php";    
    // Define variables and initialize with empty values
    $HospitalName = $Address = $City = $PostalCode = $Email = $Country = $HospitalID = "";
    $name_err = $address_err = $city_err = $postal_err = $email_err = $country_err = null;

    //Function to auto get generate id.
    function initials($str) {
    $ret = '';
    foreach (explode(' ', $str) as $word)
        $ret .= strtoupper($word[0]);
    return $ret;
    }

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        //GET FORM DATA
        $HospitalName = trim($_POST["name"]);
        $HospitalID =initials($HospitalName);
        $Address = trim($_POST["address"]);
        $Country = trim($_POST["country"]);
        $City = trim($_POST["city"]);
        $PostalCode = strtoupper(trim($_POST["postcode"]));
        $Email = trim($_POST["email"]);

        // PROCEED IF THERE IS NO ERROR
        if(empty($name_err)  && empty($address_err)   && empty($city_err) && empty($postal_err) && empty($email_err) && empty($country_err)){
            //query
            $sql = "INSERT INTO hospitals (`HospitalID`, `HospitalName`, `Address`, `City`, `PostalCode`, `Country`, `Email`) VALUES ('$HospitalID','$HospitalName','$Address','$City','$PostalCode', '$Country','$Email');";
            mysqli_query($link,$sql);
        
            // Close connection
            mysqli_close($link);

            // Records created successfully. Redirect to landing page
            header("location: index.php?success");
        } else {
            //echo "Oops! Something went wrong. Please try again later.";
        }
    }
?>


<?php
    $title = 'Create New Record';
    include_once('templates/header.html');
?>
<section class="create bg-primary">
    <br>
    <div class="signup-form">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h3> New Record </h3>  
        <p> Insert information for new hospital record</p>
        <hr>
        <div class="form-group">                
            <input type="text" class="form-control" name="name" placeholder="HospitalName" required="required">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="address" placeholder="Address" required="required">       
        </div>
         <div class="form-group">
            <input type="text" class="form-control" name="country" placeholder="Country" required="required">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="city" placeholder="City" required="required">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="postcode" placeholder="PostalCode" required="required">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" required="required">
        </div>        
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg">Create</button>
            <button type="reset" class="btn btn-secondary btn-lg"> Reset</button>
        </div>
    </form>
    </div>
</section>
<?php
   include('templates/footer.html')
?>





