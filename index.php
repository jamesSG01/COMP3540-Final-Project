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
	<header style="width:100%; position:sticky; top:0;">
		<?php 
			include('templates/header.php');
		?>
	</header>
	<section class="main" style="margin:20px">
		<div class="dropdown">
		  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		    Dropdown button
		  </button>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		    <a class="dropdown-item" href="#">Action</a>
		    <a class="dropdown-item" href="#">Another action</a>
		    <a class="dropdown-item" href="#">Something else here</a>
		  </div>
		</div>
	</section>

    <footer style="position:absolute; bottom: 0;">	
    	<?php
    		include('templates/footer.php')
    	?>
    </footer>
</body>
</html>