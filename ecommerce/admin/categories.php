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
</style>
<?php
ob_start();
session_start();
   $pageTitle = 'Categories';
   if (isset($_SESSION['loggedin']))
   {
   include ('init.php');
   $do = isset($_GET['do'])?$_GET['do'] : 'Manage';
   if ($do == 'Manage')
   {
    $sort ='ASC';
    $sort_array = array('ASC' , 'DESC');
    if (isset($_GET['sort'])&& in_array($_GET['sort'] , $sort_array))
       {
        $sort  = $_GET['sort'];
       }
  
    $stmt2 = $connection->prepare("SELECT * FROM categories ORDER BY Ordering $sort");
    $stmt2->execute();
    $cats = $stmt2->fetchAll();
    
    ?>
    <h1 class="text-center">Manage Categories</h1>
    <div class="container latest categories">
      <div class="row">
         <div class="col-sm-6">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <i class="fa fa-tag"></i> Manage Categories
                  <div class="ordering pull-right">
                   Oredering:
                   <a class="<?php if($sort == 'ASC'){echo 'active';} ?>"href="?sort=ASC">ASC</a> |
                   <a class="<?php if($sort == 'DESC'){echo 'active';} ?>"href="?sort=DESC">DESC</a>
                  </div>
                 
               </div>
               
               <div class="panel-body">
                  
                  <?php
                  foreach($cats as $cat)
                  {
                   echo '<div class="cat">';
                   echo '<div class="hidden-buttons">';
                   echo '<a href="categories.php?do=Edit&catid=' . $cat['ID'] . '" class="btn btn-xs btn-primary"> Edit</a> ';
                   echo '<a href="categories.php?do=Delete&catid=' . $cat['ID'] . '" class="btn btn-xs btn-danger"> Delete</a>';
                   echo '</div>';
                   echo '<h4>' . $cat['Name'] . '</h4>';
                   echo "<p>" ;if ($cat['Description'] == ''){echo "There is no description"; }else {echo $cat['Description'];}echo"</p>";
                   if ( $cat['Visablity'] == 1){echo '<span class="visiblity">Hidden</span>';}
                   if ( $cat['Allow_Comment'] == 1){echo '<span class="comment">Commenting Disabled</span>';}
                   if ( $cat['Allow_Ads'] == 1){echo '<span class="ads">Advertising Disabled</span>';}
                   echo '</div>';
                   echo '<hr/>';
                  }
                  
                  ?>
              </div>
            </div>
         </div>
         
      </div>
      <a href="categories.php?do=Add" class="btn btn-primary"> <i class="fa fa-plus"></i> Add New Category</a>
    <?php
   
   }elseif($do == 'Add')
   {
    ?>
    <h1 class="text-center">Add New Category</h1>
            <form action="?do=Insert" method="POST">
         <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" aria-describedby="emailHelp" name="name"placeholder="Enter The Category Name"autocomplete="off"required="required">
        </div>
         <div class="form-group">
          <label for="exampleInputPassword1">Description</label>
          <input type="text" class="form-control" id="exampleInputPassword1"name="description" placeholder="Enter The Description Of The Category">
         </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Ordering</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="ordering" placeholder="Enter The Number To Order The Category">
        </div>
        <div class="form-group">
          <label>Visible</label>
          <div>
           <input id="vis-yes"type="radio" name="visiblity" value=0 checked />
           <label for="vis-yes">Yes</label>
          </div>
          <div>
           <input id="vis-no"type="radio" name="visiblity" value=1/>
           <label for="vis-no">No</label>
          </div>
        </div>
        <div class="form-group">
          <label>Allow Commenting</label>
          <div>
           <input id="com-yes"type="radio" name="commenting" value=0 checked />
           <label for="com-yes">Yes</label>
          </div>
          <div>
           <input id="com-no"type="radio" name="commenting" value=1/>
           <label for="com-no">No</label>
          </div>
        </div>
        <div class="form-group">
          <label>Allow Ads</label>
          <div>
           <input id="ads-yes"type="radio" name="ads" value=0 checked />
           <label for="ads-yes">Yes</label>
          </div>
          <div>
           <input id="ads-no"type="radio" name="ads" value=1/>
           <label for="ads-no">No</label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary" id="btn">Add Category</button>
      </form>
    <?php
   }
   elseif($do == 'Insert'){
    
   if ($_SERVER['REQUEST_METHOD'] == 'POST')
      {
         echo "<h1 class='text-center'>Insert Category</h1>";
         echo '<div>';
         // Get The Variables
         $name    = $_POST['name'];
         $desc    = $_POST['description'];
         $order   = $_POST['ordering'];
         $visible = $_POST['visiblity'];
         $comment = $_POST['commenting'];
         $ads     = $_POST['ads'];
            // check if the category is Exist
            $check = checkItem("Name" , "categories" , $name);
            if ($check == 1)
            {
               $themsg ='<div class="alert alert-danger">' . "Sorry The Ctegory Is Already Exist " . '</div>';
               redirectHome($themsg , 'back');
            }else {
            
            // Inserte Category info
            
            $stmt = $connection->prepare("INSERT INTO categories(Name,Description ,Ordering ,Visablity ,Allow_Comment,Allow_Ads ) VALUES(:zname,:zdesc ,:zorder,:zvis,:zcom,:zads)");
            $stmt->execute(array(
             'zname'  => $name,
             'zdesc'  => $desc,
             'zorder' => $order,
             'zvis'   => $visible,
             'zcom'   => $comment,
             'zads'   => $ads
            ));
        // echo Succsess Message
        $themsg = "<div class='alert alert-success'>" . $stmt->rowCount() .' ' . 'Record Inserted</div>';
        redirectHome($themsg , 'back');
         
        
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
    // check if the CATID is numeric 
    $catid= isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
    $stmt = $connection->prepare("SELECT * FROM categories where ID = ?");
    $stmt->execute(array($catid));
    $cat = $stmt->fetch();
    $count = $stmt->rowCount(); // check if there is a record have this data or not
    if ($count > 0)
    {
      ?>
            <h1 class="text-center">Edit Category</h1>
            <form action="?do=Update" method="POST">
             <input type="hidden" name="catid"value= "<?php echo $catid;?>">
         <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" aria-describedby="emailHelp" name="name"placeholder="Enter The Category Name"autocomplete="off"required="required" value="<?php echo $cat['Name']; ?>">
        </div>
         <div class="form-group">
          <label for="exampleInputPassword1">Description</label>
          <input type="text" class="form-control" id="exampleInputPassword1"name="description" placeholder="Enter The Description Of The Category"value="<?php echo $cat['Description']; ?>">
         </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Ordering</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="ordering" placeholder="Enter The Number To Order The Category"value="<?php echo $cat['Ordering']; ?>">
        </div>
        <div class="form-group">
          <label>Visible</label>
          <div>
           <input id="vis-yes"type="radio" name="visiblity" value=0 <?php if ($cat['Visablity']== 0){echo 'checked';} ?> />
           <label for="vis-yes">Yes</label>
          </div>
          <div>
           <input id="vis-no"type="radio" name="visiblity" value=1 <?php if ($cat['Visablity']== 1){echo 'checked';} ?>/>
           <label for="vis-no">No</label>
          </div>
        </div>
        <div class="form-group">
          <label>Allow Commenting</label>
          <div>
           <input id="com-yes"type="radio" name="commenting" value=0 <?php if ($cat['Allow_Comment']== 0){echo 'checked';} ?> />
           <label for="com-yes">Yes</label>
          </div>
          <div>
           <input id="com-no"type="radio" name="commenting" value=1 <?php if ($cat['Allow_Comment']== 1){echo 'checked';} ?>/>
           <label for="com-no">No</label>
          </div>
        </div>
        <div class="form-group">
          <label>Allow Ads</label>
          <div>
           <input id="ads-yes"type="radio" name="ads" value=0 <?php if ($cat['Allow_Ads']== 0){echo 'checked';} ?> />
           <label for="ads-yes">Yes</label>
          </div>
          <div>
           <input id="ads-no"type="radio" name="ads" value=1 <?php if ($cat['Allow_Ads']== 1){echo 'checked';} ?>/>
           <label for="ads-no">No</label>
          </div>
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
    echo "<h1 class='text-center'>Update Categoriy</h1>";
      echo '<div>';
      if ($_SERVER['REQUEST_METHOD'] == 'POST')
      {
         // Get The Variables
         $id = $_POST['catid'];
         $name = $_POST['name'];
         $description = $_POST['description'];
         $ordering = $_POST['ordering'];
         $visible = $_POST['visiblity'];
         $comment = $_POST['commenting'];
         $ads = $_POST['ads'];
         // Update the database
        $stmt = $connection->prepare("UPDATE categories SET Name = ? , Description = ? , Ordering = ?, Visablity = ?, Allow_Comment = ?, Allow_Ads = ? WHERE ID = ?");
        $stmt->execute(array($name, $description, $ordering, $visible, $comment,$ads,$id));
        $stmt->rowCount();
        // echo Succsess Message
        $themsg = "<div class='alert alert-success'>" . $stmt->rowCount() .' ' . 'Record Updated</div>';
        redirectHome($themsg , 'back');
         }else{
         $themsg = "Sorry You Can't Enter This Page";
         redirectHome($themsg , 'back');
      }
      echo '</div>';
   }elseif($do == 'Delete')
   {
    $catid= isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
    $stmt = $connection->prepare("SELECT * FROM categories where ID = ?");
    $stmt->execute(array($catid));
    $cat = $stmt->fetch();
    $count = $stmt->rowCount(); // check if there is a record have this data or not
    if ($count > 0)
    {
      $stmt = $connection->prepare("DELETE FROM categories WHERE ID = :zuser");
      $stmt ->bindParam(":zuser" , $catid);
      $stmt ->execute();
      $themsg = "<div class='alert alert-success'>" . $stmt->rowCount() .' ' . 'Record Deleted</div>';
      redirectHome($themsg , 'back');
    }
    else{
      $themsg=  "ID is not exist ";
      redirectHome($themsg , 'back');
    }
   }
   include $temp . "footer.php";
   }
   else {
    header('Location:index.php');
    exit();
   }
   ob_end_flush();
   ?>
