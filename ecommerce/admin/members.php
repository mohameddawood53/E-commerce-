<style>
   
   .form-group{
      width: 560px;
      margin-left: 20px;
   }
   #btn{
      margin-left: 20px; 
   }
</style>
<?php
/*
 ====================================================
 == You can edit members here
 == You can add | edit | delete members from here
 ====================================================
 */

   session_start();
   $pageTitle = 'Members';
   if (isset($_SESSION['loggedin']))
   {
   include ('init.php');
   $do = isset($_GET['do'])?$_GET['do'] : 'Manage';
   if ($do == 'Manage')
   {
      $query = '';
      if (isset($_GET['page']) && $_GET['page'] == "Pending")
      {
         $query = "AND RegStatues = 0";
      }
      $stmt = $connection->prepare("SELECT  * FROM   users WHERE GroupID != 1 $query");
      $stmt->execute();
      // assign to varibles
      $rows = $stmt->fetchAll();
       // start Manage Page
       ?>
       <h1 class="text-center">Manage Members</h1>
       <div class="container">
         <div class="table-responsive">
            <table class="table">
               <tr>
                  <td>#ID</td>
                  <td>Username</td>
                  <td>Email</td>
                  <td>Full Name</td>
                  <td>Registered Date</td>
                  <td>Control</td>
               </tr>
               <?php
               foreach($rows as $row)
               {
                  echo "<tr>";
                  echo "<td>" . $row['userID'] . "</td>";
                  echo "<td>" . $row['Username'] . "</td>";
                  echo "<td>" . $row['Email'] . "</td>";
                  echo "<td>" . $row['FullName'] . "</td>";
                  echo "<td>" . $row['Date'] . "</td>";
                  echo '<td>' . '<a href="members.php?do=Edit&userid='. $row['userID'] . '"class="btn btn-success">Edit</a>' . ' ' . '<a href="members.php?do=Delete&userid='. $row['userID'] . '"class="btn btn-danger">Delete</a>' ; 
                  if ($row['RegStatues'] == 0)
                  {
                     echo' <a href="members.php?do=Activate&userid='. $row['userID'] . '"class="btn btn-info">Activate</a>';
                  }
                  echo'</td>';
                  echo "</tr>";
               }
               ?>
            </table>
         </div>
         <a href="members.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Member</a>
         
       </div>
      
   <?php 
   }elseif($do == 'Add')
   {
      // Add New Members
      ?>
      <h1 class="text-center">Add New Members</h1>
            <form action="?do=Insert" method="POST">
         <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" aria-describedby="emailHelp" name="username"placeholder="Enter username"autocomplete="off"required="required">
          <small id="emailHelp" class="form-text text-muted">We'll never share your username with anyone else.</small>
        </div>
         <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1"name="password"  autocomplete="new-password"placeholder="Enter Password"required="required">
          <small id="emailHelp" class="form-text text-muted">We'll never share your password with anyone else.</small>
         </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email"required="required">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label>Full Name</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="full"placeholder="Enter your fullname"required="required">
          <small id="emailHelp" class="form-text text-muted">We'll never share your Fullname with anyone else.</small>
        </div>
        <button type="submit" class="btn btn-primary" id="btn">Add Member</button>
      </form>
            
            <?php }
            elseif($do == 'Insert')
            {
               // insert page
            
      if ($_SERVER['REQUEST_METHOD'] == 'POST')
      {
         echo "<h1 class='text-center'>Insert Members</h1>";
         echo '<div>';
         // Get The Variables
         $user = $_POST['username'];
         $pass = $_POST['password'];
         $email= $_POST['email'];
         $name = $_POST['full'];
         $hashPassword = sha1($_POST['password']);
         $formErrors = array();
         if (strlen($user)< 4)
         {
            $formErrors[] = 'Username Can\'t Be Less Than<strong> 4 Characters</strong>';
         }
         if (empty($user))
         {
            $formErrors[] = 'Username <strong>Can\'t Be Empty</strong>' ;
         }
         if (empty($name))
         {
            $formErrors[] = 'Full Name <strong>Can\'t Be Empty</strong>' ;
         }
         if (empty($pass))
         {
            $formErrors[] = 'Password <strong>Can\'t Be Empty</strong>';
         }
         if (empty($email))
         {
            $formErrors[] = 'Email <strong>Can\'t Be Empty</strong>';
         }
         foreach($formErrors as $error)
         {
            echo '<div class="alert alert-danger">' . $error . '</div>';
         }
         // check if there is no error in the update proccessing
         if (empty($formErrors))
         {
            // check if the user is Exist
            $check = checkItem("Username" , "users" , $user);
            if ($check == 1)
            {
               $themsg ='<div class="alert alert-danger">' . "Sorry The Username Is Already Exist " . '</div>';
               redirectHome($themsg , 'back');
            }else {
            
            // Inserte Users info
            
            $stmt = $connection->prepare("INSERT INTO users(Username,Password,Email,FullName,RegStatues,Date) VALUES(:zuser,:zpassword ,:zemail,:zname,1,now())");
            $stmt->execute(array(
             'zuser' => $user,
             'zpassword' => $hashPassword,
             'zemail' => $email,
             'zname' => $name
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
    $userid= isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
    $stmt = $connection->prepare("SELECT * FROM users where userID = ? LIMIT 1");
    $stmt->execute(array($userid));
    $row = $stmt->fetch();
    $count = $stmt->rowCount(); // check if there is a record have this data or not
    if ($count > 0)
    {
      ?>
            <h1 class="text-center">Edit Members</h1>
            <form action="?do=Update" method="POST">
               <input type="hidden" name="userid"value= "<?php echo $userid;?>">
         <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" aria-describedby="emailHelp" name="username" value= "<?php echo  $row['Username'];?>"placeholder="Enter username"autocomplete="off"required="required">
          <small id="emailHelp" class="form-text text-muted">We'll never share your username with anyone else.</small>
        </div>
         <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="hidden" id="exampleInputPassword1"name="oldpassword"value="<?php echo  $row['Password'];?>" placeholder="Password">
          <input type="password" class="form-control" id="exampleInputPassword1"name="newpassword"  autocomplete="new-password"placeholder="Leave Blank If You Don't Want To Change">
          <small id="emailHelp" class="form-text text-muted">We'll never share your password with anyone else.</small>
         </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value= "<?php echo $row['Email'];?>" name="email" placeholder="Enter email"required="required">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label>Full Name</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="full" value= "<?php echo $row['FullName'];?>" placeholder="Enter your fullname"required="required">
          <small id="emailHelp" class="form-text text-muted">We'll never share your Fullname with anyone else.</small>
        </div>
        <button type="submit" class="btn btn-primary" id="btn">Save</button>
      </form>
         
    <?php
    }else{
      echo 'there is no such ID';
    }
    
   }elseif($do == 'Update'){
      // start Update Page
      echo "<h1 class='text-center'>Update Members</h1>";
      echo '<div>';
      if ($_SERVER['REQUEST_METHOD'] == 'POST')
      {
         // Get The Variables
         $id = $_POST['userid'];
         $user = $_POST['username'];
         $email = $_POST['email'];
         $name = $_POST['full'];
         $password='';
         // Password Trick
         if (empty($_POST['newpassword']))
         {
            $password = $_POST['oldpassword'];
         }else{
            $password = sha1($_POST['newpassword']);
         }
         $formErrors = array();
         if (strlen($user)< 4)
         {
            $formErrors[] = 'Username Can\'t Be Less Than<strong> 4 Characters</strong>';
         }
         if (empty($user))
         {
            $formErrors[] = 'Username <strong>Can\'t Be Empty</strong>' ;
         }
         if (empty($name))
         {
            $formErrors[] = 'Full Name <strong>Can\'t Be Empty</strong>' ;
         }
         if (empty($email))
         {
            $formErrors[] = 'Email <strong>Can\'t Be Empty</strong>';
         }
         foreach($formErrors as $error)
         {
            echo '<div class="alert alert-danger">' . $error . '</div>';
         }
         // check if there is no error in the update proccessing
         if (empty($formErrors))
         {
            // Update the database
        $stmt = $connection->prepare("UPDATE users SET Username = ? , Email = ? , FullName = ?, Password = ? WHERE userID = ?");
        $stmt->execute(array($user, $email, $name, $password, $id));
        // echo Succsess Message
        $themsg = "<div class='alert alert-success'>" . $stmt->rowCount() .' ' . 'Record Updated</div>';
        redirectHome($themsg , 'back');
         }
        
         
      }else{
         $themsg = "Sorry You Can't Enter This Page";
         redirectHome($themsg , 'back');
      }
      echo '</div>';
   }elseif($do == 'Delete'){
    $userid= isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
    $stmt = $connection->prepare("SELECT * FROM users where userID = ? LIMIT 1");
    $stmt->execute(array($userid));
    $count = $stmt->rowCount(); // check if there is a record have this data or not
    if ($count > 0)
    {
      $stmt = $connection->prepare("DELETE FROM users WHERE userID = :zuser");
      $stmt ->bindParam(":zuser" , $userid);
      $stmt ->execute();
      $themsg = "<div class='alert alert-success'>" . $stmt->rowCount() .' ' . 'Record Deleted</div>';
      redirectHome($themsg , 'back');

    }
    else{
      $themsg=  "ID is not exist ";
      redirectHome($themsg , 'back');
    }
    
    
   }
   elseif($do == 'Activate')
    {
      $userid= isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
    $stmt = $connection->prepare("SELECT * FROM users where userID = ? LIMIT 1");
    $stmt->execute(array($userid));
    $count = $stmt->rowCount(); // check if there is a record have this data or not
    if ($count > 0)
    {
      $stmt = $connection->prepare("UPDATE users SET RegStatues = 1 WHERE userID = ?");
      $stmt ->execute(array($userid));
      $themsg = "<div class='alert alert-success'>" . $stmt->rowCount() .' ' . 'Record Activated</div>';
      redirectHome($themsg , 'back');

    }
    else{
      $themsg=  "ID is not exist ";
      redirectHome($themsg , 'back');
    }
    }
   include $temp . 'footer.php';
   }else{
    header('location:index.php');
    exit();
   }
   
?>