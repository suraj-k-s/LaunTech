<?php
	include("../Assets/Connection/Connection.php");
	session_start();
	ob_start();
	include('Head.php');
	if(isset($_POST["btn_submit"]))
	{
		$oldpwd=$_POST["txtoldpwd"];
		$newpwd=$_POST["txtnewpwd"];
		$confirmpwd=$_POST["txtconfirmpwd"];
		$selqry="select * from tbl_branch where branch_id='".$_SESSION['bid']."'";
		$result=$con->query($selqry);
		$data=$result->fetch_assoc();
		$password=$data["branch_password"];
		if($password==$oldpwd && $newpwd==$confirmpwd)
		{
			$update="update tbl_branch set branch_password='".$newpwd."' where branch_id='".$_SESSION['bid']."'";
			$con->query($update);
			echo " Password Updated successfully";
		}
		else
		{
			if($password!=$oldpwd)
			{
			echo "Invalid  Old Password";
		    }
			else
			{
				echo "New password and Confirm Password doesn't match";
			}
				
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LuanTech::Branch::ChangePassword</title>
</head>
<body>
<form action="" method="post" >
  <table width="500" border="1" height="181">
  
      <tr>
      <td width="201" height="41">Old Password</td>
      <td width="283"><label for="txtoldpwd"></label>
     <input type="password" name="txtoldpwd" id="txtoldpwd" title="You must be enter 6 or more charaters" required  pattern="[a-zA-Z0-9.@#$%^&*]{6,30}"/></td>
    </tr>
    
    <tr>
      <td height="47">New password</td>
      <td><label for="txtnewpwd"></label>
     <input type="password" name="txtnewpwd" id="txtnewpwd" title="You must be enter 6 or more charaters" required  pattern="[a-zA-Z0-9.@#$%^&*]{6,30}"/></td>
    </tr>
    
        <tr>
      <td height="47">Confirm password</td>
      <td><label for="txtnewpwd"></label>
     <input type="password" name="txtconfirmpwd" id="txtconfirmpwd" title="You must be enter 6 or more charaters" required  pattern="[a-zA-Z0-9.@#$%^&*]{6,30}"/></td>
    </tr>
    
   
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
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