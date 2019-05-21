<?php
// Function To echo the title of the pages
 function getTitle (){
    global $pageTitle ;
    if (isset($pageTitle))
    {
        echo $pageTitle;
    }else{
        echo "E-commerce";
    }
 }
 // Redirect Function
 function redirectHome($themsg ,$url = null, $seconds=3)
 {
  if ($url === null)
  {
   $url = 'index.php';
  }else{
   if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '')
   {
    $url = $_SERVER['HTTP_REFERER'];
   }else {
    $url = 'index.php';
   }
   
  }
  echo $themsg;
  echo '<div class="alert alert-info">You Will Be Redirected To The Previouse Page After ' . $seconds . ' Seconds' . '</div>';
  header("Refresh: $seconds; url=$url");
  exit();
 }
 // To Check Items In DataBase
 function checkItem($select,$from,$value)
 {
  global $connection ;
  $statement = $connection->prepare("SELECT $select FROM $from WHERE $select = ? ");
  $statement->execute(array($value));
  $count = $statement->rowCount();
  return $count;
 }
 // count function
 function countItems($item,$table)
 {
  global $connection ;
   $stmt1 = $connection->prepare("SELECT COUNT($item) FROM $table");
   $stmt1->execute();
   return $stmt1->fetchColumn();
 }
 // getlatest function
 function getLast($select , $from ,$order,$limit=5 )
 {
  global $connection;
  $getStmt = $connection->prepare("SELECT $select FROM $from ORDER BY $order DESC LIMIT $limit ");
  $getStmt->execute();
  $rows = $getStmt->fetchAll();
  return $rows;
 }
 
?>