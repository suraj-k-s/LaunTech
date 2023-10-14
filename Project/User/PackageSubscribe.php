<?php
include("../Assets/Connection/Connection.php");
session_start();
ob_start();
include('Head.php');
$selqry="select * from tbl_package";
$result=$con->query($selqry);
if(isset($_GET['pid']))
{
	$insqry="insert into tbl_packagebooking(package_id,packagebooking_date,user_id)
	values('".$_GET['pid']."',curdate(),'".$_SESSION['uid']."')";
	if($con->query($insqry))
	{
		header('location: Payment.php?action=package');
	}
	else{
		?>
        <script>
		alert('Subscription Failed')
		
		</script>
        <?php
	}
}
?> 












<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LuanTech::User::Search Package</title>
</head>

<body>
<a href="Homepage.php">Home</a>
<form id="form1" name="form1" method="post" action="">
<table width="360" border="1">
  <tr>
  <?php
  while ($data=$result->fetch_assoc())
  {
    ?>
    
    <td width="93" height="333">
       <img src="../Assets/Files/Package/<?php echo $data['package_photo'];?>"height="100" width="150"/>
    	<p><?php echo $data["package_name"];?></p>
        <p><?php echo $data["package_details"];?></p>
        <p>Duration:<?php echo $data["package_duration"];?></p>
        <p>Discount:<?php echo $data["package_percentage"];?></p>
        <p>₹<?php echo $data["package_price"];?></p>
        <p><a href="PackageSubscribe.php?pid=<?php echo $data['package_id'] ?>">Subscribe!</a></p>
    </td>
    <?php
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