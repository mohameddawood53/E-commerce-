<style>
   .latest-users{
      margin-bottom: 0;
   }
   .latest-users li{
      padding: 2px 0 ;
      overflow: hidden;
   }
   .latest-users .btn-success{
      padding: 3px 8px;
   }
   .latest-users li:nth-child(odd){
      background-color:#EEE;
   }
   .stat{
      border-radius: 10px;
      color:#f4f5f6;
      
   }
   .stat a{
      color:#f4f5f6;
      
   }
   .stat a:hover{
      color:#f4f5f6;
      
   }
   .st-members {

    background-color: #3498db;

}
.st-pending{
   background-color: #c0392b; 
}
.st-items{
   background-color: #d35400; 
}
.st-comments{
   background-color: #8e44ad; 
}
.stat{
    padding: 20px;
    font-size: 15px;
}
.home-stats .stat span{
    display: block;
    font-size: 50px;
    color:#f4f5f6;
}
.latest{
   background-color: #F3F3F3;
   height: 35px;
   width: 200px;
   margin-top: 30px;
   border-radius:15px 50px;
}
.latest-div{
   margin-top: 30px;
   position: absolute;
   left: 812px;
   top: 252px;
   float: right;
}
.panel-body{
      background-color: #FFF;
      border: 1px solid #CCC;
      padding: 10px;
      font-size: 15px;
      margin-top: 10px;
      border-radius:5px;
}
</style>
<?php
   session_start();
   $pageTitle = 'Dashboard';
   if (isset($_SESSION['loggedin']))
   {
   include ('init.php');
   // Start Dashboard Page
   ?>
   <div class="container home-stats text-center">
      <h1>Dashboard</h1>
      <div class="row">
         <div class="col-md-3">
            <div class="stat st-members">Total Members <br><span><a href="members.php"><?php echo countItems("userID","users"); ?></a></span></div>
         </div>
         <div class="col-md-3">
            <div class="stat st-pending">Pending Members<br><span><a href="members.php?do=Manage&page=Pending"><?php $statement = $connection->prepare("SELECT RegStatues FROM users WHERE RegStatues = 0 ");
  $statement->execute();
  $count = $statement->rowCount();
  echo $count; ?></a></span></div>
         </div>
         <div class="col-md-3">
            <div class="stat st-items">Total Items<br><span><?php echo countItems("Name","items") ;?></span></div>
         </div>
         <div class="col-md-3">
            <div class="stat st-comments">Total Comments<br><span> 3500</span></div>
         </div>
      </div>
   </div>
   <div class="container latest">
      <div class="row">
         <div class="col-sm-6">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <i class="fa fa-users"></i> Latest 5 Registered Users 
               </div>
               <div class="panel-body">
                  <?php
                  $thelatest = getLast("*" , "users" ,"userID",5 );
                  echo '<ul class="list-unstyled latest-users">';
                  foreach ($thelatest as $user)
                  {
                  echo '<li>' . $user['Username'] . '<a href="members.php?do=Edit&userid=' . $user['userID'] . '">'.'<span class="btn btn-success pull-right"><i class="fa fa-edit"></i>' . '</a>' . '</span>' . '</li>';
                  }
                  echo '</ul>';
                  ?>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="container latest-div">
      <div class="row">
         <div class="col-sm-6">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <i class="fa fa-tag"></i> Latest Items
                  
               </div>
               <div class="panel-body">
                  
                  <?php
                  $thelatest = getLast("*" , "items" ,"Name",5 );
                  echo '<ul class="list-unstyled latest-users">';
                  foreach ($thelatest as $item)
                  {
                  echo '<li>' . $item['Name'] . '<a href="items.php?do=Edit&itemid=' . $item['Item_Id'] . '">'.'<span class="btn btn-success pull-right"><i class="fa fa-edit"></i>' . '</a>' . '</span>' . '</li>';
                  }
                  echo '</ul>';
                  ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php
   include $temp . 'footer.php';
   }else{
    header('location:index.php');
    exit();
   }
   ?>