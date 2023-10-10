
<?php
include("../Assets/Connection/Connection.php");
session_start();
ob_start();
include('Head.php');
$selqry="select * from tbl_packagebooking u inner join tbl_package p on u.package_id=p.package_id where user_id='$_SESSION[uid]' and packagebooking_status=1 and existing_count!=0 order by packagebooking_id desc";
$result=$con->query($selqry);
?>
























<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MyPackage</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<table width="360" border="1">
  <tr>
  <?php
 if($data=$result->fetch_assoc())
{
	?>
	 <td width="93" height="333" align="center">
       <img src="../Assets/Files/Package/<?php echo $data['package_photo'];?>"height="100" width="150"/>
    	<p><?php echo $data["package_name"];?></p>
        <p><?php echo $data["package_details"];?></p>
        <p>Duration:<?php echo $data["package_duration"];?></p>
        <p>Discount:<?php echo $data["package_percentage"];?></p>
        <p>₹<?php echo $data["package_price"];?></p>
    </td>
	
    <?php
  }
else{
	echo "<H1 align='center'>Package not subscribed</H1>";
}
   
    ?>
  </tr>
</table>
</form>
</body>
<?php
include('Foot.php');
ob_flush();
?>
</html>