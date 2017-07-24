<?php
 $pagetitle = "Insert cats";
 include 'inc/header.inc.php';
 include 'inc/nav_menu.inc.php';
 include 'inc/functions.inc.php';
 include 'inc/database.inc.php';
 


 $breed = $name = "";
 $breedErr = $nameErr = "";

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //Data Validation
  if ($_POST["breed"] == "") {
    $breedErr = "Please add breed!";
  }
  else {
    $breed = test_data($_POST["breed"]);
  }

  if ($_POST["name"] == "") {
    $nameErr = "Please add a name!";
  }
  else {
    $name = test_data($_POST["name"]);
  } 

  if ($breedErr == "" && $nameErr == "") { 
   
   $value = array("breed" => $breed,
                  "name"  => $name);
   $pets = new DatabaseClass($hostname, $dbname, $username, $password);
   $pets->connectDatabase();
   $mess = $pets->insertIntoTable("cats", $value);
   $breed = $name = "";
   if ($mess["error"] == "") {
    header('location:list_cats.php');
   }   
   else
     echo $mess["error"];
   exit;
  }
 }
 
?>

<div class="container">
 <h1>Insert cats</h1>
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="form-group">
   <label for="breed">Cat breed:</label>
   <input type="text" class="form-control" name="breed" id="breed" value="<?php echo $breed?>">
   <span class="text-danger"> <?php echo $breedErr;?></span><br>
  </div>
  <div class="form-group">
   <label for="name">Cat name:</label>
   <input type="text" class="form-control" name="name" id="name" value="<?php echo $name?>">
   <span class="text-danger"> <?php echo $nameErr;?></span><br>
  </div>
  <input type="submit" value="Insert" class="btn btn-primary">
 </form>
</div>

<?php


include 'inc/footer.inc.php';
?>

