<?php
function test_data($data) {
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
}

//it is not used
function createHeader($columns) {
 $header = "<table><tr>";

 for ($i=0; $i<count($columns); $i++) {
  $header .= "<td>$columns[$i]</td>\n"; 
 }
 $header .= "</tr>";
 echo $header;
}

//it is not used
function createRaw($record) {
 $columns = array_keys($record);
 $raw = "<tr>";
 for ($i=0; $i<count($columns); $i++) {
  if ($i == 0) {
   $id = $record["$columns[$i]"];
   $col_name = $columns[$i];
  }
  $raw .= "<td>" . $record[$columns[$i]] . "</td>\n";    
 }
 $raw .= "<td><a href=\"../delete_cats.php?id=$id&col=$col_name\" onClick=\"return confirm('Are you absolutely sure you want to delete?')\">x</a></td>\n";
 $raw .= "</tr>\n";
 echo $raw; 
}
?>
