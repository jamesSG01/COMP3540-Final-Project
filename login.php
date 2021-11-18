<?php 
    session_start();
    $username_err = $password_err ="";
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        require_once("config.php");
        $username = trim($_POST['user_name']);
        $password = trim($_POST['user_password']);
        
        $sql = "select * from users where username = '".$username."'";
        $rs = mysqli_query($link,$sql);
        $numRows = mysqli_num_rows($rs);
        
        if($numRows  == 1){
            $row = mysqli_fetch_assoc($rs);
            if(password_verify($password,$row['password'])){
                echo "Password verified";
                header('location: index.php');
                //set session.
                $_SESSION['user'] = $username;
            }
            else{
                $password_err = "Wrong Password";
            }
        }
        else{
            $username_err= "No User found";
        }
    }
?>
<?php 
  $title = "Login";
    include_once('templates/header.html');
?> 
<section class="create bg-primary">
    <div class="wrapper fadeInDown">
        <div id="createform_content">
        <form class="signup-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2>
                Login  
            </h2>
            <p>Please fill in this form to sign in your account!</p>
            <hr>
            <br>
             <div class="form-group">                
                <input type="text" class="form-control" name="user_name" placeholder="Username" size="250" required="required">
                <span class="invalid-feedback d-block"><?php echo $username_err;?></span>
            </div>
            <br>
            <div class="form-group">                
                <input type="password" class="form-control" name="user_password" placeholder="Password" size="250" required="required">
                <span class="invalid-feedback d-block"><?php echo $password_err;?></span>
            </div>
            <br>
            <div class="form-group">
                <label class='checkbox-inline'>
                    <input type="checkbox" name="checkbox_rmb" value="remember-me">
                    Remember me
                </label>
            </div>
            <br>
            <button class="btn btn-primary" type="submit"> Sign in </button>
            <a href="signup.php"><div>Sign Up</div></a> 
        </form>
        <div class="hint-text">Didn't have an account? <a href="signup.php">Sign up</a></div>
    </div>
</div>
</section>
<?php 
    include_once('templates/footer.html');
?>
