<?php
include 'inc/functions.inc.php';
include 'inc/database.inc.php';

if (isset($_GET['id']) && isset($_GET['col'])) {
 $id = $_GET['id'];
 $col = $_GET['col'];
}

$pets = new DatabaseClass($hostname, $dbname, $username, $password);
$pets->connectDatabase();
$col_val = array($col => $id);
$mess = $pets->deleteFromTable("cats", $col_val);
if ($mess["error"] == "") {
  header('location:list_cats.php');
  exit;
}
else
  echo $mess["error"];
?>

