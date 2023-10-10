<?php
include("../Assets/Connection/Connection.php");
session_start();
ob_start();
include('Head.php');

$selqry="select * from tbl_user where user_id=$_SESSION[uid] ";
$result=$con->query($selqry);
$data=$result->fetch_assoc();




if(isset($_POST['btn_submit']))
{
	$upQry="update tbl_user set   user_name='".$_POST["txtname"]."',user_contact='".$_POST["txtcontact"]."'  where user_id=$_SESSION[uid]";
	echo $upQry;
	if($con->query($upQry))
	{
		?>
        <script>
			alert("Updated")
			window.location="MyProfile.php";
		</script>
        <?php
	}
	else
	{
		echo "Insert Failed";
	}
}
?> 











<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LuanTech::User::MyProfile</title>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
  <table width="382" border="1">
    <tr>
      <td colspan="2" align="center">
      	<img src="../Assets/Files/User/<?php echo $data['user_photo'];?>" height="200" width="200"</td>
    </tr>
    <tr>
      <td width="137">Name</td>
      <td width="229">
	  <input type="text" name="txtname" value="<?php echo $data["user_name"];?>" />
	  
	  
      
      </td>
    </tr>
    
    <tr>
      <td>Contact</td>
      <td>
	    <input type="text" name="txtcontact" value="<?php echo $data["user_contact"];?>" />
	  </td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Update" />
     <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel"/>
      </td>
    </tr>
  </table>
</form>
</body>
<?php
include('Foot.php');
ob_flush();
?>
</html>