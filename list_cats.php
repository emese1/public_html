<?php
$pagetitle = "List cats";
include 'inc/header.inc.php';
include 'inc/nav_menu.inc.php';
include 'inc/functions.inc.php';
include 'inc/database.inc.php';
?>

<div class="container">

<?php
$where_clause = array(); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!$_POST["breed"] == "") {
    $where_clause["breed"] = test_data($_POST["breed"]);
  }

  if (!$_POST["name"] == "") {
    $where_clause["name"] = test_data($_POST["name"]);
  } 
} 

$pets = new DatabaseClass($hostname, $dbname, $username, $password);
$pets->connectDatabase();

$result = $pets->selectTable("cats",$where_clause);
if (!empty($result)) { 
?>
 <div class="row">
  <div class="col-md-2 col-xs-12"> 
   <div class="dropdown">
    <button class="dropdown-toggle" data-toggle="dropdown">
     Filter<span class="caret"></span>
    </button>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="dropdown-menu">
     <div class="form-group">
      <label for="breed">Cat breed:</label>
      <!--input type="text" name="breed" id="breed"-->
      <select name="breed" id="breed">
       <option value="">Select All</option>
       <?php
       $breeds = $pets->selectBreeds();
       foreach($breeds as $breed_record) {
       ?>
       <option value="<?php echo $breed_record['breed'];?>">
        <?php echo $breed_record['breed'];?>
       </option> 
       <?php  
        }
       ?> 
      </select>
     </div>
     <div class="form-group">
      <label for="name">Cat name:</label>
      <input type="text" name="name" id="name">
     </div>
     <input type="submit" value="Search">
    </form>
   </div>  
  </div>

  <div class="col-md-4 col-xs-12">
   <div class="search">
      <span class="fa fa-search"></span>
      <input type ="text" id="search_breed_in_table" onkeyup="searchInTable(this.id,1)" placeholder="Search for breed in the list..">
   </div>      
  </div>
  
  <div class="col-md-4 col-xs-12">
   <div class="search">
      <span class="fa fa-search"></span>
      <input type ="text" id="search_name_in_table" onkeyup="searchInTable(this.id,2)" placeholder="Search for name in the list..">
   </div> 
  </div>

  <div class="col-md-2 col-xs-12"></div>
 </div><!-- End of row --> 


<!--Beginning of the table-->
  <div id="my_table">
   <div id="my_table_head">
    <div class="row">
     <div class="col-md-2 col-xs-2">Id</div>
     <div class="col-md-4 col-xs-4">Breed</div>
     <div class="col-md-4 col-xs-4">Name</div>
     <div class="col-md-2 col-xs-2">
      <a href="../insert_cats.php" class="btn btn-primary" data-toggle="tooltip" title="Insert cats">
       <i class="fa fa-plus"></i>
      </a>
     </div>
    </div>
    </div><!--  end of my_table_head-->
   <div id="cat_list"> 
  <?php
  foreach($result as $nr=>$record) {
   $id = $record["cats_id"];
  ?>
    <div class="row">
     <div class="col-md-2 col-xs-2"><?php echo $record["cats_id"];?></div>
     <div class="col-md-4 col-xs-4"><?php echo $record["breed"]?></div>
     <div class="col-md-4 col-xs-4"><?php echo $record["name"];?></div>
     <div class="col-md-2 col-xs-2">
      <a href="edit.php?id=<?php echo $id;?>" data-toggle="tooltip" data-placement="left" title="Edit" class="btn btn-primary">
       <i class="fa fa-pencil"></i>
      </a>
      <a href="../delete_cats.php?id=<?php echo $id;?>&col=cats_id" onClick="return confirm('Are you sure you want to delete?')" data-toggle="tooltip" data-placement="right" title="Delete" class="btn btn-danger">
       <!--span class="glyphicon glyphicon-remove"></span-->
       <i class="fa fa-trash-o"></i>
      </a>
     </div>
    </div>     
  <?php
  }
  ?>
   </div><!-- end of div id="cat_list" -->  
  </div><!-- end of div id="my_table" -->  
<!--End of table-->

 <?php 
 }//end of "if (!empty($result))"
 else {
 ?>
  <div class="row">
   <div class="col-md-12 col-sm-12">No selection for cats</div>
  </div>
 <?php 
 }
 ?>
</div>

<?php
include 'inc/footer.inc.php';
?>
