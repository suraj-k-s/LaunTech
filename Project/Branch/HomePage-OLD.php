<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LuanTech::Branch::Homepage</title>
</head>
<h1 style="font-style:oblique">WELCOME TO LAUNTECH</h1>
<p>
<?php echo $_SESSION['bname']; ?>
</p>
<a href="../Guest/Login.php">Logout</a>

<table width="200" height="200" border="1" align="center">
  <tr>
    <td><a href="BranchProfile.php">BranchProfile</a></td>
  </tr>
  <tr>
     <td><a href="EditBranch.php">EditBranch</a></td>
  </tr>
  <tr>
     <td><a href="ChangePassword.php">ChangePassword</a></td>
  </tr>
</table>
</html>