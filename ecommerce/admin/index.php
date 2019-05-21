<?php
   session_start();
   $noNavbar = '';
   $pageTitle = 'Log In';
   // هشوف اذا كان اليوزر  فعلا متسجل ف الSession ولا لا ؟
   if (isset($_SESSION['loggedin']))
   {
    header('location:dashboard.php'); // redirect to the dashboard
   }
   include "init.php";
   include $temp . "header.php";
   include $languages . "eng.php";
   // check if the method of the form is post or not and if he came from a post http request page 
   if ($_SERVER['REQUEST_METHOD'] == 'POST')
   {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedpass= sha1($password); // encrypted password
    // check if the user is exit in the database
    $stmt = $connection->prepare("SELECT userID,Username , Password FROM users where Username = ? AND Password = ? AND GroupID = 1 LIMIT 1");
    $stmt->execute(array($username , $hashedpass));
    $row = $stmt->fetch();
    $count = $stmt->rowCount(); // check if there is a record have this data or not 
    // check if count = 1 or not if the count > 0 it means that the database has this data
    if ($count > 0 )
    {
        $_SESSION['loggedin'] = $username; // register session by username
        $_SESSION['ID'] = $row['userID']; // register session ID
        header('location:dashboard.php'); // redirect to the dashboard
        exit();
    }
   }
?>
<div class="login-box">
            
            <h2>Log In</h2>
        <form class="login" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
            <span><i class="fa fa-user" aria-hidden="true"></i></span><br><input type="text" name="username" placeholder="Enter Your Username"><br>
            <span><i class="fa fa-lock" aria-hidden="true"></i></span><br><input type="password" name="password" placeholder="Enter Your Password"><br>
            <input type="submit" value="Log In">
            <br><br><a href="#">Forgot Your Password ?!  <i class="far fa-frown"></i></a><br>
            <a href="#">Register Now...<span class="heart"><i class="fas fa-heart"></i></span></a>
            
        </form>
        </div>
<?php
   include $temp . "footer.php";
?>