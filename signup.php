<?php
    $username_err = $first_err = $last_err = $email_err = $password_err = null;
    $username = $firstname = $lastname = $email = $password = $confirm ="";
    if($_SERVER["REQUEST_METHOD"] == "POST"){ 

    // Include config file
    require_once "config.php";    

    // Define variables and initialize with empty values

    $username = trim($_POST['user_name']);
    $firstname = trim($_POST['first_name']);
    $lastname = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    //Validation
    if ($password != $confirm ){
        $password_err = 'Confirm Password Not Matched';  
    } else {
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    }
    
    $search_user = "SELECT * FROM users WHERE username = '$username'";
    $res = mysqli_query($link,$search_user);
    if (mysqli_num_rows($res)>0){
        $username_err = 'Username is already taken';
    }

    // PROCEED IF THERE IS NO ERROR
        if(empty($username_err) && empty($first_err)  && empty($last_err) && empty($email_err) && empty($password_err)){
            //query
            $sql = "INSERT INTO users (`username`, `password`, `firstname`, `lastname`, `email`) VALUES ('$username','$password','$firstname','$lastname','$email');";
            mysqli_query($link,$sql);
        
            // Close connection
            mysqli_close($link);
            
            // Records created successfully. Redirect to landing page
            header("location: index.php?success");
        } //else {
            //echo "Oops! Something went wrong. Please try again later.";
        //}
    }
?>

<?php
    $title = "Sign Up";
    include_once('templates/header.html');
?> 
<section class="create bg-primary">
    <br>
    <div class="signup-form fadeInDown">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Sign Up</h2>
        <p>Please fill in this form to create an account!</p>
        <hr>
        <div class="form-group">                
            <div class="col-xs-6"><input type="text" class="form-control" name="user_name" placeholder="Username" required="required"></div>
            <span class="invalid-feedback d-block"><?php echo $username_err;?></span>
        </div>
        <div class="form-group">                
            <div class="col-xs-6"><input type="text" class="form-control" name="last_name" placeholder="Last Name" required="required"></div>
            <span class="invalid-feedback d-block"><?php echo $last_err;?></span>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="first_name" placeholder="First Name" required="required">       
            <span class="invalid-feedback d-block"><?php echo $first_err;?></span>
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" required="required">
            <span class="invalid-feedback d-block"><?php echo $email_err;?></span>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            <span class="invalid-feedback d-block"><?php echo $password_err;?></span>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required="required">
            <span class="invalid-feedback d-block"><?php echo $password_err;?></span>
        </div>        
        <div class="form-group">
            <label class="checkbox-inline"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg">Sign Up</button>
        </div>
    </form>
    <div class="hint-text">Already have an account? <a href="login.php">Login here</a></div>
    </div>
</section>

<?php 
    include_once('templates/footer.html');
?>
