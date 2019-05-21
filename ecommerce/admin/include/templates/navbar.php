<style>
.dropdown {
    position: relative;
    display: inline-block;
}
.navbar-expand-lg .navbar-nav .nav-link {
    padding-right: .5rem;
    padding-left: 3.5rem;
    padding-top: 10px;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 12px 16px;
    z-index: 1;
}

.dropdown:hover .dropdown-content {
    display: block;
}
#droping{
    position: absolute;
    margin-left:1000px; 
    
}
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">E-commerce</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
        <a class="nav-link" href="dashboard.php">Home <span class="sr-only">(current)</span></a>
      <li class="nav-item">
        <a class="nav-link" href="categories.php">Categories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="items.php">Items</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="members.php">Members</a>
      </li>
      <li class="nav-item dropdown" id="droping">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <?php echo $_SESSION['loggedin'] ;?>
        </a>
        <div class="dropdown" aria-labelledby="navbarDropdownMenuLink">
            <div class="dropdown-content">
          <a class="dropdown-item" href="members.php?do=Edit&userid=<?php echo $_SESSION['ID'] ;?>">Edit Profile</a>
          
          <a class="dropdown-item" href="logout.php">Log Out</a>
          </div>
        </div>
      </li>
    </ul>
  </div>
</nav>