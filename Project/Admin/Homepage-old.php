<?php
include("../Assets/Connection/Connection.php");
session_start();
?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LaunTech::Admin::Home</title>
</head>
<h1 style="font-style:oblique">WELCOME TO LAUNHUB</h1>
<p>
<?php echo $_SESSION['aname']; ?>
</p>
<a href="../Guest/Login.php">Logout</a>
<table width="500" border="1">
  <tr>
    <td><a href="AdminRegistrartion.php">AdminRegistrartion</a></td>
  </tr>
  <tr>
     <td><a href="District.php">District</a></td>
  </tr>
  <tr>
     <td><a href="Place.php">Place</a></td>
  </tr>
  <tr>
     <td><a href="Category.php">Category</a></td>
  </tr>
  <tr>
     <td><a href="Subcategory.php">Subcategory</a></td>
  </tr>
  <tr>
     <td><a href="AddPackage.php">Package</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
</table>
<p>&nbsp;</p>
</body>
</html>