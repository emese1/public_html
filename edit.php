<?php
$pagetitle = "Edit cats";
include 'inc/header.inc.php';
include 'inc/nav_menu.inc.php';
include 'inc/functions.inc.php';
include 'inc/database.inc.php';

$pets = new DatabaseClass($hostname, $dbname, $username, $password);
$pets->connectDatabase();

$id = 0;
$breed = $name = "";
$where_clause = array(); 
if ( isset($_GET['id']) ) {
 $id = $_GET['id'];
 $where_clause['cats_id'] = $id;
 $result = $pets->selectTable("cats",$where_clause);
 if (!empty($result)) {
  $breed = $result[0]['breed'];
  $name = $result[0]['name'];
 }
}

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
   $where_clause["cats_id"] = $_POST["id"];

   $mess = $pets->updateTable("cats", $value, $where_clause);
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
 <h1>Edit cats</h1>
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
  <!--input type="submit" value="Save"-->
  <div class="form-group text-right">
   <button type="button" class="btn btn-default" onclick="window.location='list_cats.php';"><i class="fa fa-reply"></i> Cancel</button>
   <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
  </div>
  <input type="hidden" name="id" value="<?php echo $id;?>" />
 </form>
</div>

<?php
include 'inc/footer.inc.php';
?>
