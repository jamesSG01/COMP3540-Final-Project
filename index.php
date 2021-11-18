<?php 
  session_start();
  $title = "Homepage";
	include_once('templates/header.html');
?>
    <section class="wrapper" id="search_wrapper" style="min-height: 55vh;">
      <!-- The search form -->
      <h1> Find Hospital </h1>
      <form class="container" action="result.php" method="POST">
        <!-- Dropdown -->
        <div class=" d-flex justify-content-center">
            <div id="input_container">
              <select class="btn-danger" name="searchfield" id="dropdown">
                <option value="*" selected>ALL</option>
                <option value="HospitalID">HospitalID</option>
                <option value="HospitalName">HospitalName</option>
                <option value="Address">Address</option>
                <option value="City">City</option>
                <option value="PostalCode">PostalCode</option>
                <option value="Country">Country</option>
                <option value="Email">Email</option>
              </select>
                <input type="search" size="30" maxlength="30" placeholder="Search with keyword" name="searchterm" id="search_input" required>
                <button class="btn btn-danger" value="submit" id="search_btn"><i class="fa fa-search"></i></button>  
              <a class="btn btn-danger" href="create.php" id="add_btn"> <i class="fa fa-plus"></i> </a> 
            </div> 
          </div>
      </form>      
    </section>
<?php
	include_once('templates/footer.html')
?>