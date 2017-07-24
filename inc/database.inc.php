<?php
include 'conf.inc.php';

class DatabaseClass {
   private $hostname;
   private $dbname;
   private $username;
   private $password;
   private $conn;

   public function __construct($hostname, $dbname, $username, $password) {
    $this->hostname = $hostname;  
    $this->dbname = $dbname;
    $this->username = $username;
    $this->password = $password; 
   }
 
   public function connectDatabase() {
    try {
        $this->conn = new PDO("mysql:host=$this->hostname;dbname=$this->dbname", $this->username, $this->password);
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
    }
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
   }
   
   /*$col_values=array("col1" => "val1", "col2" => "val2",...);      
   */
   public function insertIntoTable($table, $col_values) {

    $columnStr = $valueStr = $messStr = "";
    $task = array(); 

    foreach ($col_values as $col => $value) {
     if ($columnStr == "") 
      $columnStr .= "(" . $col;
     else 
      $columnStr .= "," . $col;
     
     if ($valueStr == "") 
      $valueStr .= "(:" . $col;
     else 
      $valueStr .= ",:" . $col;   
 
     $task[":" . $col] = $value;

     if ($messStr  == "")
      $messStr .= $col . " = " . $value;
     else
      $messStr .= ", " . $col . " = " . $value;
    }

    $columnStr .= ")";    
    $valueStr .= ")";
    $sql = "INSERT INTO " . $table . $columnStr . " VALUES " . $valueStr . ";"; 

    try {
        $query = $this->conn->prepare($sql);
        $query->execute($task);
    }
    catch(PDOException $e) {
        $mess["error"] = "Error: " . $e->getMessage();
        $mess["ok"] = "";          
    }     

    $mess["ok"] = "Values : " . $messStr . " inserted into table " . $table;
    return $mess;
   }

   public function selectTable($table, $where_clause) {
    $where = "";
    $task = array();
    if (!empty($where_clause)) {
     $columns = array_keys($where_clause);
     for ($i=0; $i<count($columns); $i++){
      $where .= "`$columns[$i]`=:$columns[$i]";
      if ($i < count($columns) - 1)
        $where = $where . " AND "; 
      $task[":$columns[$i]"] = $where_clause[$columns[$i]]; 
     }
    }
    
    $sql = "SELECT * FROM $table"; 
    if ($where != "")
     $sql .= " WHERE" . $where; 

    try {
        $query = $this->conn->prepare($sql);
        $query->execute($task);
        // set the resulting array to associative
        $res = $query->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $query->fetchAll();
        return $result;        
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }         
   }

   public function selectBreeds() {
    $sql = "SELECT DISTINCT breed FROM cats"; 

    try {
        $query = $this->conn->prepare($sql);
        $query->execute();
        // set the resulting array to associative
        $res = $query->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $query->fetchAll();
        return $result;        
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }         
   }
   

   public function updateTable($table, $col_values, $where_clause) {
    $mess["error"] = "";
    if (empty($where_clause)) {
     $mess["error"] = "The where clause is missing from the sql update<br>";
     return $mess;
    }

    $col_valueStr = $where = "";
    $task = array(); 

    foreach ($col_values as $col => $value) {
     if ($col_valueStr == "") 
      $col_valueStr = "$col = :$col";
     else
      $col_valueStr .= " ,$col = :$col"; 
     
     $task[":" . $col] = $value;
    }

    list($col_name, $val) = each($where_clause);
    $task[":" . $col_name] = $val;
    $where = "$col_name = :$col_name"; 
    $sql = "UPDATE $table SET $col_valueStr WHERE $where;";
    
    try {
        $query = $this->conn->prepare($sql);
        $query->execute($task);
    }
    catch(PDOException $e) {
        $mess["error"] = "Error: " . $e->getMessage();
    } 
    return $mess; 
   }

   public function deleteFromTable($table, $col_val) {
    $mess["error"] = "";
    list($col_name, $val) = each($col_val);
    $sql = "DELETE FROM $table WHERE $col_name = :$col_name;";
    $task = array(":$col_name" => "$val");
    try {
        $query = $this->conn->prepare($sql);
        $query->execute($task);
    }
    catch(PDOException $e) {
        $mess["error"] = "Error: " . $e->getMessage();
    } 
    return $mess; 
    
   }

   public function __destruct() {
    $this->conn = null;
   }
}
?>
