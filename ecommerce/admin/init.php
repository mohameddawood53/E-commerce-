<?php
include "config.php";
// routes & pathes in ADMIN folder (include) 
 $temp = 'include/templates/'; // templates directory 
 $languages = 'include/languages/'; // languages directory
 $funcs = 'include/functions/'; // functions directory
 $lib  = 'include/libraries/'; // librarires directory
// routes & pathes in ADMIN folder (layout)
 $css = 'layout/css/'; // css directory
 $fonts = 'layout/fonts/'; // fonts directory 
 $imgs = 'layout/images/'; // images directory 
 $js  = 'layout/js/'; // js directory
 // include important files
 include $funcs . 'functions.php';
 //include $languages . 'eng.php';
 include $temp . 'header.php';
 // include the navbar in all pages expect the page that have $noNavbar variable 
 if (!isset($noNavbar)){
  include $temp . 'navbar.php';
 }
 
?>