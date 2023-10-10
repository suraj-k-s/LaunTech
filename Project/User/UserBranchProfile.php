<?php
include("../Assets/Connection/Connection.php");
session_start();
$sel="select * from tbl_branch where branch_id='".$_GET['bid']."'";
		$result=$con->query($sel);
		$data=$result->fetch_assoc();
		?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Branch Profile</title>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
<table width="360" border="1">
  <tr>
	 <td width="93" height="333" align="center">
       <img src="../Assets/Files/Branch/<?php echo $data['branch_photo'];?>"height="100" width="150" />
    	<p align="center"><?php echo $data["branch_name"];?></p>
        <p><?php echo $data["branch_address"];?></p>
        <p><?php echo $data["branch_contact"];?></p>
        <p><?php echo $data["branch_email"];?></p>
    </td>
  </tr>
</table>
</form>
</body>
</html>