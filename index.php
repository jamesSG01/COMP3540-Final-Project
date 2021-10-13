<?php 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 5 Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-dark">
    <section class="container-fluid" style="position: absolute; top: 15vh;">
    	<section class="row  justify-content-center">
    		<div class="col-12 col-sm-6 bg-white text-black">
	    		<h3> LOGIN TO YOUR ACCOUNT </h3>
	      		<form>
				  	<div class="form-group">
					    <label for="user_id">User ID</label>
					    <input type="text" class="form-control" id="user_id" aria-describedby="userIDHelp" placeholder="Enter your ID">
				  	</div>
				  	<div class="form-group">
					    <label for="exampleInputPassword1">Password</label>
					    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
				  	</div>
				  	<div class="form-group form-check">
					    <input type="checkbox" class="form-check-input" id="exampleCheck1">
					    <label class="form-check-label" for="exampleCheck1">Check me out</label>
				  	</div>
				  	<button type="submit" class="btn btn-primary">Submit</button>
				</form>
    		</div>
    	</section>
    </section>
</body>
