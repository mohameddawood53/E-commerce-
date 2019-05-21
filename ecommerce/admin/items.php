<style>
 .ordering{
  position: absolute;
  padding: 0;
  top: 3px;
  right: 2px;
 }
 .ordering a{
  color: #888;
  text-decoration : none;
 }
 .ordering .active{
  color: #e74c3c;
 }
   .categories .cat h4{
    margin: 0 0 10px;
   }
   .categories .cat:last-of-type ~ hr{
    display: none;
   }
   .categories .cat .visiblity{
    background-color:#c0392b;
    color: #FFF;
    padding: 5px 10px;
    margin-right : 10px;
    border-radius : 6px;
   }
   .categories .cat .visiblity:hover{
    text-decoration : none;
   }
   .categories .cat .comment{
    background-color:#2c3e50;
    color: #FFF;
    padding: 5px 10px;
    margin-right : 10px;
    border-radius : 6px;
   }
   .categories .cat .comment:hover{
    text-decoration:none;
   }
   .categories .cat .ads{
    background-color:#f39c12;
    color: #FFF;
    padding: 5px 10px;
    margin-right : 10px;
    border-radius : 6px;
   }
   .categories .cat .ads:hover{
    text-decoration:none;
   }
   .form-group{
      width: 560px;
      margin-left: 20px;
   }
   #btn{
      margin-left: 20px; 
   }
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
   width: 90px;
   margin-top: 30px;
   border-radius:15px 50px;
}
.latest-div{
   margin-top: 30px;
   position: absolute;
   left: 750px;
   top: 252px;
   float: right;
}
.panel-body{
      background-color: #FFF;
      border: 1px solid #CCC;
      width: 1110px;
      padding: 0px;
      font-size: 15px;
      margin-top: 10px;
      border-radius:5px;
}
.categories hr{
 margin-top:2px;
 margin-bottom: 5px;
}
.categories .cat{
 padding: 10px;
 position: relative;
 overflow: hidden;
}
.categories .cat:hover .hidden-buttons{
 right: 10px;
}
.categories .cat:hover {
 background-color:#EEE;
}
.categories .cat .hidden-buttons a{
 padding: 3px 5px;
}
.categories .cat .hidden-buttons{
 position: absolute;
 top: 15px;
 right: -120px;
}
.checked {
    color: orange;
}
</style>
<?php
ob_start();
session_start();
   $pageTitle = 'Items';
   if (isset($_SESSION['loggedin']))
   {
   include ('init.php');
   $do = isset($_GET['do'])?$_GET['do'] : 'Manage';
   if ($do == 'Manage')
   {
      $stmt = $connection->prepare("SELECT items.*,categories.Name as Category_name,users.Username as item_user from items INNER join categories on categories.ID = items.Cat_Id INNER join users on users.userID = items.Member_Id ");
      $stmt->execute();
      // assign to varibles
      $rows = $stmt->fetchAll();
       // start Manage Page
       ?>
       <h1 class="text-center">Manage Items</h1>
       <div class="container">
         <div class="table-responsive">
            <table class="table">
               <tr>
                  <td>#ID</td>
                  <td>Item Name</td>
                  <td>Description</td>
                  <td>Price</td>
                  <td>Country Made</td>
                  <td>Statues</td>
                  <td>Member</td>
                  <td>The Category</td>
                  <td>The Adding Date</td>
                  <td>Control</td>
               </tr>
               <?php
               foreach($rows as $row)
               {
                  echo "<tr>";
                  echo "<td>" . $row['Item_Id'] . "</td>";
                  echo "<td>" . $row['Name'] . "</td>";
                  echo "<td>" . $row['Description'] . "</td>";
                  echo "<td>" . $row['Price'] . "</td>";
                  echo "<td>" . $row['Country_Made'] . "</td>";
                  echo "<td>" . $row['Statues'] . "</td>";
                  echo "<td>" . $row['item_user'] . "</td>";
                  echo "<td>" . $row['Category_name'] . "</td>";
                  echo "<td>" . $row['Add_Date'] . "</td>";
                  echo '<td>' . '<a href="items.php?do=Edit&itemid='. $row['Item_Id'] . '"class="btn btn-success">Edit</a>' . ' ' . '<a href="items.php?do=Delete&itemid='. $row['Item_Id'] . '"class="btn btn-danger">Delete</a>' ; 
                  echo'</td>';
                  echo "</tr>";
               }
               ?>
            </table>
         </div>
         <a href="items.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Item</a>
         
       </div>
      
   <?php 
   }
   elseif($do == 'Add')
   {
    ?>
    <h1 class="text-center">Add New Item</h1>
            <form action="?do=Insert" method="POST">

         <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" aria-describedby="emailHelp" name="name"placeholder="Enter The Item Name"autocomplete="off"required="required">
         </div>
         <div class="form-group">
          <label>Description</label>
          <input type="text" class="form-control" aria-describedby="emailHelp" name="description"placeholder="Enter The Description Of The Item"autocomplete="off">
          
         </div>
         <div class="form-group">
          <label>Price</label>
          <input type="text" class="form-control" aria-describedby="emailHelp" name="price"placeholder="Enter The Price Of The Item"autocomplete="off">
          
         </div>
         </div>
         <div class="form-group">
          <label>Country Made</label>
          <input type="text" class="form-control" aria-describedby="emailHelp" name="country"placeholder="Enter The Country Of The Item"autocomplete="off">
          
         </div>
         </div>
         <div class="form-group">
          <label>Statues</label>
          <select name="statues" class="form-control">
           <option value="0">...</option>
           <option value="1">New</option>
           <option value="2">Like New</option>
           <option value="3">Used</option>
           <option value="4">Old</option>
          </select>
          <label>Member</label>
          <select name="member" class="form-control">
           <option value="0">...</option>
           <?php
           $stmt=$connection->prepare("SELECT * FROM users");
           $stmt->execute();
           $users=$stmt->fetchAll();
           foreach ($users as $user)
           {
            ?>
            <option value="<?php echo $user['userID'];?>"><?php echo  $user['Username'];?></option>
            <?php
           }
           
           ?>
          
          </select>
          <label>The Category</label>
          <select name="category" class="form-control">
           <option value="0">...</option>
           <?php
           $stmt=$connection->prepare("SELECT * FROM categories");
           $stmt->execute();
           $cats=$stmt->fetchAll();
           foreach ($cats as $cat)
           {
            ?>
            <option value="<?php echo $cat['ID'];?>"><?php echo  $cat['Name'];?></option>
            <?php
           }
           
           ?>
          </select>
         </div>
         <button type="submit" class="btn btn-primary" id="btn">Add Item</button>
      </form>
    <?php
   }
   elseif($do=='Insert'){
    // insert page
            
      if ($_SERVER['REQUEST_METHOD'] == 'POST')
      {
         echo "<h1 class='text-center'>Insert Item</h1>";
         echo '<div>';
         // Get The Variables
         $name = $_POST['name'];
         $description = $_POST['description'];
         $price= $_POST['price'];
         $country = $_POST['country'];
         $statues = $_POST['statues'];
         $members = $_POST['member'];
         $categorys = $_POST['category'];
         $formErrors = array();
         if (empty($name))
         {
            $formErrors[] = 'Name Can\'t Be Empty';
         }
         if (empty($price))
         {
            $formErrors[] = 'Price <strong>Can\'t Be Empty</strong>' ;
         }
         if (empty($country))
         {
            $formErrors[] = 'Country <strong>Can\'t Be Empty</strong>' ;
         }
         if (empty($statues))
         {
            $formErrors[] = 'Statues <strong>Can\'t Be Empty</strong>';
         }
         
         foreach($formErrors as $error)
         {
            echo '<div class="alert alert-danger">' . $error . '</div>';
         }
         // check if there is no error in the update proccessing
         if (empty($formErrors))
         {
            // check if the user is Exist
            $check = checkItem("Name" , "items" , $name);
            if ($check == 1)
            {
               $themsg ='<div class="alert alert-danger">' . "Sorry The Item Is Already Exist " . '</div>';
               echo $themsg;
               header("refresh:3;url=index.php");
               exit();
}else {
            
            // Inserte Users info
            
            $stmt = $connection->prepare("INSERT INTO items (Name,Description,Price,Add_Date,Country_Made,Statues,Cat_Id,Member_Id)
                                                      VALUES(:zname,:zdesc,:zprice,now(),:zcountry,:zstatues,:zcat,:zmember)");
            $stmt->execute(array(
             'zname'    => $name,
             'zdesc'    => $description,
             'zprice'   => $price,
             'zcountry' => $country,
             'zstatues' => $statues,
             'zcat'  => $categorys,
             'zmember'     => $members
            ));
        // echo Succsess Message
        $themsg = "<div class='alert alert-success'>" . $stmt->rowCount() .' ' . 'Record Inserted</div>';
        redirectHome($themsg , 'back');
         }
        
         }
      }else{
         $themsg='<div class="alert alert-danger">' . "Sorry You Can't Enter This Page" . '</div>';
         redirectHome($themsg , 'back');
      }
      echo '</div>';
   }
   elseif($do == 'Edit')
   {
    // start Edit Page
    // check if the ID is numeric 
    $itemid= isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
    $stmt = $connection->prepare("SELECT * FROM items where Item_Id = ?");
    $stmt->execute(array($itemid));
    $row = $stmt->fetch();
    $count = $stmt->rowCount(); // check if there is a record have this data or not
    if ($count > 0)
    {
      ?>
            <h1 class="text-center">Edit Items</h1>
            <form action="?do=Update" method="POST">
             <input type="hidden" name="itemid"value= "<?php echo $itemid;?>">
         <div class="form-group">
          <label>Name</label>
          <input type="text"value="<?php echo $row['Name'] ;?>" class="form-control" aria-describedby="emailHelp" name="name"placeholder="Enter The Item Name"autocomplete="off"required="required">
         </div>
         <div class="form-group">
          <label>Description</label>
          <input type="text"value="<?php echo $row['Description'] ;?>" class="form-control" aria-describedby="emailHelp" name="description"placeholder="Enter The Description Of The Item"autocomplete="off">
          
         </div>
         <div class="form-group">
          <label>Price</label>
          <input type="text" value="<?php echo $row['Price'] ;?>"class="form-control" aria-describedby="emailHelp" name="price"placeholder="Enter The Price Of The Item"autocomplete="off">
          
         </div>
         </div>
         <div class="form-group">
          <label>Country Made</label>
          <input type="text" value="<?php echo $row['Country_Made'] ;?>"class="form-control" aria-describedby="emailHelp" name="country"placeholder="Enter The Country Of The Item"autocomplete="off">
          
         </div>
         </div>
         <div class="form-group">
          <input type="hidden" name="itemid"value= "<?php echo $itemid;?>">
          <label>Statues</label>
          <select name="statues" class="form-control">
           <option value="0">...</option>
           <option value="1" <?php  if ($row['Statues'] == 1) { echo "selected";}?>>New</option>
           <option value="2" <?php  if ($row['Statues'] == 2) { echo "selected";}?>>Like New</option>
           <option value="3" <?php  if ($row['Statues'] == 3) { echo "selected";}?>>Used</option>
           <option value="4" <?php  if ($row['Statues'] == 4) { echo "selected";}?>>Old</option>
          </select>
          <label>Member</label>
          <select name="member" class="form-control">
           <option value="0">...</option>
           <?php
           $stmt=$connection->prepare("SELECT * FROM users");
           $stmt->execute();
           $users=$stmt->fetchAll();
           foreach ($users as $user)
           {
            ?>
            <option value="<?php echo $user['userID'];?>" <?php if ($row['Member_Id'] == $user['userID']) { echo "selected";}?>><?php echo  $user['Username'];?></option>
            <?php
           }
           
           ?>
          
          </select>
          <label>The Category</label>
          <select name="category" class="form-control">
           <option value="0">...</option>
           <?php
           $stmt=$connection->prepare("SELECT * FROM categories");
           $stmt->execute();
           $cats=$stmt->fetchAll();
           foreach ($cats as $cat)
           {
            ?>
            <option value="<?php echo $cat['ID'];?>"<?php if ($row['Cat_Id'] == $cat['ID']) { echo "selected";}?>><?php echo  $cat['Name'];?></option>
            <?php
           }
           
           ?>
          </select>
         </div>
        <button type="submit" class="btn btn-primary" id="btn">Save</button>
      </form>
         
    <?php
    }else{
      echo 'there is no such ID';
    }
   }
   elseif($do == 'Update')
   {
     // start Update Page
      echo "<h1 class='text-center'>Update Items</h1>";
      echo '<div>';
      if ($_SERVER['REQUEST_METHOD'] == 'POST')
      {
         // Get The Variables
         $id = $_POST['itemid'];
         $name = $_POST['name'];
         $desc = $_POST['description'];
         $price = $_POST['price'];
         $country = $_POST['country'];
         $statues = $_POST['statues'];
         $member = $_POST['member'];
         $cat = $_POST['category'];
         $formErrors = array();
         if (empty($name))
         {
            $formErrors[] = 'Name Can\'t Be Empty';
         }
         if (empty($price))
         {
            $formErrors[] = 'Price <strong>Can\'t Be Empty</strong>' ;
         }
         if (empty($country))
         {
            $formErrors[] = 'Country <strong>Can\'t Be Empty</strong>' ;
         }
         if (empty($statues))
         {
            $formErrors[] = 'Statues <strong>Can\'t Be Empty</strong>';
         }
         
         foreach($formErrors as $error)
         {
            echo '<div class="alert alert-danger">' . $error . '</div>';
         }
         // check if there is no error in the update proccessing
         if (empty($formErrors))
         {
            // Update the database
        $stmt = $connection->prepare("UPDATE items SET Name = ? , Description = ? , Price = ?, Country_Made = ? , Statues = ?,Cat_Id = ?,Member_Id = ? WHERE Item_Id = ?");
        $stmt->execute(array($name, $desc, $price, $country, $statues,$cat,$member,$id));
        // echo Succsess Message
        $themsg = "<div class='alert alert-success'>" . $stmt->rowCount() .' ' . 'Record Updated</div>';
        redirectHome($themsg , 'back');
         }
        
         
      }else{
         $themsg = "Sorry You Can't Enter This Page";
         redirectHome($themsg , 'back');
      }
      echo '</div>';
   }
   elseif($do == 'Delete')
   {
    $itemid= isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
    $stmt = $connection->prepare("SELECT * FROM items where Item_Id = ? LIMIT 1");
    $stmt->execute(array($itemid));
    $count = $stmt->rowCount(); // check if there is a record have this data or not
    if ($count > 0)
    {
      $stmt = $connection->prepare("DELETE FROM items WHERE Item_Id = :zid");
      $stmt ->bindParam(":zid" , $itemid);
      $stmt ->execute();
      $themsg = "<div class='alert alert-success'>" . $stmt->rowCount() .' ' . 'Record Deleted</div>';
      redirectHome($themsg , 'back');

    }
    else{
      $themsg=  "name is not exist ";
      redirectHome($themsg , 'back');
    }
    
    
   }
   include $temp . "footer.php";
   }else {
    header('location:index.php');
    exit();
   }
   ob_end_flush();
   ?>